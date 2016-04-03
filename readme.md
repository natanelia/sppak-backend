# SPPAK e-Gov (backend)
An e-government project for birth administration.
SPPAK stands for "Sistem Pencatatan dan Pembuatan Akta Kelahiran".

This is not real system and is build for course completion only.

## Installation
- Follow installation steps from [Laravel Installation Instructions](https://laravel.com/docs/5.2/installation).
- Import MySQL database `db_ppl_core`.
- Create new MySQL database named `sppak`.
- Rename .env.example to .env. 
- Configure DB_HOST, DB_DATABASE=sppak, DB_USERNAME, DB_PASSWORD.
- Run `php artisan key:generate`
- Run `composer install`.
- Run `php artisan migrate`.

## API Documentation
<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
**Table of Contents**

- [Semua Pengguna](#semua-pengguna)
  - [Mendapatkan data pribadi](#mendapatkan-data-pribadi)
    - [Request](#request)
    - [Response](#response)
  - [Melihat daftar penduduk](#melihat-daftar-penduduk)
    - [Request](#request-1)
    - [Response](#response-1)
  - [Melihat satu penduduk](#melihat-satu-penduduk)
    - [Request](#request-2)
    - [Response](#response-2)
  - [Melihat daftar permohonan akta kelahiran](#melihat-daftar-permohonan-akta-kelahiran)
    - [Request](#request-3)
    - [Response](#response-3)
  - [Melihat satu permohonan akta kelahiran](#melihat-satu-permohonan-akta-kelahiran)
    - [Request](#request-4)
    - [Response](#response-4)
- [Penduduk](#penduduk)
  - [Melakukan pendaftaran](#melakukan-pendaftaran)
    - [Request](#request-5)
    - [Response](#response-5)
  - [Akta kelahiran](#akta-kelahiran)
    - [Membuat permohonan](#membuat-permohonan)
      - [Request](#request-6)
      - [Response](#response-6)
    - [Mengedit permohonan](#mengedit-permohonan)
      - [Request](#request-7)
      - [Response](#response-7)
    - [Menghapus permohonan](#menghapus-permohonan)
      - [Request](#request-8)
      - [Response](#response-8)
- [Kelurahan](#kelurahan)
  - [Verifikasi kelahiran](#verifikasi-kelahiran)
    - [Request](#request-9)
    - [Response](#response-9)
- [Instansi Kesehatan](#instansi-kesehatan)
  - [Verifikasi kelahiran](#verifikasi-kelahiran-1)
    - [Request](#request-10)
    - [Response](#response-10)
- [Saksi](#saksi)
  - [Verifikasi kelahiran](#verifikasi-kelahiran-2)
- [Pegawai](#pegawai)
  - [Verifikasi kelahiran](#verifikasi-kelahiran-3)
    - [Request](#request-11)
    - [Response](#response-11)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

### Semua Pengguna
#### Mendapatkan data pribadi
##### Request
```HTTP
GET /api/v1/pengguna/1 HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206cmFoYXNpYQ==
```

##### Response
```json
{
  "data": {
    "id": 1,
    "email": "natanelia7@gmail.com",
    "userable_id": "3573041003950011",
    "userable_type": "MorphPenduduk",
    "created_at": "2016-03-31 14:52:11",
    "updated_at": null,
    "userable": {
      "id": 3573041003950011,
      "nama": "Natan",
      "tanggal_lahir": "1995-03-10",
      "tempat_lahir": "37",
      "jenis_kelamin": "",
      "id_keluarga": null,
      "id_ayah": null,
      "id_ibu": null,
      "hubungan_keluarga": "Anak",
      "golongan_darah": "B",
      "agama": "Kristen",
      "wni": "1",
      "status_perkawinan": "",
      "pekerjaan": "Mahasiswa",
      "pendidikan": "Sekolah Menengah",
      "id_izin_tetap": null,
      "id_passport": null,
      "created_at": "2016-03-31 14:48:42",
      "status": "1"
    }
  }
}
```

#### Melihat daftar penduduk
##### Request
```HTTP
GET /api/v1/penduduk HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206cmFoYXNpYQ==
```

##### Response
```json
{
  "data": [
    {
      "id": 3573041003950011,
      "nama": "Natan",
      "tanggal_lahir": "1995-03-10",
      "tempat_lahir": "37",
      "jenis_kelamin": "",
      "id_keluarga": null,
      "id_ayah": null,
      "id_ibu": null,
      "hubungan_keluarga": "Anak",
      "golongan_darah": "B",
      "agama": "Kristen",
      "wni": "1",
      "status_perkawinan": "",
      "pekerjaan": "Mahasiswa",
      "pendidikan": "Sekolah Menengah",
      "id_izin_tetap": null,
      "id_passport": null,
      "created_at": "2016-03-31 14:48:42",
      "status": "1",
      "pengguna": {
        "id": 1,
        "email": "natanelia7@gmail.com",
        "userable_id": "3573041003950011",
        "userable_type": "MorphPenduduk",
        "created_at": "2016-03-31 14:52:11",
        "updated_at": null
      }
    },
    {
      "id": 3573041003950012,
      "nama": "Juol",
      "tanggal_lahir": "1995-05-20",
      "tempat_lahir": "37",
      "jenis_kelamin": "l",
      "id_keluarga": "1",
      "id_ayah": "3573041003950011",
      "id_ibu": null,
      "hubungan_keluarga": "Cucu",
      "golongan_darah": "A",
      "agama": "Islam",
      "wni": "1",
      "status_perkawinan": "",
      "pekerjaan": "Gabut",
      "pendidikan": "SD",
      "id_izin_tetap": null,
      "id_passport": null,
      "created_at": "2016-04-02 09:46:08",
      "status": "1"
    }
  ]
}
```

#### Melihat satu penduduk
##### Request
```HTTP
GET /api/v1/penduduk/3573041003950012 HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206cmFoYXNpYQ==
```

##### Response
```json
{
  "data": {
    "id": 3573041003950012,
    "nama": "Juol",
    "tanggal_lahir": "1995-05-20",
    "tempat_lahir": "37",
    "jenis_kelamin": "l",
    "id_keluarga": "1",
    "id_ayah": "3573041003950011",
    "id_ibu": null,
    "hubungan_keluarga": "Cucu",
    "golongan_darah": "A",
    "agama": "Islam",
    "wni": "1",
    "status_perkawinan": "",
    "pekerjaan": "Gabut",
    "pendidikan": "SD",
    "id_izin_tetap": null,
    "id_passport": null,
    "created_at": "2016-04-02 09:46:08",
    "status": "1"
  }
}
```


#### Melihat daftar permohonan akta kelahiran
Pengguna hanya bisa melihat daftar permohonan kelahiran sesuai dengan *privilege*-nya.

##### Request
```HTTP
GET /api/v1/kelahiran HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206cmFoYXNpYQ==
```

##### Response
```json
{
  "data": [
    {
      "id": 42,
      "anakId": "29",
      "kelurahanId": null,
      "instansiKesehatanId": null,
      "kartuKeluargaId": null,
      "aktaNikahId": null,
      "ibuId": "3573041003950011",
      "ayahId": "3573041003950011",
      "saksiSatuId": null,
      "saksiDuaId": null,
      "pemohonId": "3573041003950011",
      "status": "0",
      "verifikasiSaksi1": "0",
      "verifikasiSaksi2": "0",
      "verifikasiInstansiKesehatan": "0",
      "verifikasiLurah": "0",
      "verifikasiAdmin": "0",
      "waktuCetakTerakhir": "0000-00-00 00:00:00",
      "created_at": "2016-04-03 03:34:20",
      "updated_at": "2016-04-03 03:34:20",
      "anak": {
        "id": 29,
        "nama": "Joko",
        "jenisKelamin": "laki-laki",
        "kotaLahirId": "37",
        "waktuLahir": "0000-00-00 00:00:00",
        "jenisLahir": "",
        "anakKe": "0",
        "penolongKelahiran": "",
        "berat": "0",
        "panjang": "0"
      }
    }
  ]
}
```

#### Melihat satu permohonan akta kelahiran
Pengguna hanya bisa melihat permohonan kelahiran sesuai dengan *privilege*-nya.

##### Request
```HTTP
GET /api/v1/kelahiran/42 HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206cmFoYXNpYQ==
```

##### Response
```json
{
  "data": {
    "id": 42,
    "anakId": "29",
    "kelurahanId": null,
    "instansiKesehatanId": null,
    "kartuKeluargaId": null,
    "aktaNikahId": null,
    "ibuId": "3573041003950011",
    "ayahId": "3573041003950011",
    "saksiSatuId": null,
    "saksiDuaId": null,
    "pemohonId": "3573041003950011",
    "status": "0",
    "verifikasiSaksi1": "0",
    "verifikasiSaksi2": "0",
    "verifikasiInstansiKesehatan": "0",
    "verifikasiLurah": "0",
    "verifikasiAdmin": "0",
    "waktuCetakTerakhir": "0000-00-00 00:00:00",
    "created_at": "2016-04-03 03:34:20",
    "updated_at": "2016-04-03 03:34:20",
    "anak": {
      "id": 29,
      "nama": "Joko",
      "jenisKelamin": "laki-laki",
      "kotaLahirId": "37",
      "waktuLahir": "0000-00-00 00:00:00",
      "jenisLahir": "",
      "anakKe": "0",
      "penolongKelahiran": "",
      "berat": "0",
      "panjang": "0"
    }
  }
}
```

### Penduduk
#### Melakukan pendaftaran
##### Request
```HTTP
POST /api/v1/pengguna HTTP/1.1
Host: localhost:8000
Content-Type: application/json

{
    "email": "natan@outlook.com",
    "password": "rahasia",
    "userable_id": "3573041003950011",
    "userable_type": "MorphPenduduk"
}
```

##### Response
```json
{
  "message": "Berhasil membuat data pengguna."
}
```

#### Akta kelahiran
##### Membuat permohonan
###### Request
```HTTP
POST /api/v1/kelahiran HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206cmFoYXNpYQ==

{
    "anak": {
        "nama": "Joko",
        "jenisKelamin": "laki-laki",
        "kotaLahirId": 37,
        "waktuLahir": "2016-04-03T04:42:43.596Z",
        "jenisLahir": "Kembar Dua",
        "anakKe": 1,
        "penolongKelahiran": "Dokter",
        "berat": 2,
        "panjang": 40
    },
    "kartuKeluargaId": null,
    "aktaNikahId": null,
    "ibuId": "3573041003950011",
    "ayahId": "3573041003950011",
    "saksiSatuId": null,
    "saksiDuaId": null,
    "pemohonId": "3573041003950011",
    "waktuCetakTerakhir": "2016-04-03T04:42:43.596Z"
}
```

###### Response
```json
{
  "message": "Berhasil membuat data permohonan kelahiran."
}
```

##### Mengedit permohonan
###### Request
```HTTP
PATCH /api/v1/kelahiran/45 HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206cmFoYXNpYQ==

{
    "anak": {
        "nama": "Joko",
        "jenisKelamin": "laki-laki",
        "kotaLahirId": 37,
        "waktuLahir": "2016-04-03T04:42:43.596Z",
        "jenisLahir": "Kembar Dua",
        "anakKe": 1,
        "penolongKelahiran": "Dokter",
        "berat": 2,
        "panjang": 40
    },
    "kartuKeluargaId": null,
    "aktaNikahId": null,
    "ibuId": "3573041003950011",
    "ayahId": "3573041003950011",
    "saksiSatuId": null,
    "saksiDuaId": null,
    "pemohonId": "3573041003950011",
    "waktuCetakTerakhir": "2016-04-03T04:42:43.596Z"
}
```

###### Response
```json
{
  "message": "Berhasil menyimpan data kelahiran."
}
```

##### Menghapus permohonan
###### Request
```HTTP
DELETE /api/v1/kelahiran/45 HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206cmFoYXNpYQ==
```

###### Response
```json
{
  "message": "Berhasil menghapus data kelahiran."
}
```

### Kelurahan
#### Verifikasi kelahiran
Setelah semua verifikator melakukan verifikasi, `status` kelahiran akan otomatis bernilai 2 (disetujui).

##### Request
```HTTP
PATCH /api/v1/kelahiran/45 HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206cmFoYXNpYQ==

{
    "verifikasiLurah": 1
}
```

##### Response
```json
{
  "message": "Berhasil menyimpan data kelahiran."
}
```

### Instansi Kesehatan
#### Verifikasi kelahiran
Setelah semua verifikator melakukan verifikasi, `status` kelahiran akan otomatis bernilai 2 (disetujui).

##### Request
```HTTP
PATCH /api/v1/kelahiran/45 HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206cmFoYXNpYQ==

{
    "verifikasiInstansiKesehatan": 1
}
```

##### Response
```json
{
  "message": "Berhasil menyimpan data kelahiran."
}
```

### Saksi
#### Verifikasi kelahiran
```
TODO: Create specification
```

### Pegawai
Pegawai dapat melakukan segala hal, kecuali melakukan override terhadap verifikasi yang seharusnya dilakukan verifikator lain.

#### Verifikasi kelahiran
Setelah semua verifikator melakukan verifikasi, `status` kelahiran akan otomatis bernilai 2 (disetujui).
##### Request
```HTTP
PATCH /api/v1/kelahiran/45 HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206cmFoYXNpYQ==

{
    "verifikasiAdmin": 1
}
```

##### Response
```json
{
  "message": "Berhasil menyimpan data kelahiran."
}
```

## Technology Stack
This project is built with:
- Laravel 5.2
- PHP 5.6
- MySQL 5.6

## Contributors
We are students from *Institut Teknologi Bandung*, Indonesia:
- Devina Ekawati
- Fiqie Ulya
- Octavianus Marcel Harjono
- Natan
- Rahman Adianto
