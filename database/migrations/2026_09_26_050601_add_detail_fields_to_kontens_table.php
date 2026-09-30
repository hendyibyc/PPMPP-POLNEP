<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kontens', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('subjudul');
            $table->string('penulis')->nullable()->after('kategori');
            $table->unsignedInteger('views')->default(0)->after('penulis');
        });
    }

    public function down(): void
    {
        Schema::table('kontens', function (Blueprint $table) {
            $table->dropColumn([
                'kategori',
                'penulis',
                'views',
            ]);
        });
    }
};
