@extends('layouts.dashboard-user')

@section('title', 'Data Santri')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold flex items-center">
            <i class="fas fa-user mr-2"></i> Data Santri
        </h2>
    </div>
    
    <div class="p-6">
        @if($santri)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-medium text-gray-700 mb-3">Informasi Pribadi</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm text-gray-500">Nama Lengkap</label>
                            <p class="font-medium">{{ $santri->nama_lengkap }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">NISN</label>
                            <p class="font-medium">{{ $santri->nisn ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Jenis Kelamin</label>
                            <p class="font-medium">{{ $santri->jenis_kelamin }}</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-medium text-gray-700 mb-3">Informasi Tambahan</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm text-gray-500">Tempat/Tanggal Lahir</label>
                            <p class="font-medium">
                                {{ $santri->tempat_lahir }}, {{ $santri->tanggal_lahir->format('d F Y') }}
                            </p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Status Pendaftaran</label>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded-full text-xs 
                                    {{ $santri->status == 'diterima' ? 'bg-green-100 text-green-800' : 
                                       ($santri->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($santri->status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6">
                <a href="#" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-edit mr-2"></i> Edit Data
                </a>
            </div>
        @else
            <div class="text-center py-8">
                <i class="fas fa-exclamation-circle text-yellow-500 text-4xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Data Santri Belum Tersedia</h3>
                <p class="text-gray-500 mb-4">Silakan lengkapi data santri terlebih dahulu</p>
                <a href="#" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-plus mr-2"></i> Isi Data Santri
                </a>
            </div>
        @endif
    </div>
</div>
@endsection