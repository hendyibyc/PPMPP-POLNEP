<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kontens', function (Blueprint $table) {
            $table->string('judul_konten')->nullable()->after('bagian');
            $table->string('subjudul')->nullable()->after('judul_konten');
        });
    }

    public function down(): void
    {
        Schema::table('kontens', function (Blueprint $table) {
            $table->dropColumn([
                'judul_konten',
                'subjudul',
            ]);
        });
    }
};
