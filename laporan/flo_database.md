```mermaid
graph TD;
  A[Create Database] -->|Use| B[NamaDatabase]
  B -->|Create Table| C[TabelPekerjaan]
  B -->|Create Table| D[TabelAtasanBawahan]
  C -->|Insert Data| E[Data TabelPekerjaan]
  D -->|Insert Data| F[Data TabelAtasanBawahan]
  C -->|Create Table| G[TabelProsesPengerjaan]
  G -->|Insert Data| H[Data TabelProsesPengerjaan]
```
-------------------------------

```mermaid
graph TD
  A[Memulai] -->|Mengecek Database| B(Mengecek Database)
  B -->|Database Tidak Ada| C(Membuat Database)
  B -->|Database Ada| D(Menggunakan Database)
  C --> D
  D --> E[Proses Pekerjaan]
  E --> F(Tabel Pekerjaan)
  E --> G(Tabel Atasan-Bawahan)
  E --> H(Tabel Proses Pengerjaan)
  F -->|Memeriksa| I(Pekerjaan dari Atasan)
  I -->|Tidak Ada| J(Menambahkan Pekerjaan Atasan)
  I -->|Ada| K(Menggunakan Pekerjaan Atasan)
  K --> L(Memperbarui Kemajuan Pekerjaan)
  L --> M(Tabel Proses Pengerjaan)
  M --> N(Menambahkan Proses Pengerjaan)
  N --> O(Selesai)

```

--------------------

**Diagram Alur Data (DFD)**
External Entity adalah entitas eksternal yang berinteraksi dengan sistem, seperti pengguna atau entitas luar sistem.
Proses merepresentasikan aktivitas atau langkah-langkah yang dilakukan dalam sistem.

Database menunjukkan penyimpanan data.
Panah dengan label angka menunjukkan urutan aliran data atau langkah-langkah dalam sistem.

Penjelasan langkah-langkah dalam DFD ini:

Data pekerjaan diinput ke dalam sistem oleh entitas eksternal.
Data pekerjaan disimpan di dalam tabel pekerjaan dan tabel atasan-bawahan.
Proses mengambil data pekerjaan dari tabel pekerjaan dan tabel atasan-bawahan.

Hasil data pekerjaan dikeluarkan sebagai output untuk entitas eksternal.
Data proses pengerjaan diinput ke dalam sistem oleh entitas eksternal.
Data proses pengerjaan disimpan di dalam tabel proses pengerjaan.
Proses mengambil data proses pengerjaan dari tabel proses pengerjaan.
Hasil data proses pengerjaan dikeluarkan sebagai output untuk entitas eksternal.

```mermaid
graph TD;
  A[External Entity] -->|1. Input Data| B[Proses: Input Pekerjaan]
  B -->|2. Simpan Data| C[Database: TabelPekerjaan]
  B -->|3. Simpan Data| D[Database: TabelAtasanBawahan]
  C -->|4. Retrieve Data| E[Proses: Retrieve Pekerjaan]
  D -->|5. Retrieve Data| E
  E -->|6. Output Data| F[External Entity]

  G[External Entity] -->|7. Input Data| H[Proses: Input Proses Pengerjaan]
  H -->|8. Simpan Data| I[Database: TabelProsesPengerjaan]
  I -->|9. Retrieve Data| J[Proses: Retrieve Proses Pengerjaan]
  J -->|10. Output Data| G

```
