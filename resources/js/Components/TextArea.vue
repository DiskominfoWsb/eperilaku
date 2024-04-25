<script setup>
import { onMounted, ref } from 'vue'

defineProps({
  modelValue: { type: String, default: '' },
  errors: { type: String, default: '' }
})

defineEmits(['update:modelValue'])

const input = ref(null)

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus()
  }
})
</script>

<template>
  <textarea
    ref="input"
    maxlength="255"
    rows="3"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    :class="errors ? 'border-red-500' : 'border-gray-300'"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>
