<template>
  <div class="login-popup overlay-popup">
    <div class="form-box">
      <div class="tab tab-nav-simple tab-nav-boxed form-tab">
        <ul
          class="
            nav nav-tabs nav-fill
            align-items-center
            border-no
            justify-content-center
            mb-5
          "
          role="tablist"
        >
          <li class="nav-item">
            <span class="nav-link active border-no lh-1 ls-normal">
              Thông tin
            </span>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active">
            <form @submit.prevent="$emit('submit', form, fullAddress)">
              <group :errorMessage="form.errors.name">
                <input
                  v-model.trim="form.name"
                  type="text"
                  class="form-control"
                  placeholder="Họ và Tên"
                />
              </group>
              <group :errorMessage="form.errors.phone">
                <input
                  v-model.trim="form.phone"
                  type="text"
                  class="form-control"
                  placeholder="Số điện thoại"
                />
              </group>
              <group :errorMessage="form.errors.ghn_address?.district_id">
                <select2
                  v-model.number="form.ghn_address.district_id"
                  :options="districts"
                  data-placeholder="Vui lòng chọn khu vực"
                />
              </group>
              <group :errorMessage="form.errors.ghn_address?.ward_code">
                <select2
                  v-model="form.ghn_address.ward_code"
                  :options="wards"
                  data-placeholder="Vui lòng chọn phường - xã"
                />
              </group>
              <group :errorMessage="form.errors.ghn_address?.address">
                <input
                  v-model.trim="form.ghn_address.address"
                  type="text"
                  class="form-control"
                  name="code"
                  placeholder="Nhập địa chỉ giao hàng"
                />
              </group>

              <slot name="action" :form="form" />
            </form>
          </div>
        </div>
      </div>
    </div>
    <slot />
  </div>
</template>

<script>
import axios from "axios";
import isEmpty from "lodash-es/isEmpty";
import Group from "@/Shared/Inputs/Group.vue";
import Select2 from "@/Shared/Inputs/Select/Select2.vue";

export default {
  components: { Group, Select2 },

  emits: ["submit"],

  data() {
    return {
      districts: [],
      wards: [],
      form: this.$inertia.form({
        name: null,
        phone: null,
        delivery_method_id: null,
        payment_method_id: null,
        ghn_address: { address: null, district_id: null, ward_code: null },
        address: null,
      }),
    };
  },

  computed: {
    fullAddress() {
      // get full address
      const { district_id, ward_code, address } = this.form.ghn_address;

      const district = this.districts.find((d) => d.id == district_id);

      const ward = this.wards.find((w) => w.id == ward_code);

      return `${address}, ${ward.text}, ${district.text}`;
    },
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
    // get user address form page props
    const { user } = this.$page.props;

    Object.assign(this.form, user.address, {
      name: user.name,
      phone: user.phone,
    });
  },

  methods: {
    async getWards(districtId) {
      const url = this.route("api.location.ward", districtId);

      const response = await axios.get(url);

      return new Promise((resolve) => resolve(response.data.data));
    },
  },
};
</script>

