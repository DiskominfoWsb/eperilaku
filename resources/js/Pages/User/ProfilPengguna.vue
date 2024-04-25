<script setup>
/* eslint vue/no-multiple-template-root : 'off' */

import { Head, useForm, usePage } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({
  user: { type: Object, default: null }
})

const form = useForm({
  email: props.user.email,
  password: '',
  password_confirmation: ''
})

const formReset = () => {
  form.password = ''
  form.password_confirmation = ''
  toastr.success(usePage().props.value.flash.message)
}

const submit = () => {
  form.post(route('update.profile'), {
    onFinish: () => formReset()
  })
}
</script>
<template>
  <Head title="Profil Pengguna" />

  <form class="text-sm" @submit.prevent="submit">
    <div class="w-full">
      <label>E-Mail</label>
      <TextInput v-model="form.email" type="text" />
    </div>
    <div class="w-full mt-4">
      <label>Password</label>
      <TextInput v-model="form.password" type="password" />
    </div>
    <div class="w-full mt-4">
      <label>Konfirmasi Password</label>
      <TextInput v-model="form.password_confirmation" type="password" />
    </div>
    <div class="w-full mt-4">
      <PrimaryButton
        class="w-full md:w-fit"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
        type="button"
        @click="submit"
      >
        SIMPAN
      </PrimaryButton>
    </div>
  </form>
</template>
