<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_beritas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('konten_id')
                ->constrained('kontens')
                ->cascadeOnDelete();

            $table->string('kategori')->nullable();
            $table->string('penulis')->nullable();
            $table->string('gambar')->nullable();
            $table->longText('isi_detail')->nullable();
            $table->unsignedInteger('views')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_beritas');
    }
};
