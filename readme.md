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

**Table of Contents**
- [Semua Pengguna](#semua-pengguna)
  - [Melakukan login](#melakukan-login)
  - [Melakukan pendaftaran](#melakukan-pendaftaran)
  - [Mengubah email](#mengubah-email)
  - [Mengubah password](#mengubah-password)
  - [Mendapatkan data pribadi](#mendapatkan-data-pribadi)
  - [Melihat daftar penduduk](#melihat-daftar-penduduk)
  - [Melihat satu penduduk](#melihat-satu-penduduk)
  - [Melihat daftar permohonan akta kelahiran](#melihat-daftar-permohonan-akta-kelahiran)
  - [Melihat satu permohonan akta kelahiran](#melihat-satu-permohonan-akta-kelahiran)
- [Penduduk](#penduduk)
  - [Akta kelahiran](#akta-kelahiran)
    - [Membuat permohonan](#membuat-permohonan)
    - [Mengedit permohonan](#mengedit-permohonan)
    - [Menghapus permohonan](#menghapus-permohonan)
- [Kelurahan](#kelurahan)
  - [Verifikasi kelahiran](#verifikasi-kelahiran)
- [Instansi Kesehatan](#instansi-kesehatan)
  - [Verifikasi kelahiran](#verifikasi-kelahiran-1)
- [Saksi](#saksi)
  - [Verifikasi kelahiran](#verifikasi-kelahiran-2)
- [Pegawai](#pegawai)
  - [Verifikasi kelahiran](#verifikasi-kelahiran-3)
  - [Melihat daftar permohonan dari pemohon](#melihat-daftar-permohonan-dari-pemohon)

### Semua Pengguna
#### Melakukan login
##### Request
```HTTP
GET /api/v1/pengguna/login HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic YWNlbEBnbWFpbC5jb206YWNlbGFjZWw=
```

##### Response
```json
{
  "data": {
    "id": 4,
    "email": "acel@gmail.com",
    "userable_id": "3573041003950013",
    "userable_type": "MorphPenduduk",
    "created_at": "2016-04-06 17:31:47",
    "updated_at": "2016-04-06 17:31:47"
  }
}
```

#### Melakukan pendaftaran
##### Request
```HTTP
POST /api/v1/pengguna HTTP/1.1
Host: localhost:8000
Content-Type: application/json

{
    "email": "email@example.com",
    "password": "rahasia",
    "userable_id": "3573041234567890",
    "userable_type": "MorphPenduduk"
}
```

##### Response
```json
{
  "message": "Berhasil membuat data pengguna."
}
```

#### Mengubah email
##### Request
```HTTP
POST /api/v1/pengguna/email HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206Z29vZ2xl

{
   "email": "email@example.com",
}
```

##### Response
```json
{
  "message": "Berhasil mengubah email."
}
```

#### Mengubah password
##### Request
```HTTP
POST /api/v1/pengguna/password HTTP/1.1
Host: localhost:8000
Content-Type: application/json
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206Z29vZ2xl

{
   "previousPassword": "google",
   "password": "rahasia"
}
```

##### Response
```json
{
  "message": "Berhasil mengubah password."
}
```

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
    "email": "email@example.com",
    "userable_id": "3573041234567890",
    "userable_type": "MorphPenduduk",
    "created_at": "2016-03-31 14:52:11",
    "updated_at": null,
    "userable": {
      "id": 3573041234567890,
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
Note: `tempat_lahir` adalah kota tempat penduduk lahir, didefinisikan pada `kota_tempat_lahir`.
```json
{
  "data": [
    {
      "id": "0037010903950000",
      "nama": "Natan",
      "tanggal_lahir": "1995-03-09 00:00:00",
      "tempat_lahir": 4,
      "jenis_kelamin": "l",
      "id_keluarga": "1",
      "id_ayah": "3573041003950012",
      "id_ibu": "3573041003950011",
      "hubungan_keluarga": "Anak",
      "golongan_darah": "A",
      "agama": "Islam",
      "wni": 1,
      "status_perkawinan": "Belum Kawin",
      "pekerjaan": null,
      "pendidikan": null,
      "id_izin_tetap": null,
      "id_passport": null,
      "created_at": "2016-04-19 11:35:24",
      "status": 1,
      "keluarga": {
        "id": 1,
        "alamat": "Jalan Ciumbuleuit 51/155A",
        "id_rt": 1,
        "created_at": "2016-03-31 14:50:42",
        "status": 1,
        "rt": {
          "id": 1,
          "nama": "001",
          "alamat_kantor": "Jalan CiumbuRT 121",
          "id_pengurus": "3573041003950011",
          "id_rw": 1,
          "created_at": "2016-03-31 14:49:27",
          "updated_at": null,
          "status": 1,
          "rw": {
            "id": 1,
            "nama": "",
            "alamat_kantor": "",
            "id_pengurus": "3573041003950011",
            "id_kelurahan": 1,
            "created_at": "2016-03-31 14:49:23",
            "updated_at": null,
            "status": 1,
            "kelurahan": {
              "id": 1,
              "nama": "Pisang Candi",
              "alamat_kantor": "Jalan Gelut 11",
              "id_pengurus": "3573041003950011",
              "id_kecamatan": 1,
              "created_at": "2016-03-31 14:49:17",
              "updated_at": null,
              "status": 1,
              "kecamatan": {
                "id": 1,
                "nama": "Malang Sekali",
                "alamat_kantor": "Jalan Tinombala 22",
                "id_pengurus": "3573041003950011",
                "id_kota": 37,
                "status": 1,
                "kota": {
                  "id": 37,
                  "nama": "Kota Bandung",
                  "alamat_kantor": "Jalan Ciumbuleuit XX",
                  "id_pengurus": null,
                  "id_provinsi": null,
                  "status": 0,
                  "provinsi": null
                }
              }
            }
          }
        }
      },
      "kota_tempat_lahir": {
        "id": 4,
        "nama": "Bandung",
        "alamat_kantor": "Kantor Walikota Jl.Wastukencana No.2,Bandung",
        "id_pengurus": "3573041003950011",
        "id_provinsi": 32,
        "status": 1,
        "provinsi": {
          "id": 32,
          "nama": "Jawa Barat",
          "alamat_kantor": "JL. DIPONEGORO NO. 22 BANDUNG",
          "id_pengurus": "3573041003950011",
          "status": 1
        }
      }
    },
    {
        "...": "..."
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
Note: `tempat_lahir` adalah kota tempat penduduk lahir, didefinisikan pada `kota_tempat_lahir`.
```json
{
  "data": {
    "id": "3573041003950012",
    "nama": "Natan",
    "tanggal_lahir": "1995-03-10 00:00:00",
    "tempat_lahir": 37,
    "jenis_kelamin": "",
    "id_keluarga": "2",
    "id_ayah": null,
    "id_ibu": null,
    "hubungan_keluarga": "Anak",
    "golongan_darah": "B",
    "agama": "Kristen",
    "wni": 1,
    "status_perkawinan": "",
    "pekerjaan": "Mahasiswa",
    "pendidikan": "Sekolah Menengah",
    "id_izin_tetap": null,
    "id_passport": null,
    "created_at": "2016-03-31 14:48:42",
    "status": 1,
    "keluarga": {
      "id": 2,
      "alamat": "Baker Street 221B",
      "id_rt": 78,
      "created_at": "2016-04-04 23:54:01",
      "status": 1,
      "rt": {
        "id": 78,
        "nama": "MAR",
        "alamat_kantor": "3685 Et St.",
        "id_pengurus": "3573041003950011",
        "id_rw": 9,
        "created_at": "2006-08-16 01:09:07",
        "updated_at": null,
        "status": 0,
        "rw": {
          "id": 9,
          "nama": "HB",
          "alamat_kantor": "303-5253 Posuere Ave",
          "id_pengurus": "3573041003950011",
          "id_kelurahan": 19,
          "created_at": "2012-04-06 00:50:04",
          "updated_at": null,
          "status": 0,
          "kelurahan": {
            "id": 19,
            "nama": "Buteshire",
            "alamat_kantor": "P.O. Box 865, 2844 Eget Av.",
            "id_pengurus": "3573041003950011",
            "id_kecamatan": 22,
            "created_at": "2016-12-31 21:32:53",
            "updated_at": null,
            "status": 0,
            "kecamatan": {
              "id": 22,
              "nama": "Majalaya",
              "alamat_kantor": "P.O. Box 126, 4054 Mattis. Av.",
              "id_pengurus": "3573041003950011",
              "id_kota": 4,
              "status": 0,
              "kota": {
                "id": 4,
                "nama": "Bandung",
                "alamat_kantor": "Kantor Walikota Jl.Wastukencana No.2,Bandung",
                "id_pengurus": "3573041003950011",
                "id_provinsi": 32,
                "status": 1,
                "provinsi": {
                  "id": 32,
                  "nama": "Jawa Barat",
                  "alamat_kantor": "JL. DIPONEGORO NO. 22 BANDUNG",
                  "id_pengurus": "3573041003950011",
                  "status": 1
                }
              }
            }
          }
        }
      }
    },
    "kota_tempat_lahir": {
      "id": 37,
      "nama": "Kota Bandung",
      "alamat_kantor": "Jalan Ciumbuleuit XX",
      "id_pengurus": null,
      "id_provinsi": null,
      "status": 0,
      "provinsi": null
    }
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
      "id": 1,
      "anakId": "3279012810930002",
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
      "waktuCetakTerakhir": "2016-04-03 04:42:44",
      "created_at": "2016-04-04 14:00:16",
      "updated_at": "2016-04-04 14:00:16",
      "anak": {
        "id": 3279012810930002,
        "nama": "Joko",
        "jenisKelamin": "laki-laki",
        "golonganDarah": "A",
        "kotaLahirId": "37",
        "waktuLahir": "2016-04-03 04:42:44",
        "jenisLahir": "Kembar Dua",
        "anakKe": "1",
        "penolongKelahiran": "Dokter",
        "berat": "2",
        "panjang": "40"
      },
      "kelurahan": null,
      "instansi_kesehatan": null,
      "keluarga": null,
      "ibu": {
        "id": "3573041003950011",
        "nama": "Natan",
        "tanggal_lahir": "1995-03-10 00:00:00",
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
      },
      "ayah": {
        "id": "3573041003950011",
        "nama": "Natan",
        "tanggal_lahir": "1995-03-10 00:00:00",
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
      },
      "pemohon": {
        "id": "3573041003950011",
        "nama": "Natan",
        "tanggal_lahir": "1995-03-10 00:00:00",
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
      },
      "saksi_satu": null,
      "saksi_dua": null
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
    "id": 1,
    "anakId": "3279012810930002",
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
    "waktuCetakTerakhir": "2016-04-03 04:42:44",
    "created_at": "2016-04-04 14:00:16",
    "updated_at": "2016-04-04 14:00:16",
    "anak": {
      "id": 3279012810930002,
      "nama": "Joko",
      "jenisKelamin": "laki-laki",
      "golonganDarah": "A",
      "kotaLahirId": "37",
      "waktuLahir": "2016-04-03 04:42:44",
      "jenisLahir": "Kembar Dua",
      "anakKe": "1",
      "penolongKelahiran": "Dokter",
      "berat": "2",
      "panjang": "40"
    },
    "kelurahan": null,
    "instansi_kesehatan": null,
    "keluarga": null,
    "ibu": {
      "id": "3573041003950011",
      "nama": "Natan",
      "tanggal_lahir": "1995-03-10 00:00:00",
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
    },
    "ayah": {
      "id": "3573041003950011",
      "nama": "Natan",
      "tanggal_lahir": "1995-03-10 00:00:00",
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
    },
    "pemohon": {
      "id": "3573041003950011",
      "nama": "Natan",
      "tanggal_lahir": "1995-03-10 00:00:00",
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
    },
    "saksi_satu": null,
    "saksi_dua": null
  }
}
```

### Penduduk
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
    "ibuId": "3573041234567890",
    "ayahId": "3573041234567890",
    "saksiSatu": {
        "pendudukId": "3573041234567890",
        "email": "email1@example.com"
    },
    "saksiDua": {
        "pendudukId": "3573041234567890",
        "email": "email2@example.com"
    },
    "pemohonId": "3573041234567890",
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
    "ibuId": "3573041234567890",
    "ayahId": "3573041234567890",
    "saksiSatu": {
        "pendudukId": "3573041234567890",
        "email": "email1@example.com"
    },
    "saksiDua": {
        "pendudukId": "3573041234567890",
        "email": "email2@example.com"
    },
    "pemohonId": "3573041234567890",
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
##### Request
```
GET /api/v1/saksi/{id}/verifikasi/{token} HTTP/1.1
Host: localhost:8000
```

#### Response
```json
{
  "message":"Saksi berhasil melakukan verifikasi kelahiran."
}
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

#### Melihat daftar permohonan dari pemohon
##### Request
```HTTP
GET /api/v1/pemohon/3573041003950011/kelahiran HTTP/1.1
Host: localhost:8000
Authorization: Basic bmF0YW5lbGlhN0BnbWFpbC5jb206cmFoYXNpYQ==
```

##### Response
```json
{
  "data": {
    "id": 5,
    "anakId": "3279012810930006",
    "kelurahanId": "1",
    "instansiKesehatanId": "9",
    "kartuKeluargaId": "1",
    "aktaNikahId": "1",
    "ibuId": "3573041003950012",
    "ayahId": "3573041003950011",
    "saksiSatuId": null,
    "saksiDuaId": null,
    "pemohonId": "3573041003950011",
    "status": "2",
    "verifikasiSaksi1": "1",
    "verifikasiSaksi2": "1",
    "verifikasiInstansiKesehatan": "1",
    "verifikasiLurah": "1",
    "verifikasiAdmin": "1",
    "waktuCetakTerakhir": "2016-04-03 04:42:44",
    "created_at": "2016-04-04 15:21:28",
    "updated_at": "2016-04-04 20:35:43",
    "anak": {
      "id": 3279012810930006,
      "nama": "Joko",
      "jenisKelamin": "laki-laki",
      "golonganDarah": "A",
      "kotaLahirId": "37",
      "waktuLahir": "2016-04-03 04:42:44",
      "jenisLahir": "Kembar Dua",
      "anakKe": "1",
      "penolongKelahiran": "Dokter",
      "berat": "2",
      "panjang": "40"
    }
  },
  "pemohon": {
    "id": "3573041003950011",
    "nama": "Natan",
    "tanggal_lahir": "1995-03-10 00:00:00",
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
