<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PpmppSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin PPMPP',
                'email' => 'admin@ppmpp.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('kategori_berita')->insert([
            [
                'id' => 1,
                'kategori' => 'Pengumuman',
                'deskripsi' => 'Informasi dan pengumuman PPMPP',
                'slug' => 'pengumuman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'kategori' => 'Kegiatan',
                'deskripsi' => 'Informasi kegiatan PPMPP',
                'slug' => 'kegiatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('berita')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'kategori_id' => 1,
                'judul' => 'Informasi Terbaru PPMPP',
                'slug' => 'informasi-terbaru-ppmpp',
                'foto' => null,
                'deskripsi' => 'Informasi terbaru mengenai kegiatan dan perkembangan PPMPP.',
                'diupload_pada' => now(),
                'jumlah_dilihat' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'kategori_id' => 2,
                'judul' => 'Kegiatan PPMPP',
                'slug' => 'kegiatan-ppmpp',
                'foto' => null,
                'deskripsi' => 'Informasi mengenai kegiatan yang dilaksanakan oleh PPMPP.',
                'diupload_pada' => now(),
                'jumlah_dilihat' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('pembelajaran')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'judul' => 'Materi Pembelajaran',
                'deskripsi' => 'Materi pembelajaran yang disediakan oleh PPMPP.',
                'file_url' => 'materi-pembelajaran.pdf',
                'file_type' => 'pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('dokumen')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'judul' => 'Dokumen PPMPP',
                'gambar' => null,
                'file_url' => 'dokumen-ppmpp.pdf',
                'file_type' => 'pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('struktur_organisasi')->insert([
            [
                'id' => 1,
                'nama' => 'Kepala PPMPP',
                'jabatan' => 'Kepala',
                'foto' => null,
                'urutan' => 1,
                'parent_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama' => 'Sekretaris PPMPP',
                'jabatan' => 'Sekretaris',
                'foto' => null,
                'urutan' => 2,
                'parent_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('pusat_bantuan')->insert([
            [
                'id' => 1,
                'pertanyaan' => 'Apa itu PPMPP?',
                'jawaban' => 'PPMPP adalah Pusat Penjaminan Mutu dan Pengembangan Pembelajaran.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'pertanyaan' => 'Apa fungsi PPMPP?',
                'jawaban' => 'PPMPP berperan dalam penjaminan mutu dan pengembangan pembelajaran.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('visi_misi')->insert([
            [
                'id' => 1,
                'judul' => 'Visi',
                'visi' => 'Menjadi pusat penjaminan mutu dan pengembangan pembelajaran yang unggul.',
                'daftar_misi' => 'Meningkatkan mutu pendidikan dan mengembangkan pembelajaran secara berkelanjutan.',
                'foto_url' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
