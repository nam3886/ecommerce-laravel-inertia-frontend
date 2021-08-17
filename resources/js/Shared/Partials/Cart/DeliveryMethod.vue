<template>
  <ul>
    <li v-for="method in deliveryMethods" :key="method.id">
      <div class="custom-radio">
        <input
          @input="$emit('update:modelValue', method.id)"
          :id="`delivery${method.id}`"
          name="shipping"
          type="radio"
          class="custom-control-input"
        />
        <label
          :for="`delivery${method.id}`"
          class="custom-control-label"
          style="text-transform: capitalize"
        >
          {{ method.name }}
        </label>
      </div>
    </li>
  </ul>
</template>

<script>
export default {
  props: ["deliveryMethods"],

  emits: ["update:modelValue"],
};
</script>
