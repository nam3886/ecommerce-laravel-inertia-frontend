<template>
  <div>
    <input
      :id="`sw-${$attrs.id}`"
      v-bind="$attrs"
      @change="$emit('change', $event)"
      type="checkbox"
      switch="success"
    />
    <label :for="`sw-${$attrs.id}`"></label>
  </div>
</template>

