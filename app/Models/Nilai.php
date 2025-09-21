<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilais';

    protected $guarded = ['id'];

    protected $fillable = ['siswa_id', 'id_walas', 'nama_siswa', 'nama_walas', 'matematika', 'indonesia', 'inggris', 'kejuruan', 'pilihan', 'rata_rata'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function walas()
    {
        return $this->belongsTo(Walas::class, 'id_walas');
    }
}
