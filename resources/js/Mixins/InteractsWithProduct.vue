<script>
import axios from "axios";
import isEmpty from "lodash-es/isEmpty";
import InteractsWithCart from "@/Mixins/InteractsWithCart.vue";
import { scrollToAlert } from "@/helpers.js";

export default {
  mixins: [InteractsWithCart],

  data() {
    return {
      variant: {},
      product: {},
      selectVariants: {},
      // get by call api
      attributes: [],
      variants: [],
    };
  },

  computed: {
    _price() {
      return this.variant?.discount
        ? this.variant?.price_after_discount_format
        : this.variant?.price_format;
    },

    availableQuantity() {
      const cart = this.getBySku(this.variant?.sku || this.product.sku);

      const stock = this.variant?.quantity || this.product.quantity;

      return cart ? stock - cart.qty : stock;
    },

    selectedAllVariants() {
      return Object.keys(this.selectVariants).length === this.attributes.length;
    },
    /**
     * lọc ra các lựa chọn có thể có của 1 sản phẩm
     */
    attributesAfterValidation() {
      return this.attributes.map((attribute) => {
        const values = attribute.values.map((value) => {
          // lấy ra các lựa chọn của user
          let selectted = Object.values(this.selectVariants);
          // nếu có 1 lựa chọn trùng với value.code
          // => không cần thêm lựa chọn đó vào để validate
          selectted = selectted.includes(value.code)
            ? selectted
            : [...selectted, value.code];
          // các variants valid khi có chứa tất cả các lựa chọn
          const isValid = this.variants.find((variant) => {
            return selectted.every((code) => variant.includes(code));
          });

          return { ...value, isValid: isValid !== undefined };
        });

        return { ...attribute, values };
      });
    },

    allInCart() {
      const cart = this.getBySku(this.variant?.sku || this.product.sku);

      const stock = this.variant?.quantity || this.product.quantity;

      return cart?.qty == stock ? cart : null;
    },
  },

  methods: {
    async getAttributesByProductId(id) {
      const url = this.route("api.attribute.show", id);

      try {
        const response = await axios.get(url);

        const attributes = await response.data.data;

        return new Promise((resolve) => resolve(attributes));
      } catch (error) {
        alert("getAttributesByProductId: " + error.message);
      }
    },

    async getVariantsByProductId(id) {
      const url = this.route("api.variant.index", id);

      try {
        const response = await axios.get(url);

        const variants = await response.data.data;

        return new Promise((resolve) => resolve(variants));
      } catch (error) {
        alert("getVariantsByProductId: " + error.message);
      }
    },

    async getVariantByCombination(combination) {
      const url = this.route("api.variant.show", combination);

      try {
        const response = await axios.get(url);

        const variant = await response.data.data;

        return new Promise((resolve) => resolve(variant));
      } catch (error) {
        alert("getVariantByCombination: " + error.message);
      }
    },

    toggleVariations({ id, code }) {
      const selected = { ...this.selectVariants };

      if (selected[id] == code) delete selected[id];
      // toggle item in variants
      else selected[id] = code;

      this.selectVariants = selected;

      this.variationCheck();
    },

    variationCheck() {
      const selectVariants = Object.values(this.selectVariants);
      // check all item selectVariants are selected
      if (selectVariants.length !== this.attributes.length) return;

      const combination =
        this.product.id +
        selectVariants.sort().join("") +
        ":" +
        selectVariants.length;

      // variant already exists
      if (combination === this.variant.combination) return;

      this.getVariantByCombination(combination).then((variant) => {
        this.variant = variant;
      });
    },

    clearVariations() {
      this.selectVariants = {};
    },

    addCart(quantity, callback) {
      const errorMessage = this.hasErrors(quantity);

      if (errorMessage) {
        this.$page.props.flash.warning = [errorMessage];

        return scrollToAlert();
      }

      this.store(this.product.id, quantity, this.variant.sku, callback);
    },

    hasErrors(quantity) {
      let message;

      if (this.allInCart) {
        message = this.$MESSAGES.ALL_IN_CART(this.allInCart.qty);
      } else if (quantity > this.availableQuantity) {
        message = `Số lượng không vượt quá ${this.availableQuantity}.`;
      } else if (this.product.has_variants && isEmpty(this.variant)) {
        message = "Vui lòng chọn thuộc tính sản phẩm.";
      }

      return message;
    },
  },
};
</script>