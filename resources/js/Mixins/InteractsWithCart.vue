<script>
import { scrollToAlert } from "@/helpers.js";

export default {
  data() {
    return {
      cart: {},
      form: this.$inertia.form({
        rowId: null,
        id: null,
        qty: null,
        sku: null,
      }),
    };
  },

  watch: {
    "$page.props.cart": {
      deep: true,
      handler(cart) {
        this.cart = cart;
      },
    },
  },

  created() {
    this.cart = this.$page.props.cart;
  },

  methods: {
    getBySku(sku) {
      return Object.values(this.cart.items).find((item) => {
        return item.options.sku === sku;
      });
    },

    store(id, qty, sku, callback) {
      Object.assign(this.form, { id, qty, sku });

      this.$EMITTER.emit("processing:cart");

      this.form.post(this.route("cart.store"), {
        preserveScroll: true,
        onError: this.handleCartError,
        onFinish: () => this.$EMITTER.emit("processed:cart"),
        onSuccess: () => {
          this.$EMITTER.emit("add-cart:success");
          typeof callback === "function" && callback();
        },
      });
    },

    update(rowId, qty, callback) {
      Object.assign(this.form, { rowId, qty });

      this.$EMITTER.emit("processing:cart");

      this.form.put(this.route("cart.update", rowId), {
        preserveScroll: true,
        onError: this.handleCartError,
        onFinish: () => this.$EMITTER.emit("processed:cart"),
        onSuccess: () => {
          this.$EMITTER.emit("update-cart:success");
          typeof callback === "function" && callback();
        },
      });
    },

    destroy(rowId, callback) {
      this.$EMITTER.emit("processing:cart");

      this.form.delete(this.route("cart.destroy", rowId), {
        preserveScroll: true,
        onError: this.handleCartError,
        onFinish: () => this.$EMITTER.emit("processed:cart"),
        onSuccess: () => {
          this.$EMITTER.emit("destroy-cart:success");
          typeof callback === "function" && callback();
        },
      });
    },

    handleCartError(errors) {
      console.log(Object.values(errors));

      this.$page.props.flash.warning.push(Object.values(errors));

      scrollToAlert();
    },

    showMiniPopupAddedCart(cart, quantity) {
      this.$EMITTER.emit("show-popup:added-cart", { cart, quantity });
    },
  },
};
</script>
