<div class="space-y-4">
    <h2 class="text-xl font-bold">Verifikasi Dokumen: {{ $documentType ?? 'Berkas Pendaftaran' }}</h2>
    
    @if(isset($isBulkVerification) && $isBulkVerification)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($files as $type => $file)
                @if($file)
                    <div class="border rounded-lg p-4">
                        <h3 class="font-medium mb-2">{{ $type }}</h3>
                        <div class="aspect-w-16 aspect-h-9">
                            <img src="{{ Storage::url($file) }}" alt="{{ $type }}" class="object-cover rounded">
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        @if($imageUrl ?? false)
            <div class="border rounded-lg p-4">
                <div class="aspect-w-16 aspect-h-9">
                    <img src="{{ $imageUrl }}" alt="{{ $documentType }}" class="object-cover rounded">
                </div>
            </div>
        @else
            <p class="text-gray-500">Dokumen tidak tersedia</p>
        @endif
    @endif
    
    @if(($currentStatus ?? null) === 'sesuai' || ($currentStatus ?? null) === 'diterima')
        <div class="bg-green-50 text-green-800 p-3 rounded-lg">
            Status saat ini: <span class="font-semibold">Terverifikasi</span>
        </div>
    @elseif(($currentStatus ?? null) === 'tidak_sesuai' || ($currentStatus ?? null) === 'ditolak')
        <div class="bg-red-50 text-red-800 p-3 rounded-lg">
            Status saat ini: <span class="font-semibold">Ditolak</span>
        </div>
    @else
        <div class="bg-gray-50 text-gray-800 p-3 rounded-lg">
            Status saat ini: <span class="font-semibold">Belum Diverifikasi</span>
        </div>
    @endif
</div>