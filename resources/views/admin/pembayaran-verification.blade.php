<div class="space-y-6">
    <!-- Header Info -->
    <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Nama:</span>
                <span class="ml-2">{{ $record->nama_santri }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">No. Pendaftaran:</span>
                <span class="ml-2">{{ $record->nomor_pendaftaran }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">NIK:</span>
                <span class="ml-2">{{ $record->nik ?? 'Tidak tersedia' }}</span>
            </div>
            <div>
                <span class="font-medium text-gray-700 dark:text-gray-300">Dokumen:</span>
                <span class="ml-2">{{ $documentType }}</span>
            </div>
        </div>
    </div>

    <!-- Document Display -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Original Document -->
        <div class="space-y-3">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                Dokumen Asli
            </h3>
            <div class="border rounded-lg overflow-hidden bg-white dark:bg-gray-700">
                @if($imageUrl)
                    <img src="{{ $imageUrl }}" 
                         alt="Dokumen {{ $documentType }}" 
                         class="w-full h-auto max-h-96 object-contain">
                @else
                    <div class="h-48 flex items-center justify-center text-gray-500 dark:text-gray-400">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <p class="mt-2">Tidak ada dokumen</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Verification Status -->
        <div class="space-y-3">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                Status Verifikasi
            </h3>
            
            <div class="bg-white dark:bg-gray-700 border rounded-lg p-4">
                <div class="space-y-4">
                    <!-- Current Status -->
                    <div class="flex items-center space-x-3">
                        <span class="font-medium text-gray-700 dark:text-gray-300">Status Saat Ini:</span>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                'sesuai' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                'tidak_sesuai' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
                            ];
                            $statusLabels = [
                                'pending' => 'Pending',
                                'sesuai' => 'Sesuai',
                                'tidak_sesuai' => 'Tidak Sesuai'
                            ];
                        @endphp
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$currentStatus] ?? $statusColors['pending'] }}">
                            {{ $statusLabels[$currentStatus] ?? 'Pending' }}
                        </span>
                    </div>

                    <!-- Verification Form -->
                    <form wire:submit.prevent="submitVerification">
                        <div class="border-t pt-4">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                Pilih status verifikasi untuk dokumen ini:
                            </p>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <label class="flex items-center p-3 border rounded-lg hover:bg-green-50 dark:hover:bg-green-900/20 cursor-pointer transition-colors">
                                    <input type="radio" name="status" value="sesuai" class="sr-only peer">
                                    <svg class="h-5 w-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm font-medium text-green-700 dark:text-green-400">Sesuai</span>
                                </label>
                                
                                <label class="flex items-center p-3 border rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 cursor-pointer transition-colors">
                                    <input type="radio" name="status" value="tidak_sesuai" class="sr-only peer">
                                    <svg class="h-5 w-5 text-red-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm font-medium text-red-700 dark:text-red-400">Tidak Sesuai</span>
                                </label>
                            </div>
                    </form>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-3">
                <div class="flex">
                    <svg class="h-5 w-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-sm text-blue-700 dark:text-blue-300">
                        <p class="font-medium mb-1">Panduan Verifikasi:</p>
                        <ul class="list-disc list-inside space-y-1 text-xs">
                            <li>Pastikan dokumen jelas dan dapat dibaca</li>
                            <li>Periksa kesesuaian data dengan formulir pendaftaran</li>
                            <li>Verifikasi keaslian dokumen</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>