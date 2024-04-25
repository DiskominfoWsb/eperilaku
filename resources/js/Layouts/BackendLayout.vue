<script setup>
import { ref } from 'vue'
import {
  ChevronDownIcon,
  Bars4Icon,
  UserIcon,
  ArrowRightOnRectangleIcon
} from '@heroicons/vue/24/outline'
import { Link } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue'
import SidebarMenu from '@/Components/SidebarMenu.vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'

const isOpen = ref(false)
</script>

<template>
  <div class="flex flex-row w-full h-screen mx-auto">
    <transition class="fixed h-screen bg-gray-50 print:hidden" name="slide">
      <div
        class="flex-col duration-500 transform shadow"
        :class="isOpen ? 'translate-x-0 w-64' : '-translate-x-64 w-0'"
      >
        <div class="w-64">
          <div class="flex items-center justify-center">
            <ApplicationLogo class="w-1/2 py-3" />
          </div>
          <span
            class="block mb-1 text-xs font-bold text-center text-gray-400 uppercase"
            >{{ $page.props.setting.name }}</span
          >
          <span
            class="block mt-1 text-xs font-bold text-center text-gray-400 uppercase"
            >{{ $page.props.setting.description }}</span
          >
        </div>
        <nav class="flex mt-5">
          <div class="w-full text-gray-700 bg-colors-orange-500">
            <SidebarMenu />
          </div>
        </nav>
      </div>
    </transition>

    <div
      class="w-full h-screen text-gray-500 duration-500 transform dark:bg-gray-800"
      :class="isOpen ? 'ml-64' : ''"
    >
      <div
        class="flex items-center justify-between h-12 px-6 border-b print:hidden"
      >
        <button @click="isOpen = !isOpen">
          <Bars4Icon class="w-5 h-5" />
        </button>
        <div class="flex flex-row" :class="isOpen ? 'hidden md:flex' : 'flex'">
          <dropdown class="mr-5">
            <template #trigger>
              <div class="flex items-center h-12 cursor-pointer">
                <img
                  v-if="$page.props.auth.user.photo"
                  :src="'/upload/profile/' + $page.props.auth.user.photo"
                  class="w-8 h-8 rounded-full"
                  alt=""
                />
                <img
                  v-else
                  src="/upload/profile/default.png"
                  class="w-8 h-8 rounded-full"
                  alt=""
                />
                <div class="hidden ml-3 mr-3 md:block">
                  {{ $page.props.auth.user.name }}
                </div>
                <ChevronDownIcon
                  class="hidden w-4 h-4 text-gray-500 md:block"
                />
              </div>
            </template>

            <template #content>
              <div class="text-xs bg-gray-50">
                <div class="block px-4 py-2 text-xs text-gray-400">
                  Manage Account
                </div>
                <Link
                  :href="route('me')"
                  class="flex items-center px-3 py-2 font-semibold text-indigo-500 hover:bg-indigo-500 hover:text-white"
                >
                  <UserIcon class="w-4 h-4" />
                  <div class="ml-2">Profile</div>
                </Link>
                <hr />
                <Link
                  :href="route('logout')"
                  method="post"
                  as="button"
                  class="flex items-center w-full px-3 py-2 font-semibold text-indigo-500 hover:bg-indigo-500 hover:text-white"
                >
                  <ArrowRightOnRectangleIcon class="w-4 h-4" />
                  <div class="ml-2">Logout</div>
                </Link>
              </div>
            </template>
          </dropdown>
        </div>
      </div>
      <main class="h-12 text-gray-500 dark:bg-gray-800">
        <div class="py-3">
          <div class="w-full px-3">
            <slot />
          </div>
        </div>
      </main>
    </div>
  </div>
</template>
