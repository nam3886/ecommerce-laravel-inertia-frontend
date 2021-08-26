<template>
  <nav class="toolbox toolbox-pagination">
    <p class="show-info d-block">
      Showing<span>{{ meta.from }}-{{ meta.to }} of {{ meta.total }}</span>
      Products
    </p>
    <ul class="pagination">
      <li :class="{ 'disabled none-events': !prev.url }" class="page-item">
        <Link
          :href="prev.url"
          :only="['products']"
          class="page-link page-link-prev"
          aria-label="Previous"
        >
          <i class="d-icon-arrow-left"></i>Prev
        </Link>
      </li>
      <li
        v-for="(link, index) in links"
        :key="index"
        :class="{ active: link.active }"
        class="page-item"
        aria-current="page"
      >
        <Link :href="link.url" :only="['products']" class="page-link">
          {{ link.label }}
        </Link>
      </li>
      <li :class="{ 'disabled none-events': !next.url }" class="page-item">
        <Link
          :href="next.url"
          :only="['products']"
          class="page-link page-link-next"
          aria-label="Next"
        >
          Next<i class="d-icon-arrow-right"></i>
        </Link>
      </li>
    </ul>
  </nav>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  props: ["meta"],

  components: { Link },

  computed: {
    links() {
      const links = [...this.meta.links];
      links.shift();
      links.pop();

      return links;
    },

    prev() {
      return this.meta.links[0];
    },

    next() {
      return this.meta.links[this.meta.links.length - 1];
    },
  },
};
</script>
