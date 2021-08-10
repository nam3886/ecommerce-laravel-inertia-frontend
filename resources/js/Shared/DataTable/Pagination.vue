<template>
  <nav v-if="meta && links">
    <p v-if="meta.total < 1" class="text-center">No results found</p>
    <!-- destop version -->
    <div
      v-if="meta.total > 0"
      class="
        d-none d-sm-flex
        justify-content-end justify-content-lg-between
        align-items-center
      "
    >
      <p class="d-none d-lg-block mb-0">
        <span class="font-medium">{{ meta.from }}</span>
        to
        <span class="font-medium">{{ meta.to }}</span>
        of
        <span class="font-medium">{{ meta.total }}</span>
        results
      </p>
      <ul class="pagination mb-0">
        <li class="page-item">
          <component
            :is="links.prev ? 'Link' : 'a'"
            :href="links.prev"
            type="button"
            class="page-link"
            rel="next"
            aria-label="« Previous"
          >
            &laquo;
          </component>
        </li>
        <li
          v-for="(link, key) in meta.links"
          :key="key"
          :class="{
            active: link.active,
          }"
          class="page-item"
          aria-current="page"
        >
          <component
            v-if="!isNaN(link.label) || link.label === '...'"
            :is="link.url ? 'Link' : 'div'"
            :href="link.url"
            class="page-link"
          >
            {{ link.label }}
          </component>
        </li>
        <li class="page-item">
          <component
            :is="links.next ? 'Link' : 'div'"
            :href="links.next"
            type="button"
            class="page-link"
            rel="next"
            aria-label="Next »"
          >
            &raquo;
          </component>
        </li>
      </ul>
    </div>
    <!-- end destop version -->
    <!-- mobile version -->
    <ul
      v-if="meta.total > 0"
      class="pagination d-flex d-sm-none justify-content-between mb-0"
    >
      <li class="page-item">
        <component
          :is="links.prev ? 'Link' : 'a'"
          :href="links.prev"
          type="button"
          class="page-link"
          rel="next"
          aria-label="« Previous"
        >
          Previous &laquo;
        </component>
      </li>
      <li class="page-item">
        <component
          :is="links.next ? 'Link' : 'div'"
          :href="links.next"
          type="button"
          class="page-link"
          rel="next"
          aria-label="Next »"
        >
          Next &raquo;
        </component>
      </li>
    </ul>
    <!-- end mobile version -->
  </nav>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: { Link },
  props: {
    meta: {
      type: Object,
      required: false,
    },
    links: {
      type: Object,
      required: false,
    },
  },
};
</script>
