@extends('layouts.petugas')

@section('content')

<h1 class="text-2xl font-bold mb-6">Absen Hari Ini</h1>

<x-card>

<form method="POST"
      action="{{ route('petugas.absensi.store') }}">

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

    {{-- FOTO DARI KAMERA --}}
    <div class="mb-4">
        <label class="block mb-2 font-medium">Foto Bukti (Wajib Kamera)</label>

        <video id="camera" autoplay class="w-64 rounded border shadow"></video>

        <canvas id="canvas" class="hidden"></canvas>

        <div class="mt-3">
            <button type="button"
                    onclick="takePhoto()"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Ambil Foto
            </button>
        </div>

        <input type="hidden" name="foto_base64" id="fotoBase64" required>

        @error('foto_base64')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Button --}}
    <button type="submit"
            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
        Simpan Absensi
    </button>

</form>

</x-card>


{{-- SCRIPT KAMERA --}}
<script>
const video = document.getElementById('camera');
const canvas = document.getElementById('canvas');
const fotoInput = document.getElementById('fotoBase64');

navigator.mediaDevices.getUserMedia({ 
    video: { facingMode: "environment" } 
})
.then(stream => {
    video.srcObject = stream;
})
.catch(err => {
    alert("Kamera tidak dapat diakses!");
});

function takePhoto() {
    const context = canvas.getContext('2d');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0);

    const imageData = canvas.toDataURL('image/jpeg', 0.8);
    fotoInput.value = imageData;

    alert("Foto berhasil diambil!");
}
</script>

@endsection
