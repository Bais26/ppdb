<div class="space-y-4">
    <h2 class="text-xl font-bold">Verifikasi Dokumen: {{ $documentType }}</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($files as $type => $file)
            @if($file['url'])
                <div class="border rounded-lg p-4">
                    <h3 class="font-medium mb-2">{{ $type }}
                        <span class="text-xs ml-2 px-2 py-1 rounded 
                            @if($file['status'] === 'diterima') bg-green-100 text-green-800
                            @elseif($file['status'] === 'revisi') bg-yellow-100 text-yellow-800
                            @elseif($file['status'] === 'ditolak') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($file['status']) }}
                        </span>
                    </h3>
                    
                    @if($file['catatan'])
                        <div class="bg-yellow-50 text-yellow-800 p-2 rounded text-sm mb-2">
                            <p>{{ $file['catatan'] }}</p>
                        </div>
                    @endif
                    
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="{{ Storage::url($file['url']) }}" alt="{{ $type }}" class="object-cover rounded">
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>