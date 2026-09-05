<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        Schema::create('kategori_berita', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->text('deskripsi')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('berita', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('kategori_id')
                ->constrained('kategori_berita')
                ->cascadeOnDelete();

            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('foto')->nullable();
            $table->text('deskripsi');
            $table->timestamp('diupload_pada');
            $table->integer('jumlah_dilihat')->default(0);

            $table->timestamps();
        });

        Schema::create('pembelajaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file_url');
            $table->string('file_type')->nullable();
            $table->timestamps();
        });

        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->string('judul');
            $table->string('gambar')->nullable();
            $table->string('file_url');
            $table->string('file_type')->nullable();
            $table->timestamps();
        });

        Schema::create('struktur_organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('foto')->nullable();
            $table->integer('urutan')->default(0);

            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('struktur_organisasi')
                ->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('pusat_bantuan', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan');
            $table->text('jawaban');
            $table->timestamps();
        });

        Schema::create('visi_misi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('visi');
            $table->text('daftar_misi');
            $table->string('foto_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visi_misi');
        Schema::dropIfExists('pusat_bantuan');
        Schema::dropIfExists('struktur_organisasi');
        Schema::dropIfExists('dokumen');
        Schema::dropIfExists('pembelajaran');
        Schema::dropIfExists('berita');
        Schema::dropIfExists('kategori_berita');
    }
};
