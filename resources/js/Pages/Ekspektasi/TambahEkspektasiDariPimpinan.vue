<script setup>
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Modal from '@/Components/Modal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextArea from '@/Components/TextArea.vue'
import { XMarkIcon } from '@heroicons/vue/24/solid'
import { useForm } from '@inertiajs/vue3';
import toastr from 'toastr'
const emit = defineEmits(['close'])

const props = defineProps({
  show: {
    type: Boolean,
    default: false
  },
  maxWidth: {
    type: String,
    default: '2xl'
  },
  closeable: {
    type: Boolean,
    default: true
  },
  skpId: {
    type: String,
    default: ''
  },
  jenis: {
    type: String,
    default: ''
  }
})
const form = useForm({
  skpid: '',
  jenis: '',
  expektasi: ''
})

const submit = () => {
  form.jenis = props.jenis
  form.skpid = props.skpId

  form.post(route('ekspektasi.store'), {
    errorBag: 'storeEkspektasi',
    preserveState: true,
    preserveScroll: true,
    onSuccess: () => {
      toastr.success('Berhasil menambahkan ekspektasi anda', 'success')
      close()
    },
    onError: () => {},
    onFinish: () => {}
  })
}

const close = () => {
  form.reset()
  emit('close')
}
</script>

<template>
  <Modal
    :show="show"
    :max-width="maxWidth"
    :closeable="closeable"
    @close="close"
  >
    <div class="flex justify-between w-full">
      <div
        class="w-full px-3 py-3.5 font-medium text-white uppercase align-middle bg-blue-400"
      >
        Tambah Ekpektasi
      </div>
      <div class="py-2 bg-blue-400">
        <button class="p-2 px-3 bg-blue-400" @click="close">
          <XMarkIcon class="w-5 h-5 font-medium text-white" />
        </button>
      </div>
    </div>
    <div class="p-3">
      <form @submit.prevent="submit">
        <div>
          <InputLabel value="Ekspektasi Anda" />
          <TextArea
            v-model="form.expektasi"
            class="mt-2"
            aria-required="true"
            :errors="form.errors.expektasi"
            required
          />
          <InputError class="mt-2" :message="form.errors.expektasi" />
        </div>
        <div class="justify-end block w-full px-3 py-2 text-right">
          <PrimaryButton
            type="button"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="submit"
          >
            SIMPAN
          </PrimaryButton>
        </div>
      </form>
    </div>
  </Modal>
</template>

<style scoped></style>
