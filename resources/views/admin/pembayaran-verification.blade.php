<div class="space-y-4">
    <h2 class="text-xl font-bold">Verifikasi Dokumen: {{ $documentType }}</h2>
    
    @if($imageUrl)
        <div class="border rounded-lg p-4">
            <div class="aspect-w-16 aspect-h-9">
                <img src="{{ $imageUrl }}" alt="{{ $documentType }}" class="object-cover rounded">
            </div>
        </div>
        
        @if($catatan)
            <div class="bg-yellow-50 text-yellow-800 p-3 rounded-lg">
                <h4 class="font-semibold">Catatan Sebelumnya:</h4>
                <p>{{ $catatan }}</p>
            </div>
        @endif
    @else
        <p class="text-gray-500">Dokumen tidak tersedia</p>
    @endif
    
    <div class="mt-4">
        <h3 class="font-medium mb-2">Status Saat Ini:</h3>
        <span class="px-3 py-1 rounded text-sm 
            @if($currentStatus === 'verified' || $currentStatus === 'diterima') bg-green-100 text-green-800
            @elseif($currentStatus === 'rejected' || $currentStatus === 'ditolak') bg-red-100 text-red-800
            @elseif($currentStatus === 'revisi') bg-yellow-100 text-yellow-800
            @else bg-gray-100 text-gray-800 @endif">
            {{ ucfirst($currentStatus) }}
        </span>
    </div>
</div>