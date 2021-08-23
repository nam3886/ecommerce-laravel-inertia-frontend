<template>
  <div class="step-by pr-4 pl-4">
    <h3
      v-for="item in list"
      :key="item.id"
      class="title title-simple title-step"
      :class="{ active: item.id == indexActive }"
    >
      <Link :href="route(item.route)">{{ item.id }}. {{ item.text }}</Link>
    </h3>
    <h3
      :class="{ active: route().current('checkout.show') }"
      class="title title-simple title-step"
    >
      <Link href="#">3. Order Complete</Link>
    </h3>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: { Link },

  props: ["indexActive"],

  data() {
    return {
      list: [
        { id: 1, text: "Shopping Cart", route: "cart.index" },
        { id: 2, text: "Checkout", route: "checkout.index" },
      ],
    };
  },
};
</script>