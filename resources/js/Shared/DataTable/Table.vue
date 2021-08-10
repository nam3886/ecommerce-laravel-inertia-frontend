<template>
  <div>
    <div class="row mb-4">
      <global-search
        v-if="search && search.global"
        :value="search.global.value"
        :on-change="changeGlobalSearchValue"
        class="col"
      />
      <div
        class="col-md-6 d-flex justify-content-md-end"
        style="flex-wrap: wrap"
      >
        <add-local-search
          v-if="hasSearchRows"
          :rows="search"
          :new="newSearch"
          :on-add="enableSearch"
          class="mr-2 my-1 my-md-0"
        />
        <filter-item
          v-if="hasFilters"
          :filters="filters"
          :on-change="changeFilterValue"
          class="mr-2 my-1 my-md-0"
        />
        <display-column
          v-if="hasColumns"
          :columns="columns"
          :on-change="changeColumnStatus"
          class="mr-2 my-1 my-md-0"
        />
        <per-page
          :perPage="perPage"
          :on-change="changePerPage"
          class="mb-0 mt-1 my-md-0"
        />
      </div>
    </div>
    <local-search
      ref="rows"
      v-if="hasSearchRows"
      :rows="search"
      :new="newSearch"
      :on-remove="disableSearch"
      :on-change="changeSearchValue"
    />
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="table-responsive">
          <slot name="button-action" />
          <table class="table table-centered table-nowrap table-hover mb-0">
            <thead class="thead-light">
              <slot name="head" />
            </thead>
            <tbody>
              <slot name="body" />
            </tbody>
          </table>
        </div>
        <pagination :meta="meta" :links="links" class="mt-3" />
      </div>
    </div>
  </div>
</template>

<script>
import PerPage from "@/Shared/Datatable/PerPage.vue";
import AddLocalSearch from "@/Shared/Datatable/AddLocalSearch.vue";
import GlobalSearch from "@/Shared/Datatable/GlobalSearch.vue";
import DisplayColumn from "@/Shared/Datatable/DisplayColumn.vue";
import Pagination from "@/Shared/Datatable/Pagination.vue";
import LocalSearch from "@/Shared/Datatable/LocalSearch.vue";
import FilterItem from "@/Shared/Datatable/FilterItem.vue";
export default {
  components: {
    GlobalSearch,
    PerPage,
    AddLocalSearch,
    DisplayColumn,
    Pagination,
    LocalSearch,
    FilterItem,
  },
  props: {
    meta: {
      type: Object,
      default: () => {
        return {};
      },
      required: false,
    },

    links: {
      type: Object,
      default: () => {
        return {};
      },
      required: false,
    },

    columns: {
      type: Object,
      default: () => {
        return {};
      },
      required: false,
    },

    filters: {
      type: Object,
      default: () => {
        return {};
      },
      required: false,
    },

    search: {
      type: Object,
      default: () => {
        return {};
      },
      required: false,
    },

    perPage: {
      type: Number,
      required: true,
    },

    onUpdate: {
      type: Function,
      required: false,
    },
  },

  computed: {
    hasFilters() {
      return Object.keys(this.filters || {}).length > 0;
    },

    hasColumns() {
      return Object.keys(this.columns || {}).length > 0;
    },

    hasSearchRows() {
      return Object.keys(this.search || {}).length > 0;
    },
  },

  data() {
    return {
      newSearch: [],
      queryBuilderData: {
        columns: this.columns,
        filters: this.filters,
        search: this.search,
        perPage: this.perPage,
      },
    };
  },

  methods: {
    disableSearch(key) {
      this.queryBuilderData.search[key].enabled = false;
      this.queryBuilderData.search[key].value = null;

      this.newSearch = this.newSearch.filter((search) => search != key);
    },

    enableSearch(key) {
      this.queryBuilderData.search[key].enabled = true;
      this.newSearch.push(key);

      this.$nextTick(() => {
        this.$refs["rows"].focus(key);
      });
    },

    //

    changeSearchValue(key, value) {
      this.queryBuilderData.search[key].value = value;
    },

    changeGlobalSearchValue(value) {
      this.changeSearchValue("global", value);
    },

    changeFilterValue(key, value) {
      this.queryBuilderData.filters[key].value = value;
    },

    changeColumnStatus(column, status) {
      this.queryBuilderData.columns[column].enabled = status;
    },

    changePerPage(newPerPage) {
      this.queryBuilderData.perPage = newPerPage;
    },
  },

  watch: {
    queryBuilderData: {
      deep: true,
      handler() {
        if (this.onUpdate) {
          this.onUpdate(this.queryBuilderData);
        }
      },
    },
  },
};
</script>

<style scoped>
td {
  max-width: 200px;
  overflow-wrap: break-word;
  hyphens: auto;
  white-space: normal;
}
tr {
  transform: rotate(0);
}
td img {
  max-width: 100px;
}
</style>