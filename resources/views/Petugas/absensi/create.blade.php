@extends('layouts.petugas')

@section('content')

<h1 class="text-2xl font-bold mb-6">Absen Hari Ini</h1>

<x-card>

<form method="POST"
      action="{{ route('petugas.absensi.store') }}"
      enctype="multipart/form-data">

    @csrf

    {{-- Kegiatan --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Jumlah Kegiatan</label>
        <input type="number"
               name="kegiatan"
               value="{{ old('kegiatan') }}"
               class="w-full border p-2 rounded @error('kegiatan') border-red-500 @enderror"
               required>

        @error('kegiatan')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Keterangan --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Keterangan</label>
        <textarea name="keterangan"
                  class="w-full border p-2 rounded @error('keterangan') border-red-500 @enderror"
                  rows="3"
                  required>{{ old('keterangan') }}</textarea>

        @error('keterangan')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Status --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Status</label>
        <select name="status"
                class="w-full border p-2 rounded @error('status') border-red-500 @enderror"
                required>

            <option value="">-- Pilih Status --</option>
            <option value="Hadir" {{ old('status')=='Hadir'?'selected':'' }}>Hadir</option>
            <option value="Izin" {{ old('status')=='Izin'?'selected':'' }}>Izin</option>
            <option value="Sakit" {{ old('status')=='Sakit'?'selected':'' }}>Sakit</option>
            <option value="Cuti" {{ old('status')=='Cuti'?'selected':'' }}>Cuti</option>
        </select>

        @error('status')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Foto --}}
    <div class="mb-4">
        <label class="block mb-1 font-medium">Foto Bukti (Wajib Kamera)</label>

        <input type="file"
               name="foto"
               id="fotoInput"
               accept="image/*"
               capture="environment"
               class="w-full border p-2 rounded @error('foto') border-red-500 @enderror"
               required>

        @error('foto')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        {{-- Preview --}}
        <div class="mt-4">
            <img id="previewImage"
                 class="hidden w-48 rounded border shadow">
        </div>
    </div>

    {{-- Button --}}
    <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
        Simpan Absensi
    </button>

</form>

</x-card>


{{-- SCRIPT PREVIEW FOTO --}}
<script>
document.getElementById('fotoInput').addEventListener('change', function(event) {

    const file = event.target.files[0];
    const preview = document.getElementById('previewImage');

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }

        reader.readAsDataURL(file);
    }
});
</script>

@endsection
