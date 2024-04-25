<script setup>
import { PlusIcon, XCircleIcon } from '@heroicons/vue/24/solid'
import { useForm } from '@inertiajs/vue3';
import toastr from 'toastr'
import { onMounted, ref } from 'vue'
import TambahEkspektasiDariPimpinan from '../Ekspektasi/TambahEkspektasiDariPimpinan.vue'
import listEkpektasi from '@/services/listEkpektasi'

const open = ref(false)
const jenis = ref('')
const loading = ref(true)
const props = defineProps({
  skp: {
    type: Object,
    default: null
  },
  isPenilai: {
    type: Boolean,
    default: false
  }
})

const openFrom = jenisPerilaku => {
  jenis.value = jenisPerilaku
  open.value = true
}

const closeFrom = () => {
  jenis.value = ''
  open.value = false
  buildData()
}

const perilaku = ref({
  pelayanans: [],
  akuntabels: [],
  kompetens: [],
  harmonis: [],
  loyals: [],
  adaptifs: [],
  kolaboratifs: []
})

const formDelete = useForm({
  id: ''
})
onMounted(async () => {
  buildData()
})
const buildData = async () => {
  perilaku.value.pelayanans = await listEkpektasi(props.skp.id, 'pelayanan')
  perilaku.value.akuntabels = await listEkpektasi(props.skp.id, 'akuntabel')
  perilaku.value.kompetens = await listEkpektasi(props.skp.id, 'kompeten')
  perilaku.value.harmonis = await listEkpektasi(props.skp.id, 'harmonis')
  perilaku.value.loyals = await listEkpektasi(props.skp.id, 'loyal')
  perilaku.value.adaptifs = await listEkpektasi(props.skp.id, 'adaptif')
  perilaku.value.kolaboratifs = await listEkpektasi(props.skp.id, 'kolaboratif')
  loading.value = false
}

const deleteData = id => {
  formDelete.id = id
  formDelete.delete(route('ekspektasi.destroy', id), {
    preserveState: true,
    preserveScroll: true,
    onSuccess: async () => {
      toastr.info('berhasil di hapus', 'success')
      await buildData()
    }
  })
}
</script>
<template>
  <div class="overflow-x-auto">
    <table class="table w-full mt-5 text-sm">
      <tr class="font-semibold text-white bg-blue-400">
        <td colspan="4" class="w-0 py-2 whitespace-nowrap">PERILAKU KERJA</td>
      </tr>
      <tr v-if="loading">
        <td colspan="4" class="h-12">
          <div role="status" class="flex justify-center w-full">
            <svg
              aria-hidden="true"
              class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
              viewBox="0 0 100 101"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="currentColor"
              />
              <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="currentFill"
              />
            </svg>
            <span>Loading...</span>
          </div>
        </td>
      </tr>
      <template v-else>
        <!-- #region PELAYANAN -->
        <tr>
          <td class="w-0 align-top border-t-0" rowspan="4">1</td>
          <td class="border-t-0">Berorientasi pelayanan</td>
          <td class="hidden border-t-0 md:table-cell">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr>
          <td class="text-sm align-top">
            <p class="border-b">- Memahami dan memenuhi kebutuhan masyarakat</p>
            <p class="border-b">
              - Ramah, cekatan, solutif, dan dapat diandalkan
            </p>
            <p class="border-b">- Melakukan perbaikan tiada henti</p>
          </td>
          <td class="hidden py-0 align-top md:table-cell">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right mt-2 mr-2"
              @click="openFrom('pelayanan')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <p
              v-for="data in perilaku.pelayanans"
              :key="data"
              class="flex items-center py-2 align-middle border-b"
            >
              {{ data.ekspektasi_atasan }}
              <button
                v-if="isPenilai"
                class="ml-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="table-cell md:hidden">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr>
          <td colspan="2" class="table-cell md:hidden">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right"
              @click="openFrom('pelayanan')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <div
              v-for="data in perilaku.pelayanans"
              :key="data"
              class="flex w-full py-2 border-b"
            >
              <button
                v-if="isPenilai"
                class="mr-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
              {{ data.ekspektasi_atasan }}
            </div>
          </td>
        </tr>
        <!-- #endregion PELAYANAN -->
        <!-- #region AKUNTABEL -->
        <tr>
          <td class="w-0 align-top border-t-0" rowspan="4">2</td>
          <td class="border-t-0">Akuntabel</td>
          <td class="hidden border-t-0 md:table-cell">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr>
          <td class="text-sm align-top">
            <p class="border-b">
              - Melaksanakan tugas dengan jujur, bertanggungjawab, cermat,
              disiplin dan berintegritas tinggi
            </p>
            <p class="border-b">
              - Menggunakan kekayaan dan barang milik negara secara
              bertanggungjawab, efektif, dan efisien
            </p>
            <p>- Tidak menyalahgunakan kewenangan jabatan</p>
          </td>
          <td class="hidden py-0 align-top md:table-cell">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right mt-2 mr-2"
              @click="openFrom('akuntabel')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <p
              v-for="data in perilaku.akuntabels"
              :key="data"
              class="flex items-center py-2 align-middle border-b"
            >
              {{ data.ekspektasi_atasan }}
              <button
                v-if="isPenilai"
                class="ml-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="table-cell md:hidden">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr>
          <td colspan="2" class="table-cell md:hidden">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right"
              @click="openFrom('akuntabel')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <div
              v-for="data in perilaku.akuntabels"
              :key="data"
              class="flex w-full py-2 border-b"
            >
              <button
                v-if="isPenilai"
                class="mr-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
              {{ data.ekspektasi_atasan }}
            </div>
          </td>
        </tr>
        <!-- #endregion AKUNTABEL -->
        <!-- #region KOMPETEN -->
        <tr>
          <td class="w-0 align-top border-t-0" rowspan="4">3</td>
          <td class="border-t-0">Kompeten</td>
          <td class="hidden border-t-0 md:table-cell">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr>
          <td class="text-sm align-top">
            <p class="border-b">
              - Meningkatkan kompetensi diri untuk menjawab tantangan yang
              selalu berubah
            </p>
            <p class="border-b">- Membantu orang lain belajar</p>
            <p>- Melaksanakan tugas dengan kualitas terbaik</p>
          </td>
          <td class="hidden py-0 align-top md:table-cell">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right mt-2 mr-2"
              @click="openFrom('kompeten')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <p
              v-for="data in perilaku.kompetens"
              :key="data"
              class="flex items-center py-2 align-middle border-b"
            >
              {{ data.ekspektasi_atasan }}
              <button
                v-if="isPenilai"
                class="ml-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="table-cell md:hidden">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr>
          <td colspan="2" class="table-cell md:hidden">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right"
              @click="openFrom('Kompeten')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <div
              v-for="data in perilaku.kompetens"
              :key="data"
              class="flex w-full py-2 border-b"
            >
              <button
                v-if="isPenilai"
                class="mr-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
              {{ data.ekspektasi_atasan }}
            </div>
          </td>
        </tr>
        <!-- #endregion KOMPETEN -->
        <!-- #region HARMONIS -->
        <tr>
          <td class="w-0 align-top border-t-0" rowspan="4">4</td>
          <td class="border-t-0">Harmonis</td>
          <td class="hidden border-t-0 md:table-cell">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr>
          <td class="text-sm align-top">
            <p class="border-b">
              - Meningkatkan kompetensi diri untuk menjawab tantangan yang
              selalu berubah
            </p>
            <p class="border-b">- Membantu orang lain belajar</p>
            <p>- Melaksanakan tugas dengan kualitas terbaik</p>
          </td>
          <td class="hidden py-0 align-top md:table-cell">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right mt-2 mr-2"
              @click="openFrom('kompeten')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <p
              v-for="data in perilaku.kompetens"
              :key="data"
              class="flex items-center py-2 align-middle border-b"
            >
              {{ data.ekspektasi_atasan }}
              <button
                v-if="isPenilai"
                class="ml-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="table-cell md:hidden">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr>
          <td colspan="2" class="table-cell md:hidden">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right"
              @click="openFrom('Kompeten')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <div
              v-for="data in perilaku.kompetens"
              :key="data"
              class="flex w-full py-2 border-b"
            >
              <button
                v-if="isPenilai"
                class="mr-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
              {{ data.ekspektasi_atasan }}
            </div>
          </td>
        </tr>
        <!-- #endregion HARMONIS -->
        <!-- #region LOYAL -->
        <tr>
          <td class="w-0 align-top border-t-0" rowspan="4">5</td>
          <td class="border-t-0">Loyal</td>
          <td class="hidden border-t-0 md:table-cell">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr>
          <td class="text-sm align-top">
            <p class="border-b">
              - Meningkatkan kompetensi diri untuk menjawab tantangan yang
              selalu berubah
            </p>
            <p class="border-b">- Membantu orang lain belajar</p>
            <p>- Melaksanakan tugas dengan kualitas terbaik</p>
          </td>
          <td class="hidden py-0 align-top md:table-cell">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right mt-2 mr-2"
              @click="openFrom('kompeten')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <p
              v-for="data in perilaku.kompetens"
              :key="data"
              class="flex items-center py-2 align-middle border-b"
            >
              {{ data.ekspektasi_atasan }}
              <button
                v-if="isPenilai"
                class="ml-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="table-cell md:hidden">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr>
          <td colspan="2" class="table-cell md:hidden">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right"
              @click="openFrom('Kompeten')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <div
              v-for="data in perilaku.kompetens"
              :key="data"
              class="flex w-full py-2 border-b"
            >
              <button
                v-if="isPenilai"
                class="mr-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
              {{ data.ekspektasi_atasan }}
            </div>
          </td>
        </tr>
        <!-- #endregion LOYAL -->
        <!-- #region ADAPTIF -->
        <tr>
          <td class="w-0 align-top border-t-0" rowspan="4">6</td>
          <td class="border-t-0">Adaptif</td>
          <td class="hidden border-t-0 md:table-cell">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr>
          <td class="text-sm align-top">
            <p class="border-b">
              - Meningkatkan kompetensi diri untuk menjawab tantangan yang
              selalu berubah
            </p>
            <p class="border-b">- Membantu orang lain belajar</p>
            <p>- Melaksanakan tugas dengan kualitas terbaik</p>
          </td>
          <td class="hidden py-0 align-top md:table-cell">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right mt-2 mr-2"
              @click="openFrom('kompeten')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <p
              v-for="data in perilaku.kompetens"
              :key="data"
              class="flex items-center py-2 align-middle border-b"
            >
              {{ data.ekspektasi_atasan }}
              <button
                v-if="isPenilai"
                class="ml-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="table-cell md:hidden">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr class="table-row">
          <td colspan="2" class="table-cell md:hidden">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right"
              @click="openFrom('Kompeten')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <div
              v-for="data in perilaku.kompetens"
              :key="data"
              class="flex w-full py-2 border-b"
            >
              <button
                v-if="isPenilai"
                class="mr-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
              {{ data.ekspektasi_atasan }}
            </div>
          </td>
        </tr>
        <!-- #endregion ADAPTIF -->
        <!-- #region KOLABORATIF -->
        <tr>
          <td class="w-0 align-top border-t-0" rowspan="4">7</td>
          <td class="border-t-0">Kolaboratif</td>
          <td class="hidden border-t-0 md:table-cell">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr>
          <td class="text-sm align-top">
            <p class="border-b">
              - Meningkatkan kompetensi diri untuk menjawab tantangan yang
              selalu berubah
            </p>
            <p class="border-b">- Membantu orang lain belajar</p>
            <p>- Melaksanakan tugas dengan kualitas terbaik</p>
          </td>
          <td class="hidden py-0 align-top md:table-cell">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right mt-2 mr-2"
              @click="openFrom('kolaboratif')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <p
              v-for="data in perilaku.kompetens"
              :key="data"
              class="flex items-center py-2 align-middle border-b"
            >
              {{ data.ekspektasi_atasan }}
              <button
                v-if="isPenilai"
                class="ml-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
            </p>
          </td>
        </tr>
        <tr>
          <td colspan="2" class="table-cell md:hidden">
            Ekspektasi Khusus Pimpinan :
          </td>
        </tr>
        <tr class="table-row">
          <td colspan="2" class="table-cell md:hidden">
            <button
              v-if="isPenilai"
              class="p-1.5 bg-green-500 float-right"
              @click="openFrom('Kompeten')"
            >
              <PlusIcon class="w-5 h-5 text-white" />
            </button>
            <div
              v-for="data in perilaku.kompetens"
              :key="data"
              class="flex w-full py-2 border-b"
            >
              <button
                v-if="isPenilai"
                class="mr-2 print:hidden"
                @click="deleteData(data.id)"
              >
                <XCircleIcon class="w-5 h-5 text-red-500" />
              </button>
              {{ data.ekspektasi_atasan }}
            </div>
          </td>
        </tr>
        <!-- #endregion KOLABORATIF -->
      </template>
    </table>
  </div>
  <TambahEkspektasiDariPimpinan
    :show="open"
    :skp-id="skp.id"
    :jenis="jenis"
    @close="closeFrom"
  />
</template>

<style scoped>
.table-border-none {
  border-collapse: collapse;
}

.table-border-none td {
  border: 2;
}
</style>
