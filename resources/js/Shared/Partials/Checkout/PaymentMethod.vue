<template>
  <div>
    <div v-for="method in paymentMethods" :key="method.id" class="card">
      <div class="card-header">
        <a
          @click.prevent="$emit('update:modelValue', method.id)"
          :href="`#collapsePayment${method.id}`"
          :class="{
            collapse: method.id == modelValue,
            expand: method.id != modelValue,
          }"
          class="text-body text-normal ls-m"
        >
          {{ method.name }}
        </a>
      </div>
      <div
        :id="`collapsePayment${method.id}`"
        :class="{
          collapsed: method.id != modelValue,
          expanded: method.id == modelValue,
        }"
      >
        <div class="card-body ls-m">
          {{ method.description }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["paymentMethods", "modelValue"],

  emits: ["update:modelValue"],
};
</script>
