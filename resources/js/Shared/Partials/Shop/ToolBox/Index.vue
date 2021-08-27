<template>
  <nav
    class="
      toolbox toolbox-horizontal
      sticky-toolbox sticky-content
      fix-top
      pt-2
    "
    data-top="1174"
  >
    <aside class="sidebar sidebar-fixed shop-sidebar">
      <div class="sidebar-overlay"></div>
      <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
      <div class="sidebar-content toolbox-left">
        <div class="toolbox-item select-menu">
          <a class="select-menu-toggle" href="#">Select Size</a>
          <ul class="filter-items">
            <li><a href="#">Extra Large</a></li>
            <li><a href="#">Large</a></li>
            <li><a href="#">Medium</a></li>
            <li><a href="#">Small</a></li>
          </ul>
        </div>
        <div class="toolbox-item select-menu">
          <a class="select-menu-toggle" href="#">Select Color</a>
          <ul class="filter-items">
            <li><a href="#">Black</a></li>
            <li><a href="#">Blue</a></li>
            <li><a href="#">Brown</a></li>
            <li><a href="#">Green</a></li>
          </ul>
        </div>
        <product-filter
          v-model="queryBuilder.filters[0]"
          :options="options[0]"
          label="Select Price"
        />
      </div>
    </aside>
    <div class="toolbox-left">
      <a
        href="#"
        class="
          toolbox-item
          left-sidebar-toggle
          btn btn-sm btn-outline btn-primary btn-rounded btn-icon-right
          d-lg-none
        "
      >
        Filter<i class="d-icon-arrow-right"></i>
      </a>
      <sort v-model="queryBuilder.sort" />
    </div>
    <div class="toolbox-right">
      <per-page />
      <display-mode />
    </div>
  </nav>
  <div :class="{ 'd-block': selectedList.length }" class="select-items">
    <a
      v-for="(selected, index) in selectedList"
      :key="index"
      @click.prevent=""
      href="#"
      class="select-item"
    >
      {{ selected.text }}
      <i
        @click="removeSelected(selected.key, selected.value)"
        class="d-icon-times"
      ></i>
    </a>
    <a
      @click.prevent="removeAllSelected"
      href="#"
      class="filter-clean text-primary"
      >Clean All</a
    >
  </div>
</template>

<script>
import Sort from "@/Shared/Partials/Shop/ToolBox/Sort.vue";
import PerPage from "@/Shared/Partials/Shop/ToolBox/PerPage.vue";
import DisplayMode from "@/Shared/Partials/Shop/ToolBox/DisplayMode.vue";
import ProductFilter from "@/Shared/Partials/Shop/ToolBox/Filter.vue";
import { computed, reactive } from "@vue/reactivity";
import flatten from "lodash-es/flatten";

export default {
  components: {
    Sort,
    PerPage,
    DisplayMode,
    ProductFilter,
  },

  setup(props) {
    const queryBuilder = reactive({
      filters: {},
      sort: "default",
    });

    const options = {
      0: [
        { value: "0,50", text: "$0.00 - $50.00" },
        { value: "50,100", text: "$50.00 - $100.00" },
        { value: "100,150", text: "$100.00 - $150.00" },
        { value: "150,200", text: "$150.00 - $200.00" },
      ],
    };

    const selectedList = computed(() => {
      return flatten(
        Object.keys(queryBuilder.filters).map((key) => {
          return queryBuilder.filters[key].map((filter) => ({
            key,
            ...options[key].find((option) => option.value == filter),
          }));
        })
      );
    });

    function removeSelected(key, value) {
      let filters = queryBuilder.filters[key];
      let idx = filters.findIndex((filter) => filter == value);
      filters.splice(idx, 1);
    }

    function removeAllSelected() {
      queryBuilder.filters = {};
    }

    return {
      queryBuilder,
      selectedList,
      options,
      removeSelected,
      removeAllSelected,
    };
  },
};
</script>
