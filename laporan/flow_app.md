1. Membuat Database dan Tabels

```mermaid
graph TD
  A[A.Membuat Database] -->|Jika Belum Ada| B(B.Membuat Tabel Pekerjaan)
  B --> C(C.Membuat Tabel Atasan-Bawahan)
  C --> D(D.Membuat Tabel Proses Pengerjaan)
```

*A.Membuat Database*
```
-- Membuat Database (jika belum ada)
CREATE DATABASE IF NOT EXISTS NamaDatabase;
```
*B.Membuat Tabel Pekerjaan*
```
-- Tabel Pekerjaan
CREATE TABLE IF NOT EXISTS TabelPekerjaan (
    ID_Pekerjaan INT AUTO_INCREMENT PRIMARY KEY,
    Jabatan VARCHAR(50) NOT NULL,
    Gaji DECIMAL(10, 2),
    DapatDiIntervensi BOOLEAN DEFAULT TRUE,
    KemajuanPekerjaan INT DEFAULT 0,
    CONSTRAINT UQ_Jabatan UNIQUE (Jabatan)
);
```
*C.Membuat Tabel Atasan-Bawahan*
```
-- Tabel Atasan-Bawahan (Relasi)
CREATE TABLE IF NOT EXISTS TabelAtasanBawahan (
    ID_Atasan INT,
    ID_Bawahan INT,
    PRIMARY KEY (ID_Atasan, ID_Bawahan),
    FOREIGN KEY (ID_Atasan) REFERENCES TabelPekerjaan (ID_Pekerjaan),
    FOREIGN KEY (ID_Bawahan) REFERENCES TabelPekerjaan (ID_Pekerjaan)
);
```
*D.Membuat Tabel Proses Pengerjaan*
```
-- Tabel ProsesPengerjaan
CREATE TABLE IF NOT EXISTS TabelProsesPengerjaan (
    ID_Proses INT AUTO_INCREMENT PRIMARY KEY,
    ID_Pekerjaan INT,
    KemajuanPengerjaan INT DEFAULT 0,
    TanggalSelesai DATE,
    FOREIGN KEY (ID_Pekerjaan) REFERENCES TabelPekerjaan (ID_Pekerjaan)
);
```
**2. Menambahkan Pekerjaan dari Atasan**


```mermaid
graph TD
  A[Memulai] --> B(Mengecek Pekerjaan Atasan)
  B -->|Tidak Ada| C(Menambahkan Pekerjaan Atasan)
  B -->|Ada| D(Menggunakan Pekerjaan Atasan)
  C --> E(Memperbarui Kemajuan Pekerjaan)
```

3. Menambahkan Proses Pengerjaan

```mermaid
graph TD
  A[Menggunakan Pekerjaan] --> B(Mengecek Proses Pengerjaan)
  B -->|Tidak Ada| C(Menambahkan Proses Pengerjaan)
  B -->|Ada| D(Melanjutkan Proses Pengerjaan)
  C --> E(Selesai)
```
