<script setup>
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'

ChartJS.register(ArcElement, Tooltip, Legend)

const data = {
  labels: ['Istimewa', 'Baik', 'Butuh Perbaikan', 'Kurang', 'Sangat Kurang'],
  datasets: [
    {
      backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16', '#DD1B22'],
      data: [40, 20, 80, 3, 2]
    }
  ]
}
const options = {
  responsive: true,
  maintainAspectRatio: false,
  onclick: function (e, tooltipItems) {
    console.log(e)
    console.log(tooltipItems)
  }
}
</script>

<template>
  <div class="w-full border">
    <div class="px-3 py-2 text-xs uppercase bg-blue-400 text-gray-50">
      <label>Rating Skp</label>
    </div>
    <div class="container p-3">
      <Pie :data="data" :options="options" class="cursor-pointer" />
    </div>
  </div>
</template>

<style scoped></style>
