<script setup>
/* eslint no-unused-vars : 'off' */
import { usePage } from '@inertiajs/vue3';

const { permissions } = usePage().props.value.auth
const props = defineProps({
  can: { type: String, default: '' }
})

const isCan = value => permissions.indexOf(value) !== -1
</script>

<template>
  <div>
    <slot v-if="isCan(can)" />
  </div>
</template>

<style scoped></style>
