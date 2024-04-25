<script setup>
import { ref } from 'vue'

const show = ref(true)
const isShow = () => {
  setTimeout(() => {
    show.value = false
  }, 1000)
}
isShow()
</script>
<template>
  <div
    v-if="$page.props.flash.message && show"
    class="absolute bottom-5 left-0 w-full px-6 md:w-64 z-50 text-sm"
  >
    <div class="bg-white border shadow-md">
      <div class="bg-red-500 font-semibold text-white p-2">Danger</div>
      <div class="bg-white-400 p-2">
        {{ $page.props.flash.message }}
      </div>
    </div>
  </div>
</template>
<style scoped></style>
