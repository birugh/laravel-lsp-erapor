<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Walas;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    // daftar mapel supaya nggak copy-paste
    protected $mapel = ['matematika','indonesia','inggris','kejuruan','pilihan'];

    public function index()
    {
        $walas = Walas::find(session('id'));
        if (! $walas) return back()->with('error','Data wali kelas tidak ditemukan');

        $data_nilai = Nilai::with('siswa')
            ->whereHas('siswa', fn($q) => $q->where('id_kelas',$walas->id_kelas))
            ->get();

        $kelas = Kelas::find(session('id'));

        return view('nilai.index', compact('data_nilai','kelas'));
    }

    public function create()
    {
        $walas = Walas::find(session('id'));
        $sudahAda = Nilai::pluck('siswa_id');
        $siswa = Siswa::where('id_kelas',$walas->id_kelas)
                      ->whereNotIn('id',$sudahAda)
                      ->get();

        return view('nilai.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $rules = collect($this->mapel)->mapWithKeys(fn($m) => [$m => ['required','numeric','between:0,100']])
                                      ->put('siswa_id',['required'])
                                      ->toArray();
        $data = $request->validate($rules);

        $data['id_walas']  = session('id');
        $data['rata_rata'] = round(collect($this->mapel)->sum(fn($m) => $data[$m]) / count($this->mapel));

        if (Nilai::where('siswa_id',$request->siswa_id)->exists()) {
            return back()->with('error','Data nilai untuk siswa tersebut sudah ada');
        }

        Nilai::create($data);
        return redirect('/nilai-raport/index')->with('success','Data nilai berhasil ditambahkan');
    }

    public function edit(Nilai $nilai)
    {
        $siswa = Siswa::find($nilai->siswa_id);
        return view('nilai.edit', compact('nilai','siswa'));
    }

    public function update(Request $request, Nilai $nilai)
    {
        $rules = collect($this->mapel)->mapWithKeys(fn($m) => [$m => ['required','numeric','max:100']])
                                      ->put('siswa_id',['required'])
                                      ->toArray();
        $data = $request->validate($rules);

        $data['walas_id']  = session('id');
        $data['rata_rata'] = round(collect($this->mapel)->sum(fn($m) => $data[$m]) / count($this->mapel));

        $nilai->update($data);
        return redirect('/nilai-raport/index')->with('success','Data nilai berhasil diubah');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect('/nilai-raport/index')->with('success','Data nilai berhasil dihapus');
    }

    public function showNilai($id)
    {
        $siswa = Siswa::with(['kelas','nilai'])->find($id);
        $nilai = optional($siswa->nilai)->first();
        $walas = $siswa?->id_kelas ? Walas::where('id_kelas',$siswa->id_kelas)->first() : null;

        $data_nilai = collect(array_merge($this->mapel,['rata_rata']))
            ->mapWithKeys(fn($m) => [
                $m => [
                    'nilai' => $nilai->$m ?? 'Data tidak tersedia',
                    'grade' => $nilai ? $this->gradeMapel($nilai->$m) : 'N/A',
                ]
            ]);

        return view('nilai.show', compact('siswa','data_nilai','walas'));
    }

    public function showForStudent()
    {
        $id = session('id');
        if (! $id) return redirect('/')->with('error','Silakan login terlebih dahulu');
        return $this->showNilai($id);
    }

    public function gradeMapel($nilai)
    {
        return match (true) {
            $nilai >= 90 => 'A',
            $nilai >= 80 => 'B',
            $nilai >= 70 => 'C',
            $nilai >= 60 => 'D',
            default      => 'E',
        };
    }
}
