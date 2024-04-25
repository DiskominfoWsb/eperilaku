<script setup>
/* eslint vue/no-multiple-template-root : 'off' */
import { Head, Link, usePage } from "@inertiajs/vue3";

const page = usePage();

defineProps({
    setting: {
        type: Object,
        default() {},
    },
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="flex w-full h-screen items-center bg-[url('background.jpeg')] bg-cover bg-center bg-opacity-25"
    >
        <div class="flex w-full h-screen items-center bg-black/60">
            <div class="mx-auto w-full md:w-1/3">
                <div
                    class="flex flex-col text-slate-300 justify-center text-center"
                >
                    <div class="flex justify-center mb-5">
                        <img
                            class="w-32"
                            :src="'/' + setting.logo"
                            alt="Logo"
                        />
                    </div>
                    <p class="text-2xl mb-5">
                        {{ setting.name }}
                    </p>
                    <p class="mb-5">
                        {{ setting.description }}
                    </p>
                    <div class="flex justify-center">
                        <Link :href="route('login')" class="btn-main w-1/2">
                            Masuk
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div
    class="flex w-full h-screen items-center bg-[url('background.jpeg')] bg-cover bg-center bg-opacity-25"
    :style="'background-image: url(\'' + setting.frontend_background + '\');'"
  >
    <div class="flex w-full h-screen items-center bg-slate-200 bg-opacity-50">
      <div class="mx-auto w-full md:w-1/3">
        <div class="flex flex-col text-slate-300 justify-center text-center">
          <div class="flex justify-center mb-5">
            <ApplicationLogo class="w-32" />
          </div>
          <p class="text-2xl mb-5">
            {{ setting.name }}
          </p>
          <p class="mb-5">
            {{ setting.description }}
          </p>
          <div class="flex justify-center">
            <Link :href="route('login')" class="btn-main w-1/2"> Masuk </Link>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</template>
