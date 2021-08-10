<template>
  <div class="minipopup-area">
    <div
      @mousedown="focus"
      @mouseup="close"
      @mouseleave="resume"
      @mouseenter="pause"
      class="minipopup-box"
    >
      <minipopup-purchased v-if="isPurchased" />
      <minipopup-added-cart
        v-if="cart && !isPurchased"
        :cart="cart"
        :quantity="quantity"
      />
    </div>
  </div>
</template>

<script>
import { wait } from "@/helpers.js";
import MinipopupAddedCart from "@/Shared/Popup/Mini/AddedCart.vue";
import MinipopupPurchased from "@/Shared/Popup/Mini/Purchased.vue";

export default {
  components: { MinipopupAddedCart, MinipopupPurchased },

  data() {
    return {
      cart: null,
      quantity: 1,
      timerInterval: 100,
      isPaused: false,
      timerId: null,
      counter: 0,
      isPurchased: false,
    };
  },

  mounted() {
    this.emitter.on("show-popup:added-cart", ({ cart, quantity }) => {
      wait().then(this.close);

      wait(300).then(() => {
        this.isPurchased = false;

        this.cart = cart;

        this.quantity = quantity;

        wait().then(this.show);
      });
    });

    this.emitter.on("show-popup:purchased", ({ cart }) => {
      wait().then(this.close);

      wait(300).then(() => {
        this.cart = null;

        this.isPurchased = true;

        wait().then(this.show);
      });
    });
  },

  methods: {
    show() {
      $(this.$el).find(".minipopup-box").addClass("show");

      this.timerId = setInterval(this.timerClock, this.timerInterval);
    },

    close() {
      $(this.$el).find(".minipopup-box").removeClass("show");

      clearInterval(this.timerId);

      this.counter = 0;
    },

    focus() {
      $(this.$el).find(".minipopup-box").addClass("focus");
    },

    pause() {
      this.isPaused = true;
    },

    resume() {
      this.isPaused = false;
    },

    timerClock() {
      if (this.isPaused) return;

      this.counter++;

      this.counter == this.timerInterval && this.close();
    },
  },
};
</script>