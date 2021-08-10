<template>
  <div v-if="show" class="__alert">
    <div
      v-if="hasMessage('error')"
      class="alert alert-danger alert-simple alert-inline"
    >
      <h4 class="alert-title">Error :</h4>
      {{ $page.props.flash.error.join() }}
      <button type="button" class="btn btn-link btn-close">
        <i class="d-icon-times"></i>
      </button>
    </div>
    <div
      v-if="hasMessage('success')"
      class="alert alert-success alert-simple alert-inline"
    >
      <h4 class="alert-title">Success :</h4>
      {{ $page.props.flash.success.join() }}
      <button type="button" class="btn btn-link btn-close">
        <i class="d-icon-times"></i>
      </button>
    </div>
    <div
      v-if="hasMessage('warning')"
      class="alert alert-warning alert-simple alert-inline"
    >
      <h4 class="alert-title">Warning :</h4>
      {{ $page.props.flash.warning.join() }}
      <button type="button" class="btn btn-link btn-close">
        <i class="d-icon-times"></i>
      </button>
    </div>
    <div
      v-if="hasMessage('info')"
      class="alert alert-primary alert-simple alert-inline"
    >
      <h4 class="alert-title">News :</h4>
      {{ $page.props.flash.info.join(", ") }}
      <button type="button" class="btn btn-link btn-close">
        <i class="d-icon-times"></i>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      show: true,
    };
  },

  watch: {
    "$page.props.flash": {
      deep: true,
      handler() {
        this.show = true;
      },
    },
  },

  methods: {
    hasMessage(type) {
      return this.$page.props.flash[type].length && this.show;
    },
  },
};
</script>

<style scoped>
.alert.alert-simple.alert-inline:not(:first-child) {
  margin-top: 1rem;
}
</style>