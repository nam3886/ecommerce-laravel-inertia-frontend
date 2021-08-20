<template>
  <ul>
    <li v-for="method in methods" :key="method.id">
      <div class="custom-radio">
        <input
          @input="$emit('update:modelValue', method.id)"
          :id="`delivery${method.id}`"
          :checked="modelValue == method.id"
          name="shipping"
          type="radio"
          class="custom-control-input"
        />
        <label
          :for="`delivery${method.id}`"
          class="custom-control-label"
          style="text-transform: capitalize"
        >
          {{ method.name }}&nbsp;<i class="far fa-question-circle pointer"></i>
        </label>
      </div>
    </li>
  </ul>
</template>

<script>
export default {
  props: ["methods", "modelValue"],

  emits: ["update:modelValue"],
};
</script>
