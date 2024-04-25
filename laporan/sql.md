-- Membuat Database (jika belum ada)
CREATE DATABASE IF NOT EXISTS NamaDatabase;

-- Menggunakan Database
USE NamaDatabase;

-- Tabel Pekerjaan
CREATE TABLE IF NOT EXISTS TabelPekerjaan (
    ID_Pekerjaan INT AUTO_INCREMENT PRIMARY KEY,
    Jabatan VARCHAR(50) NOT NULL,
    Gaji DECIMAL(10, 2),
    DapatDiIntervensi BOOLEAN DEFAULT TRUE,
    KemajuanPekerjaan INT DEFAULT 0,
    CONSTRAINT UQ_Jabatan UNIQUE (Jabatan)
);

-- Tabel Atasan-Bawahan (Relasi)
CREATE TABLE IF NOT EXISTS TabelAtasanBawahan (
    ID_Atasan INT,
    ID_Bawahan INT,
    PRIMARY KEY (ID_Atasan, ID_Bawahan),
    FOREIGN KEY (ID_Atasan) REFERENCES TabelPekerjaan (ID_Pekerjaan),
    FOREIGN KEY (ID_Bawahan) REFERENCES TabelPekerjaan (ID_Pekerjaan)
);

-- Menambahkan pekerjaan dari daftar atasan ke TabelPekerjaan
INSERT INTO TabelPekerjaan (Jabatan, Gaji, DapatDiIntervensi)
VALUES
    ('Manajer Proyek', 60000.00, TRUE),
    ('Analyst Keuangan', 55000.00, TRUE);

-- Contoh data untuk TabelPekerjaan
INSERT INTO TabelPekerjaan (Jabatan, Gaji, DapatDiIntervensi)
VALUES
    ('Programmer', 50000.00, TRUE),
    ('Desainer', 45000.00, FALSE);

-- Menambahkan relasi atasan-bawahan
INSERT INTO TabelAtasanBawahan (ID_Atasan, ID_Bawahan)
VALUES
    (1, 3), -- Manajer Proyek dan Programmer
    (1, 4); -- Manajer Proyek dan Desainer;

-- Memperbarui kemajuan pekerjaan (10%)
UPDATE TabelPekerjaan
SET KemajuanPekerjaan = 10
WHERE Jabatan = 'Programmer';

UPDATE TabelPekerjaan
SET KemajuanPekerjaan = 10
WHERE Jabatan = 'Desainer';

-- Tabel ProsesPengerjaan
CREATE TABLE IF NOT EXISTS TabelProsesPengerjaan (
    ID_Proses INT AUTO_INCREMENT PRIMARY KEY,
    ID_Pekerjaan INT,
    KemajuanPengerjaan INT DEFAULT 0,
    TanggalSelesai DATE,
    FOREIGN KEY (ID_Pekerjaan) REFERENCES TabelPekerjaan (ID_Pekerjaan)
);

-- Contoh data untuk TabelProsesPengerjaan
INSERT INTO TabelProsesPengerjaan (ID_Pekerjaan, KemajuanPengerjaan, TanggalSelesai)
VALUES
    (1, 10, '2022-01-15'), -- Manajer Proyek dengan 10% kemajuan pada tanggal 15 Januari 2022
    (2, 20, '2022-02-01'); -- Analyst Keuangan dengan 20% kemajuan pada tanggal 1 Februari 2022;
