<template>
  <div class="social-links">
    <a
      v-for="(drive, index) in drivers"
      :key="index"
      :href="route('auth.social.index', drive.type)"
      :class="[drive.class, drive.active ? '' : 'none-events']"
      class="social-link border-no"
    ></a>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: { Link },

  data() {
    return {
      drivers: [
        {
          type: "google",
          class: "social-google fab fa-google",
          active: true,
        },
        {
          type: "facebook",
          class: "social-facebook fab fa-facebook-f",
          active: true,
        },
        {
          type: "twitter",
          class: "social-twitter fab fa-twitter",
          active: false,
        },
      ],
    };
  },
};
</script>