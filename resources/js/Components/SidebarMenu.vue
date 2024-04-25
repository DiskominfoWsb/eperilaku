<script setup>
/* eslint vue/no-multiple-template-root : 'off' */
import {
  UsersIcon,
  Cog6ToothIcon,
  ComputerDesktopIcon,
  DocumentTextIcon,
  UserGroupIcon
} from '@heroicons/vue/24/outline'
import SideNavItem from '@/Components/SideNavItem.vue'
import Permission from '@/Components/Permission.vue'
</script>

<template>
  <SideNavItem level="label" title="Main Menu" />
  <SideNavItem level="menu" title="Dashboard" url="dashboard">
    <template #icon>
      <ComputerDesktopIcon class="w-5 h-5" />
    </template>
  </SideNavItem>
  <SideNavItem level="menu" title="SKP" url="skp.index">
    <template #icon>
      <DocumentTextIcon class="w-5 h-5" />
    </template>
  </SideNavItem>
  <Permission can="view_monitor">
    <SideNavItem level="label" title="Monitoring" />
    <SideNavItem level="menu" title="Pengisian" url="skp.monitor">
      <template #icon>
        <ComputerDesktopIcon class="w-5 h-5" />
      </template>
    </SideNavItem>
  </Permission>
  <Permission can="edit_users">
    <SideNavItem level="label" title="ADMINISTRATION" />
    <SideNavItem level="menu" title="Instansi" url="instansi.index">
      <template #icon>
        <UsersIcon class="w-5 h-5" />
      </template>
    </SideNavItem>
    <SideNavItem level="menu" title="Pegawai" url="pegawai.index">
      <template #icon>
        <UsersIcon class="w-5 h-5" />
      </template>
    </SideNavItem>
    <SideNavItem level="menu" title="Level" url="roles.index">
      <template #icon>
        <UserGroupIcon class="w-5 h-5" />
      </template>
    </SideNavItem>
    <SideNavItem level="menu" title="Setting" url="settings">
      <template #icon>
        <Cog6ToothIcon class="w-5 h-5" />
      </template>
    </SideNavItem>
  </Permission>
</template>
