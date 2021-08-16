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
              <ul>
                <li v-for="delivery in deliveries" :key="delivery.id">
                  <div class="custom-radio">
                    <input
                      type="radio"
                      :id="`delivery${delivery.id}`"
                      name="shipping"
                      class="custom-control-input"
                    />
                    <label
                      :for="`delivery${delivery.id}`"
                      class="custom-control-label"
                      style="text-transform: capitalize"
                    >
                      {{ delivery.name }}
                    </label>
                  </div>
                </li>
              </ul>
            </td>
          </tr>
        </table>
        <form @submit.prevent="" class="shipping-address">
          <label>Chuyển đến <strong>VN.</strong></label>
          <div class="select-box">
            <select2
              v-model="districtId"
              :options="districts"
              data-placeholder="Vui lòng chọn khu vực"
            />
          </div>
          <div class="select-box">
            <select2
              v-model="wardCode"
              :options="wards"
              data-placeholder="Vui lòng chọn phường - xã"
            />
          </div>
          <input
            v-model.trim="adrress"
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
import axios from "axios";
import { Link } from "@inertiajs/inertia-vue3";
import Select2 from "@/Shared/Inputs/Select/Select2.vue";

export default {
  components: { Link, Select2 },

  props: ["cart", "deliveries"],

  data() {
    return {
      districts: [],
      wards: [],
      districtId: null,
      wardCode: null,
      adrress: null,
    };
  },

  watch: {
    districtId(districtId) {
      if (!districtId) return;

      this.wardCode = null;
      this.wards = [];
      this.getWards(districtId);
    },
  },

  async created() {
    // call api get location
    const response = await axios.get(this.route("api.location.district"));

    this.districts = response.data.data;
  },

  methods: {
    async getWards(districtId) {
      const url = this.route("api.location.ward", districtId);

      const response = await axios.get(url);

      this.wards = response.data.data;
    },

    calculateShippingFee() {},
  },
};
</script>
