<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Walas;

class NilaiController extends Controller
{
    public function index()
    {
        $walas = Walas::find(session('id'));

        if (! $walas) {
            return back()->with('error', 'Data wali kelas tidak ditemukan');
        }

        $data_nilai = Nilai::whereHas('siswa', function ($query) use ($walas) {
            $query->where('id_kelas', $walas->id_kelas);
        })->with('siswa')->get();

        $kelas = Kelas::where('id', session('id'))->first();

        return view('nilai.index', compact(['data_nilai', 'kelas']));
    }
}
