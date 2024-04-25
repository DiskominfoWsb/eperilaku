<script setup>
defineProps({
  pegawai: { type: Object, default: null }
})
</script>

<template>
  <table class="w-full text-xs mt-4">
    <tr>
      <td class="border-none px-0 whitespace-nowrap uppercase" colspan="3">
        {{ pegawai.instansi }}
      </td>
    </tr>
    <tr>
      <td class="w-0 whitespace-nowrap">NO</td>
      <td colspan="2">PEGAWAI YANG DINILAI</td>
    </tr>
    <tr>
      <td>1</td>
      <td class="w-0 whitespace-nowrap">NAMA</td>
      <td>
        {{ pegawai?.nama_formatted }}
      </td>
    </tr>
    <tr>
      <td>2</td>
      <td>NIP</td>
      <td>{{ pegawai?.nip }}</td>
    </tr>
    <tr>
      <td>3</td>
      <td>PANGKAT/GOL</td>
      <td>{{ pegawai.golongan.golongan_name_formatted }}</td>
    </tr>
    <tr>
      <td>4</td>
      <td>JABATAN</td>
      <td>{{ pegawai.jabatan }}</td>
    </tr>
    <tr>
      <td>5</td>
      <td>UNIT KERJA</td>
      <td>{{ pegawai.instansi }}</td>
    </tr>
  </table>
</template>

<style scoped></style>
