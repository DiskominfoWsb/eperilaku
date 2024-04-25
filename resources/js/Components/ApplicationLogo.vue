<script setup>

import { usePage } from "@inertiajs/vue3";

</script>
<template>
    <img class="w-full h-full" :src="'/' + usePage().props.setting.logo" alt="Logo" />
</template>
