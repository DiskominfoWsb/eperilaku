<script setup>
import { XMarkIcon } from '@heroicons/vue/24/outline'
import { useForm } from '@inertiajs/vue3';
import moment from 'moment'
import TextInput from '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const emit = defineEmits({
  UpdateSkpFormOpen: false
})

const props = defineProps({
  skp: { type: Object, default: null }
})

const closeModal = () => {
  emit('UpdateSkpFormOpen', false)
}

const dateNew = dateOld => moment(dateOld, 'DD-MM-YYYY').format('YYYY-MM-DD')

const form = useForm({
  mulai: dateNew(props.skp?.skp_mulai),
  selesai: dateNew(props.skp?.skp_selesai),
  pendekatan: 'KUANTITATIF'
})

const submit = () => {
  form.patch(route('skp.update', props.skp.id), {
    onFinish: () => closeModal()
  })
}
</script>

<template>
  <div class="absolute inset-0 h-screen flex bg-gray-800 bg-opacity-80 p-3">
    <div class="m-auto text-gray-800 bg-white w-full md:w-1/2">
      <div class="flex w-full justify-between bg-blue-400 px-4 py-2">
        <div class="w-full text-white font-semibold">UBAH DATA SKP</div>
        <button @click="closeModal()">
          <XMarkIcon class="w-5 h-5 text-white" />
        </button>
      </div>
      <div class="px-4 py-2 text-xs">
        <form @submit.prevent="submit">
          <div class="mt-4">
            <label>Tanggal Mulai</label>
            <TextInput v-model="form.mulai" type="date" />
          </div>
          <div class="mt-4">
            <label>Tanggal Selesai</label>
            <TextInput v-model="form.selesai" type="date" />
          </div>
          <div class="mt-4">
            <label>Pendekatan</label>
            <TextInput
              v-model="form.pendekatan"
              class="select-none"
              type="text"
              disabled
            />
          </div>
          <div class="mt-4 flex justify-center space-x-2 mb-4">
            <PrimaryButton
              type="button"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              @click="submit"
            >
              SIMPAN
            </PrimaryButton>
            <PrimaryButton type="button" @click="closeModal()">
              BATAL
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
