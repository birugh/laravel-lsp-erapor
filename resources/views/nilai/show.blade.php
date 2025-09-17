@extends('layout.main')

@section('name')
    <h3>Laporan Nilai {{ $siswa->nama_siswa }}</h3>
@endsection

@section('content')
    <table class="table-show" style="text-align:center; margin:0 auto 1rem;">
        <tr>
            <td>Nama Siswa</td>
            <td>:</td>
            <td>{{ $siswa->nama_siswa }}</td>
        </tr>
        <tr>
            <td>Nomor Induk Siswa</td>
            <td>:</td>
            <td>{{ $siswa->nis }}</td>
        </tr>
        <tr>
            <td>Nama Walas</td>
            <td>:</td>
            <td>{{ $walas->nama_walas ?? 'Belum ada wali kelas yang ditetapkan' }}</td>
        </tr>
        <tr>
            <td>Kelas</td>
            <td>:</td>
            <td>{{ $siswa->kelas->nama_kelas }}</td>
        </tr>
    </table>

    <table class="table-show table-view" style="margin:0 auto;">
        <thead>
            <tr>
                <th class="border-head">No</th>
                <th class="border-head">Mata Pelajaran</th>
                <th class="border-head">Nilai</th>
                <th class="border-head">Grade</th>
            </tr>
        </thead>
        <tbody>
            @php
                $subjects = [
                    ['key' => 'matematika', 'label' => 'Matematika'],
                    ['key' => 'indonesia', 'label' => 'Bahasa Indonesia'],
                    ['key' => 'inggris', 'label' => 'Bahasa Inggris'],
                    ['key' => 'kejuruan', 'label' => 'Konsentrasi Keahlian'],
                    ['key' => 'pilihan', 'label' => 'Mata Pelajaran Pilihan'],
                ];
            @endphp

            @foreach ($subjects as $i => $s)
                <tr>
                    <td class="border-data">{{ $i + 1 }}</td>
                    <td class="border-data">{{ $s['label'] }}</td>
                    <td class="border-data">{{ $data_nilai[$s['key']]['nilai'] }}</td>
                    <td class="border-data">{{ $data_nilai[$s['key']]['grade'] }}</td>
                </tr>
            @endforeach

            <tr>
                <th class="border-data"></th>
                <th class="border-data">Rata - rata</th>
                <td class="border-data">{{ $data_nilai['rata_rata']['nilai'] }}</td>
                <td class="border-data">{{ $data_nilai['rata_rata']['grade'] }}</td>
            </tr>
        </tbody>
    </table>
@endsection
