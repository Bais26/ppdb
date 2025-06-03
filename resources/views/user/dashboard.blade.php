@extends('layouts.dashboard-user')

@section('title', 'Dashboard Santri')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Selamat Datang, {{ $user->name }}</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card Data Santri -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-user text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="font-medium text-gray-700">Data Santri</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        @if($santri)
                            Status: {{ $santri->status }}
                        @else
                            Data belum lengkap
                        @endif
                    </p>
                </div>
            </div>
            <a href="{{ route('user.data-santri') }}" class="mt-3 inline-block text-sm text-green-600 hover:text-green-800">
                Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Card Pembayaran -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-money-bill-wave text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="font-medium text-gray-700">Pembayaran</h3>
                    <p class="text-sm text-gray-500 mt-1">Status pembayaran terakhir</p>
                </div>
            </div>
            <a href="{{ route('user.pembayaran') }}" class="mt-3 inline-block text-sm text-blue-600 hover:text-blue-800">
                Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Card Berkas -->
        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-file-alt text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="font-medium text-gray-700">Berkas Santri</h3>
                    <p class="text-sm text-gray-500 mt-1">Kelengkapan dokumen</p>
                </div>
            </div>
            <a href="{{ route('user.berkas-santri') }}" class="mt-3 inline-block text-sm text-purple-600 hover:text-purple-800">
                Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
</div>
@endsection