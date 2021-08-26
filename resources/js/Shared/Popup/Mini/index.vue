<template>
  <div class="minipopup-area">
    <div
      @mousedown="focus"
      @mouseup="close"
      @mouseleave="resume"
      @mouseenter="pause"
      :class="{ 'p-0': component == 'MinipopupFlashMessage' }"
      class="minipopup-box"
    >
      <component
        :is="component"
        :cart="cart"
        :quantity="quantity"
        :message="message"
      ></component>
    </div>
  </div>
</template>

<script>
import { wait } from "@/helpers.js";
import MinipopupAddedCart from "@/Shared/Popup/Mini/AddedCart.vue";
import MinipopupPurchased from "@/Shared/Popup/Mini/Purchased.vue";
import MinipopupFlashMessage from "@/Shared/Popup/Mini/FlashMessage.vue";

export default {
  components: { MinipopupAddedCart, MinipopupPurchased, MinipopupFlashMessage },

  data() {
    return {
      cart: null,
      quantity: 1,
      message: null,
      timerInterval: 100,
      isPaused: false,
      timerId: null,
      counter: 0,
      component: "MinipopupAddedCart",
    };
  },

  mounted() {
    this.$EMITTER.on("show-popup:added-cart", ({ cart, quantity }) => {
      this.listenEvents("MinipopupAddedCart", { cart, quantity });
    });

    this.$EMITTER.on("show-popup:purchased", ({ cart }) => {
      this.listenEvents("MinipopupPurchased", { cart });
    });

    this.$EMITTER.on("show-popup:message", (message) => {
      this.message = message;
      this.listenEvents("MinipopupFlashMessage", {});
    });
  },

  methods: {
    show() {
      this.timerId = setInterval(this.timerClock, this.timerInterval);

      $(this.$el).find(".minipopup-box").addClass("show");
    },

    close() {
      clearInterval(this.timerId);

      this.counter = 0;

      $(this.$el).find(".minipopup-box").removeClass("show");
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

    listenEvents(component, { cart, quantity }) {
      wait().then(this.close);

      wait(300).then(() => {
        this.component = component;

        this.cart = cart;

        this.quantity = quantity;

        wait().then(this.show);
      });
    },
  },
};
</script>
