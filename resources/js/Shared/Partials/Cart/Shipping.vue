<template>
  <aside class="col-lg-4 sticky-sidebar-wrapper">
    <div class="sticky-sidebar" data-sticky-options="{'bottom': 20}">
      <div class="summary mb-4">
        <h3 class="summary-title text-left">Tổng giỏ hàng</h3>
        <table class="shipping">
          <tr class="summary-subtotal">
            <td>
              <h4 class="summary-subtitle">Tổng tiền hàng</h4>
            </td>
            <td>
              <p class="summary-subtotal-price">{{ cart.subtotal_format }}</p>
            </td>
          </tr>
          <tr class="sumnary-shipping shipping-row-last">
            <td colspan="2">
              <h4 class="summary-subtitle">Tính phí vận chuyển</h4>
              <delivery-method
                v-model="form.delivery_method_id"
                :deliveryMethods="deliveryMethods"
              />
            </td>
          </tr>
        </table>
        <form @submit.prevent="calculateShippingFee" class="shipping-address">
          <label>Chuyển đến <strong>VN.</strong></label>
          <div class="select-box">
            <select2
              v-model.number="form.ghn_address.district_id"
              :options="districts"
              data-placeholder="Vui lòng chọn khu vực"
            />
          </div>
          <div class="select-box">
            <select2
              v-model="form.ghn_address.ward_code"
              :options="wards"
              data-placeholder="Vui lòng chọn phường - xã"
            />
          </div>
          <input
            v-model.trim="form.ghn_address.address"
            type="text"
            class="form-control"
            name="code"
            placeholder="Nhập địa chỉ giao hàng"
          />
          <button
            type="submit"
            class="btn btn-md btn-dark btn-rounded btn-outline"
          >
            Tính phí
          </button>
        </form>
        <table class="total">
          <tr class="summary-subtotal">
            <td>
              <h4 class="summary-subtitle">Tổng</h4>
            </td>
            <td>
              <p class="summary-total-price ls-s">
                {{ cart.grandtotal_format }}
              </p>
            </td>
          </tr>
        </table>
        <Link
          :href="route('checkout.index')"
          class="btn btn-dark btn-rounded btn-checkout"
        >
          Thanh toán
        </Link>
      </div>
    </div>
  </aside>
</template>

<script>
import isEmpty from "lodash-es/isEmpty";
import axios from "axios";
import { Link } from "@inertiajs/inertia-vue3";
import Select2 from "@/Shared/Inputs/Select/Select2.vue";
import DeliveryMethod from "@/Shared/Partials/Cart/DeliveryMethod.vue";

export default {
  components: { Link, Select2, DeliveryMethod },

  props: ["cart", "deliveryMethods"],

  data() {
    return {
      districts: [],
      wards: [],
      form: this.$inertia.form({
        delivery_method_id: null,
        ghn_address: { address: null, district_id: null, ward_code: null },
        address: null,
      }),
    };
  },

  watch: {
    "form.ghn_address.district_id": function (districtId) {
      if (!districtId) return;

      if (!isEmpty(this.wards)) this.wards = [];

      this.getWards(districtId).then((wards) => {
        this.wards = wards;

        let exists = wards.find((w) => w.id == this.form.ghn_address.ward_code);

        if (!exists) this.form.ghn_address.ward_code = null;
      });
    },
  },

  async created() {
    // call api get location
    const response = await axios.get(this.route("api.location.district"));

    this.districts = response.data.data;
  },

  mounted() {
    const address = this.$page.props.user?.address;

    if (!address) return;

    this.form.delivery_method_id = address.delivery_method_id;
    this.form.ghn_address = { ...address.ghn_address };
    this.form.address = address.address;
  },

  methods: {
    async getWards(districtId) {
      const url = this.route("api.location.ward", districtId);

      const response = await axios.get(url);

      return new Promise((resolve) => resolve(response.data.data));
    },

    calculateShippingFee() {
      // get full address
      const district = this.districts.find((district) => {
        return district.id == this.form.ghn_address.district_id;
      }).text;

      const ward = this.wards.find((ward) => {
        return ward.id == this.form.ghn_address.ward_code;
      }).text;

      this.form.address = `${this.form.ghn_address.address}, ${ward}, ${district}`;
      // call api to update user address
      this.form.post(this.route("user.update_address"));
    },
  },
};
</script>
