<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kontens', function (Blueprint $table) {
            if (!Schema::hasColumn('kontens', 'urutan')) {
                $table->integer('urutan')->default(0)->after('gambar');
            }

            if (!Schema::hasColumn('kontens', 'judul_konten')) {
                $table->string('judul_konten')->nullable()->after('bagian');
            }

            if (!Schema::hasColumn('kontens', 'subjudul')) {
                $table->string('subjudul')->nullable()->after('judul_konten');
            }
        });
    }

    public function down(): void
    {
        Schema::table('kontens', function (Blueprint $table) {
            if (Schema::hasColumn('kontens', 'urutan')) {
                $table->dropColumn('urutan');
            }

            if (Schema::hasColumn('kontens', 'judul_konten')) {
                $table->dropColumn('judul_konten');
            }

            if (Schema::hasColumn('kontens', 'subjudul')) {
                $table->dropColumn('subjudul');
            }
        });
    }
};
