import axios from 'axios'
export default async function listEkpektasi(skp, jenis) {
  const response = await axios.get(`/ekspektasi_data/${jenis}/${skp}`)
  const data = await response.data
  return data
}
