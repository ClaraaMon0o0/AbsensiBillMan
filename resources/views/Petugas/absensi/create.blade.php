@extends('layouts.petugas')

@section('content')

<div class="flex items-center gap-3 mb-8">
    <div class="w-10 h-10 bg-[#0B2D45]/10 rounded-xl flex items-center justify-center">
        <i class="fas fa-camera text-[#155E76] text-lg"></i>
    </div>
    <div>
        <h1 class="text-2xl font-semibold text-gray-800 tracking-tight">Absen Hari Ini</h1>
        <p class="text-sm text-gray-500 mt-1">Lengkapi form absensi dengan foto bukti</p>
    </div>
</div>

<x-card>
    <form method="POST" action="{{ route('petugas.absensi.store') }}" class="space-y-6">
        @csrf

        {{-- Kegiatan --}}
        <div class="space-y-2">
            <label class="text-sm font-semibold text-gray-700 ml-1 flex items-center gap-2">
                <i class="fas fa-clipboard-list text-[#155E76] text-sm"></i>
                Jumlah Kegiatan
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-sort-numeric-up text-gray-400 text-sm"></i>
                </div>
                <input type="number"
                       name="kegiatan"
                       value="{{ old('kegiatan') }}"
                       placeholder="Masukkan jumlah kegiatan"
                       class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-[#155E76] focus:ring-2 focus:ring-[#155E76]/20 transition-all text-sm @error('kegiatan') border-red-500 @enderror"
                       required>
            </div>
            @error('kegiatan')
                <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Keterangan --}}
        <div class="space-y-2">
            <label class="text-sm font-semibold text-gray-700 ml-1 flex items-center gap-2">
                <i class="fas fa-pencil-alt text-[#155E76] text-sm"></i>
                Keterangan
            </label>
            <div class="relative">
                <div class="absolute top-3 left-0 pl-4 flex items-start pointer-events-none">
                    <i class="fas fa-align-left text-gray-400 text-sm"></i>
                </div>
                <textarea name="keterangan"
                          placeholder="Tuliskan keterangan kegiatan anda hari ini"
                          class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl focus:border-[#155E76] focus:ring-2 focus:ring-[#155E76]/20 transition-all text-sm @error('keterangan') border-red-500 @enderror"
                          rows="4"
                          required>{{ old('keterangan') }}</textarea>
            </div>
            @error('keterangan')
                <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Status --}}
        <div class="space-y-2">
            <label class="text-sm font-semibold text-gray-700 ml-1 flex items-center gap-2">
                <i class="fas fa-tag text-[#155E76] text-sm"></i>
                Status
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-check-circle text-gray-400 text-sm"></i>
                </div>
                <select name="status"
                        class="w-full pl-10 pr-10 py-3 bg-white border border-gray-200 rounded-xl focus:border-[#155E76] focus:ring-2 focus:ring-[#155E76]/20 transition-all text-sm appearance-none @error('status') border-red-500 @enderror"
                        required>
                    <option value="" disabled selected>-- Pilih Status Kehadiran --</option>
                    <option value="Hadir" {{ old('status')=='Hadir'?'selected':'' }} class="py-2">Hadir</option>
                    <option value="Izin" {{ old('status')=='Izin'?'selected':'' }} class="py-2">Izin</option>
                    <option value="Sakit" {{ old('status')=='Sakit'?'selected':'' }} class="py-2">Sakit</option>
                    <option value="Cuti" {{ old('status')=='Cuti'?'selected':'' }} class="py-2">Cuti</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                </div>
            </div>
            @error('status')
                <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- FOTO DARI KAMERA --}}
        <div class="space-y-3">
            <label class="text-sm font-semibold text-gray-700 ml-1 flex items-center gap-2">
                <i class="fas fa-camera text-[#155E76] text-sm"></i>
                Foto Bukti
                <span class="text-xs font-normal text-gray-400 ml-2">(Wajib menggunakan kamera)</span>
            </label>
            
            <div class="bg-gray-50/50 rounded-2xl border border-gray-200 p-5">
                <div class="flex flex-col items-center">
                    {{-- Camera Preview --}}
                    <div class="relative w-80 h-60 bg-gray-900 rounded-xl overflow-hidden shadow-lg border-2 border-gray-200">
                        <video id="camera" autoplay playsinline class="absolute inset-0 w-full h-full object-cover"></video>
                        <img id="previewImage" class="absolute inset-0 w-full h-full object-cover hidden">
                        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <div class="w-32 h-32 border-2 border-white/50 rounded-full animate-pulse"></div>
                        </div>
                    </div>

                    <canvas id="canvas" class="hidden"></canvas>

                    {{-- Camera Controls --}}
                    <div class="flex items-center gap-3 mt-5">
                        <button type="button"
                                id="captureBtn"
                                onclick="handlePhoto()"
                                class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-2.5 rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-md shadow-green-500/30 flex items-center gap-2 text-sm font-medium">
                            <i class="fas fa-camera"></i>
                            <span>Ambil Foto</span>
                        </button>
                        
                        <button type="button"
                                id="retakeBtn"
                                onclick="retakePhoto()"
                                class="bg-gray-500 text-white px-6 py-2.5 rounded-xl hover:bg-gray-600 transition-all duration-300 shadow-md shadow-gray-500/30 flex items-center gap-2 text-sm font-medium hidden">
                            <i class="fas fa-redo"></i>
                            <span>Ambil Ulang</span>
                        </button>
                    </div>

                    <p id="photoStatus" class="text-xs text-gray-400 mt-3 flex items-center gap-1">
                        <i class="fas fa-info-circle"></i>
                        Pastikan wajah dan bukti kegiatan terlihat jelas
                    </p>

                    <input type="hidden" name="foto_base64" id="fotoBase64" required>
                </div>
            </div>

            @error('foto_base64')
                <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Button Submit --}}
        <div class="pt-4 flex justify-end">
            <button type="submit"
                    class="bg-gradient-to-r from-[#0B2D45] to-[#155E76] text-white px-8 py-3.5 rounded-xl hover:from-[#155E76] hover:to-[#1A7A8C] transition-all duration-300 shadow-lg shadow-[#0B2D45]/30 flex items-center gap-3 text-sm font-semibold group">
                <i class="fas fa-save group-hover:scale-110 transition-transform"></i>
                <span>Simpan Absensi</span>
            </button>
        </div>
    </form>
</x-card>

{{-- SCRIPT KAMERA --}}
<script>
let video = document.getElementById('camera');
let canvas = document.getElementById('canvas');
let preview = document.getElementById('previewImage');
let fotoInput = document.getElementById('fotoBase64');
let captureBtn = document.getElementById('captureBtn');
let retakeBtn = document.getElementById('retakeBtn');
let photoStatus = document.getElementById('photoStatus');
let stream;

startCamera();

function startCamera() {
    navigator.mediaDevices.getUserMedia({
        video: { 
            facingMode: "environment",
            width: { ideal: 1280 },
            height: { ideal: 720 }
        }
    })
    .then(s => {
        stream = s;
        video.srcObject = stream;
        video.classList.remove('hidden');
        preview.classList.add('hidden');
        captureBtn.classList.remove('hidden');
        retakeBtn.classList.add('hidden');
        fotoInput.value = "";
        photoStatus.innerHTML = '<i class="fas fa-info-circle"></i> Arahkan kamera ke bukti kegiatan, lalu klik Ambil Foto';
        photoStatus.classList.remove('text-green-600');
        photoStatus.classList.add('text-gray-400');
    })
    .catch(err => {
        alert("Kamera tidak dapat diakses! Pastikan anda mengizinkan akses kamera.");
    });
}

function stopCamera() {
    if (stream) {
        stream.getTracks().forEach(track => track.stop());
    }
}

function handlePhoto() {
    takePhoto();
}

function takePhoto() {
    const context = canvas.getContext('2d');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0);

    const imageData = canvas.toDataURL('image/jpeg', 0.8);
    fotoInput.value = imageData;

    preview.src = imageData;
    preview.classList.remove('hidden');
    video.classList.add('hidden');

    stopCamera();

    captureBtn.classList.add('hidden');
    retakeBtn.classList.remove('hidden');
    photoStatus.innerHTML = '<i class="fas fa-check-circle text-green-600"></i> Foto berhasil diambil';
    photoStatus.classList.add('text-green-600');
}

function retakePhoto() {
    fotoInput.value = "";
    startCamera();
}

// Cleanup on page leave
window.addEventListener('beforeunload', function() {
    stopCamera();
});
</script>

@endsection