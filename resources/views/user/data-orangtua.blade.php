@extends('layouts.dashboard-user')

@section('title', 'Data Orang Tua')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold flex items-center">
            <i class="fas fa-users mr-2"></i> Data Orang Tua/Wali
        </h2>
    </div>
    
    <div class="p-6">
        @if($orangTua)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Ayah -->
                <div class="border rounded-lg p-4">
                    <h3 class="font-medium text-gray-700 mb-4 flex items-center">
                        <i class="fas fa-male mr-2 text-blue-600"></i> Data Ayah
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm text-gray-500">Nama Ayah</label>
                            <p class="font-medium">{{ $orangTua->nama_ayah }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Pekerjaan</label>
                            <p class="font-medium">{{ $orangTua->pekerjaan_ayah ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">No. HP</label>
                            <p class="font-medium">{{ $orangTua->no_hp_ayah }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Data Ibu -->
                <div class="border rounded-lg p-4">
                    <h3 class="font-medium text-gray-700 mb-4 flex items-center">
                        <i class="fas fa-female mr-2 text-pink-600"></i> Data Ibu
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm text-gray-500">Nama Ibu</label>
                            <p class="font-medium">{{ $orangTua->nama_ibu }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">Pekerjaan</label>
                            <p class="font-medium">{{ $orangTua->pekerjaan_ibu ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-gray-500">No. HP</label>
                            <p class="font-medium">{{ $orangTua->no_hp_ibu }}</p>
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
                <h3 class="text-lg font-medium text-gray-700 mb-2">Data Orang Tua Belum Tersedia</h3>
                <p class="text-gray-500 mb-4">Silakan lengkapi data orang tua/wali terlebih dahulu</p>
                <a href="#" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-plus mr-2"></i> Isi Data Orang Tua
                </a>
            </div>
        @endif
    </div>
</div>
@endsection