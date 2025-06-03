<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Santri;
use App\Models\OrangTua;
use App\Models\BerkasSantri;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    // Dashboard Utama
    public function dashboard()
    {
        $user = Auth::user();
        $santri = Santri::where('user_id', $user->id)->first();
        
        return view('user.dashboard', [
            'title' => 'Dashboard Santri',
            'user' => $user,
            'santri' => $santri
        ]);
    }

    // Data Santri
    public function dataSantri()
    {
        $user = Auth::user();
        $santri = Santri::where('user_id', $user->id)->firstOrFail();
        
        return view('user.data-santri', [
            'title' => 'Data Santri',
            'santri' => $santri
        ]);
    }

    // Data Orang Tua
    public function dataOrangTua()
    {
        $user = Auth::user();
        $santri = Santri::where('user_id', $user->id)->firstOrFail();
        $orangTua = OrangTua::where('santri_id', $santri->id)->first();
        
        return view('user.data-orangtua', [
            'title' => 'Data Orang Tua',
            'orangTua' => $orangTua,
            'santri' => $santri
        ]);
    }

    // Berkas Santri
    public function berkasSantri()
    {
        $user = Auth::user();
        $santri = Santri::where('user_id', $user->id)->firstOrFail();
        $berkas = BerkasSantri::where('santri_id', $santri->id)->first();
        
        return view('user.berkas-santri', [
            'title' => 'Berkas Santri',
            'berkas' => $berkas,
            'santri' => $santri
        ]);
    }

    // Pembayaran
    public function pembayaran()
    {
        $user = Auth::user();
        $santri = Santri::where('user_id', $user->id)->firstOrFail();
        $pembayaran = Pembayaran::where('santri_id', $santri->id)
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        return view('user.pembayaran', [
            'title' => 'Pembayaran',
            'pembayaran' => $pembayaran,
            'santri' => $santri
        ]);
    }
}