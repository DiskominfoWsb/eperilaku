<script setup>
import Backend from '@/Layouts/BackendLayout.vue'
import FormCreate from '@/Pages/Skp/FormCreate.vue'
import FormModalNewSkp from '@/Pages/Skp/FormModalNewSkp.vue'

defineProps({
  isactive: { type: Boolean, default: false },
  skp: { type: Object, default: null }
})
</script>

<template>
  <Backend>
    <div v-if="isactive">
      <form-create :skp="skp" />
    </div>
    <template v-else>
      <FormModalNewSkp />
    </template>
  </Backend>
</template>

<style scoped></style>
