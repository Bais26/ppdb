@extends('layouts.dashboard-user')

@section('title', 'Berkas Santri')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold flex items-center">
            <i class="fas fa-file-alt mr-2"></i> Berkas Santri
        </h2>
        <p class="text-sm text-gray-500 mt-1">Kelengkapan dokumen pendaftaran</p>
    </div>
    
    <div class="p-6">
        @if($berkas)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokumen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class="fas fa-file-pdf text-red-500 mr-3"></i>
                                    <div>
                                        <div class="font-medium">Akta Kelahiran</div>
                                        <div class="text-sm text-gray-500">Format PDF</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($berkas->akta_kelahiran)
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Terupload
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Belum Upload
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($berkas->akta_kelahiran)
                                    <a href="{{ asset('storage/'.$berkas->akta_kelahiran) }}" target="_blank" class="text-blue-600 hover:text-blue-900 mr-3">Lihat</a>
                                @endif
                                <a href="#" class="text-green-600 hover:text-green-900">Upload</a>
                            </td>
                        </tr>
                        <!-- Tambahkan dokumen lainnya sesuai kebutuhan -->
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            Pastikan semua dokumen sudah diupload dengan benar. Dokumen yang sudah diverifikasi tidak dapat diubah.
                        </p>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-yellow-500 text-4xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Berkas Belum Tersedia</h3>
                <p class="text-gray-500 mb-4">Silakan upload berkas-berkas yang diperlukan</p>
                <a href="#" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-upload mr-2"></i> Upload Berkas
                </a>
            </div>
        @endif
    </div>
</div>
@endsection