<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
</script>

<template>
    <div class="min-h-screen flex sm:justify-center items-center bg-gray-100">
      <div class="flex flex-col justify-center items-center px-3 w-full md:w-1/4">
        <div>
          <Link href="/">
            <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
          </Link>
        </div>

        <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden">
          <slot />
        </div>
      </div>
    </div>
  </template>
