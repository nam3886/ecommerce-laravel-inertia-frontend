<template>
  <select data-placeholder="Select . . ." class="select2"></select>
</template>

<script>
import isUndefined from "lodash-es/isUndefined";
import isNull from "lodash-es/isNull";
import isEqual from "lodash-es/isEqual";
import isArray from "lodash-es/isArray";
import isObject from "lodash-es/isObject";
import "select2";

export default {
  props: ["value", "options"],

  computed: {
    isMultiple() {
      return this.$attrs.multiple;
    },
  },

  mounted() {
    const data = this.formatDataForPlaceholder(this.options);

    this.initSelect2(data, this.value)
      .on("change", () => this.$emit("input", this.getDataSelect2()))
      .on("select2:unselect", (e) => this.$emit("unselect", e.params.data));
  },

  watch: {
    value(value) {
      // nothing change
      // if (isEqual(value, this.getDataSelect2())) return;
      // update value
      // $(this.$el).val(this.formatValue(value)).trigger("change");

      // trigger change gay ra loi
      $(this.$el).val(this.formatValue(value));
    },

    options(options) {
      // update options
      const data = this.formatDataForPlaceholder(options);

      this.initSelect2(data, this.value);

      this.$emit("update:options", data);
    },
  },

  methods: {
    initSelect2(data, value) {
      return $(this.$el)
        .empty()
        .select2({ data, minimumResultsForSearch: 20, width: "100%" })
        .val(this.formatValue(value))
        .trigger("change");
    },

    formatValue(value) {
      if (isUndefined(value) || isNull(value)) return null;

      if (isArray(value) || isObject(value)) return value;

      return value.toString();
    },

    formatDataForPlaceholder(options) {
      // placeholder for single select2 need empty option tag
      return this.isMultiple ? options : [{ id: "", text: "" }, ...options];
    },

    getDataSelect2() {
      const value = $(this.$el).val();

      if (value === "true") return true;

      if (value === "false") return false;

      return value;
    },
  },
};
</script>

