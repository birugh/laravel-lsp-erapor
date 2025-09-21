@extends('layout.main')

@section('name')
    <h3>Edit Nilai ( {{ $siswa->nama_siswa }} )</h3>
@endsection

@section('content')
    @if (session('error'))
        <p class="text-danger">{{ session('error') }}</p>
    @endif

    <form class="form" action="/nilai-raport/update/{{ $nilai->id }}" method="post">
        @csrf
        @method('put')
        <table>
            <tr class="position">
                <td><label>Nama Siswa:</label></td>
                <td>
                    <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                    <input type="text" value="{{ $siswa->nama_siswa }}" readonly>
                </td>
            </tr>

            @foreach (['matematika', 'indonesia', 'inggris', 'kejuruan', 'pilihan'] as $field)
                <tr class="position">
                    <td><label for="{{ $field }}">{{ ucfirst($field) }}:</label></td>
                    <td>
                        <input id="{{ $field }}" name="{{ $field }}" type="number" step="0.01"
                            value="{{ $nilai->$field }}" min="0" max="100" required>
                    </td>
                </tr>
            @endforeach
        </table>

        <button class="button-submit" type="submit">Simpan</button>
    </form>
@endsection
