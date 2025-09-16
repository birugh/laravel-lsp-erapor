<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilais';
    protected $guarded = ['id'];
    protected $fillable = ['id_siswa', 'id_walas', 'nama_siswa', 'nama_walas', 'matematika', 'indonesia', 'inggris', 'kejuruan', 'pilihan', 'rata_rata'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function walas()
    {
        return $this->belongsTo(Walas::class, 'id_walas');
    }
}
