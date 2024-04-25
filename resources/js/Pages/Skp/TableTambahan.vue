<script setup>
import { ref } from 'vue'
import { PlusIcon } from '@heroicons/vue/24/outline'

const penilaiModal = ref(false)
</script>

<template>
  <table class="w-full text-xs mt-4">
    <tr class="bg-blue-400 whitespace-nowrap font-semibold text-white">
      <td colspan="6" class="whitespace-nowrap w-full">
        <div class="flex items-center justify-between">
          B. TAMBAHAN
          <button
            class="bg-green-500 px-2 py-1 ml-2 flex"
            @click="penilaiModal = true"
          >
            <PlusIcon class="w-4 h-4" /> TAMBAHAN
          </button>
        </div>
      </td>
    </tr>
    <tr>
      <td colspan="6" class="text-center">BLEMUM ADA DATA</td>
    </tr>
  </table>
</template>

<style scoped></style>
