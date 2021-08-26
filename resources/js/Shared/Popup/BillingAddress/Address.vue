<template>
  <group :errorMessage="modelValue.errors['ghn_address.district_id']">
    <select2
      v-model.number="modelValue.ghn_address.district_id"
      :options="districts"
      data-placeholder="Vui lòng chọn khu vực"
    />
  </group>
  <group :errorMessage="modelValue.errors['ghn_address.ward_code']">
    <select2
      v-model="modelValue.ghn_address.ward_code"
      :options="wards"
      data-placeholder="Vui lòng chọn phường - xã"
    />
  </group>
  <group :errorMessage="modelValue.errors['ghn_address.address']">
    <input
      v-model.trim="modelValue.ghn_address.address"
      type="text"
      class="form-control"
      name="code"
      placeholder="Nhập địa chỉ giao hàng"
    />
  </group>
</template>

<script>
import axios from "axios";
import isEmpty from "lodash-es/isEmpty";
import Group from "@/Shared/Inputs/Group.vue";
import Select2 from "@/Shared/Inputs/Select/Select2.vue";

export default {
  components: { Group, Select2 },

  emits: ["loading", "loaded"],

  props: {
    modelValue: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      districts: [],
      wards: [],
    };
  },

  computed: {
    fullAddress() {
      // get full address
      const { district_id, ward_code, address } = this.modelValue.ghn_address;
      const district = this.districts.find((d) => d.id == district_id);
      const ward = this.wards.find((w) => w.id == ward_code);

      return `${address}, ${ward?.text}, ${district?.text}`;
    },
  },

  watch: {
    "modelValue.ghn_address.district_id": function (districtId) {
      if (!districtId) return;

      if (!isEmpty(this.wards)) this.wards = [];

      this.getWards(districtId).then(this.handleGetWards);
    },

    fullAddress(fullAddress) {
      this.modelValue.address = fullAddress;
    },
  },

  async created() {
    this.$emit("loading");
    // call api get location
    const response = await axios.get(this.route("api.location.districts"));
    this.districts = response.data.data;

    this.$emit("loaded");
  },

  mounted() {
    // get user address form page props
    const { address } = this.$page.props.user;

    Object.assign(this.modelValue.ghn_address, address?.ghn_address);
  },

  methods: {
    async getWards(districtId) {
      this.$emit("loading");

      const url = this.route("api.location.wards", districtId);
      const response = await axios.get(url);

      this.$emit("loaded");

      return new Promise((resolve) => resolve(response.data.data));
    },

    handleGetWards(wards) {
      this.wards = wards;

      const exists = wards.find((ward) => {
        return ward.id == this.modelValue.ghn_address.ward_code;
      });

      if (!exists) this.modelValue.ghn_address.ward_code = null;
    },
  },
};
</script>

