<template>
  <div :class="{ 'is-invalid': errorMessage }" class="form-group">
    <slot />
    <error-message v-if="errorMessage" :message="errorMessage" class="mt-1" />
  </div>
</template>

<script>
import ErrorMessage from "@/Shared/Inputs/ErrorMessage.vue";

export default {
  components: { ErrorMessage },

  props: ["errorMessage"],
};
</script>

