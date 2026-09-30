<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    protected $table = 'kontens';

    protected $fillable = [
        'bagian',
        'judul_konten',
        'subjudul',
        'isi',
        'gambar',
        'file_dokumen',
        'urutan',
    ];

    public function detailBerita()
    {
        return $this->hasOne(
            DetailBerita::class,
            'konten_id'
        );
    }
}
