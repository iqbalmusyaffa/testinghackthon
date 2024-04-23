<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $table = 'events';

    protected $fillable = [
        'judul_events',
        'nama_events',
        'kategori_id',
        'gambar_events',
        'tanggal_events',
        'deskripsi',
        'lokasi_events',
        'harga_events',
        'author_events',
        'tanggal_mulai',
        'tanggal_berakhir',
    ];

    public function kategoris()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');


    }
    public function countEvents()
{
    $count = Events::count();
    return $count;
}
}
