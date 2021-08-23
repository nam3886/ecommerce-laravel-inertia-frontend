<template>
  <div ref="stripeElement"></div>
</template>

<script>
import { loadStripe } from "@stripe/stripe-js";

export default {
  props: ["publishableKey", "modelValue"],

  emits: ["error", "input", "update:modelValue"],

  data() {
    return {
      stripe: null,
      card: null,
    };
  },

  async mounted() {
    this.stripe = await loadStripe(this.publishableKey);
    this.card = this.stripe.elements().create("card", {
      style: {
        base: {
          color: "#999",
          lineHeight: "18px",
          fontFamily: "Poppins, sans-serif",
          fontSize: "13px",
          fontWeight: "400",
          fontSize: "inherit",
          "::placeholder": {
            color: "#999",
          },
        },
        invalid: {
          color: "#b10001",
          iconColor: "#b10001",
        },
      },
      hidePostalCode: true,
    });

    this.card.mount(this.$refs.stripeElement);
    this.card.addEventListener("change", this.handleChangeInput);
  },

  methods: {
    handleChangeInput(event) {
      this.$emit("input", event);
      this.$emit("update:modelValue", null);

      event.error && this.$emit("error", event.error.message);

      if (event.complete) {
        this.$EMITTER.emit("processing");

        this.createToken().then((result) => {
          this.$EMITTER.emit("processed");

          if (result.error) return this.$emit("error", result.error.message);

          this.$emit("update:modelValue", result.token.id);
        });
      }
    },

    createToken() {
      return this.stripe.createToken(this.card, {
        address_country: "VN",
      });
    },
  },
};
</script>

<style scoped>
.StripeElement {
  display: block;
  width: 100%;
  min-height: 4.1rem;
  margin-bottom: 2.1rem;
  padding: 0.85rem 2rem;
  padding-left: 1.5rem;
  padding-right: 1.5rem;
  background-color: #fff;
  border: 1px solid #e3e3e3;
  color: #999;
  line-height: 1.5;
  font-size: 1.3rem;
  font-weight: 400;
  border-radius: 0.3rem;
  outline: 0;
  box-shadow: none;
}

.StripeElement--focus {
  border-color: #000;
}

.StripeElement--invalid {
  /* border-color: #fa755a; */
  border-color: #b10001;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>