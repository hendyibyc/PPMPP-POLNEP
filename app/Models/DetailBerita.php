<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBerita extends Model
{
    protected $table = 'detail_beritas';

    protected $fillable = [
        'konten_id',
        'kategori',
        'penulis',
        'gambar',
        'isi_detail',
        'views',
    ];

    public function konten()
    {
        return $this->belongsTo(
            Konten::class,
            'konten_id'
        );
    }
}
