<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  level: {
    type: String,
    default: 'menu'
  },
  url: {
    type: String,
    default: ''
  },
  title: {
    type: String,
    default: ''
  },
  count: {
    type: Number,
    default: 0
  }
})
</script>

<template>
  <Link v-if="level === 'menu'" :href="route(url)" class="sidebar-nav">
    <span class="sidebar-icons"><slot name="icon" /></span>
    <span class="sidebar-text">{{ title }}</span>
    <span v-if="count > 0" class="sidebar-dot">{{ count }}</span>
    <span v-else class="sidebar-dot" />
  </Link>
  <span
    v-else
    class="text-xs font-extrabold text-gray-400 block py-2 bg-gray-50 pl-3 uppercase"
    >{{ title }}</span
  >
</template>

<style scoped></style>
