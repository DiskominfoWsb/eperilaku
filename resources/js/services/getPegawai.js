import axios from 'axios'

export default async function getPegawai(nip) {
  const response = await axios.get(`/api/pegawai/${nip}`)
  const data = await response.data
  return data.data
}
