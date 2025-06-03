@extends('layouts.dashboard-user')

@section('title', 'Pembayaran')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold flex items-center">
            <i class="fas fa-money-bill-wave mr-2"></i> Pembayaran
        </h2>
        <p class="text-sm text-gray-500 mt-1">Riwayat dan status pembayaran</p>
    </div>
    
    <div class="p-6">
        @if($pembayaran->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Pembayaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pembayaran as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium">{{ $item->jenis_pembayaran }}</div>
                                <div class="text-sm text-gray-500">{{ $item->keterangan }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($item->status == 'lunas')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Lunas
                                    </span>
                                @elseif($item->status == 'pending')
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu Verifikasi
                                    </span>
                                @else
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Belum Dibayar
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($item->status != 'lunas')
                                    <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Bayar</a>
                                @endif
                                <a href="#" class="text-green-600 hover:text-green-900">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $pembayaran->links() }}
            </div>
        @else
            <div class="text-center py-8">
                <i class="fas fa-money-bill-wave text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-700 mb-2">Belum Ada Riwayat Pembayaran</h3>
                <p class="text-gray-500 mb-4">Silakan lakukan pembayaran pertama Anda</p>
                <a href="#" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <i class="fas fa-credit-card mr-2"></i> Bayar Sekarang
                </a>
            </div>
        @endif
    </div>
</div>
@endsection