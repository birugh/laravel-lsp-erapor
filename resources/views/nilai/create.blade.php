@extends('layout.main')
@section('name')
    <h3>Tambahkan Nilai</h3>
@endsection

@section('content')
    <h3>Create Nilai</h3>

    @if (session('error'))
        <p class="text-danger">{{ session('error') }}</p>
    @endif

    <form class="form" action="/nilai-raport/store" method="post">
        @csrf
        <table>
            <tr class="position">
                <td><label for="id_siswa">Nama Siswa:</label></td>
                <td>
                    <select name="id_siswa" id="id_siswa" required>
                        <option value="">Pilih Siswa</option>
                        @foreach ($siswa as $each)
                            <option value="{{ $each->id }}">{{ $each->nama_siswa }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            @foreach (['matematika' => 'Matematika', 'indonesia' => 'Indonesia', 'inggris' => 'Inggris', 'kejuruan' => 'Kejuruan', 'pilihan' => 'Pilihan'] as $name => $label)
                <tr class="position">
                    <td><label for="{{ $name }}">{{ $label }}:</label></td>
                    <td><input type="number" name="{{ $name }}" id="{{ $name }}" step="0.01" min="0" max="100" required>
                    </td>
                </tr>
            @endforeach
        </table>

        <button class="button-submit" type="submit">Simpan</button>
    </form>
@endsection
