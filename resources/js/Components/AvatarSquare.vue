<script setup>
defineProps({
  images: '',
  name: ''
})
</script>

<template>
  <div>
    <img
      :alt="name"
      class="flex w-[50px] h-[70px] border border-slate-500 bg-cover cursor-pointer"
      :src="`/upload/profile/${images}`"
    />
  </div>
</template>

<style scoped></style>
