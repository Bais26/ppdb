<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatusController extends Controller
{
    public function index()
    {
        return view('admin.check');
    }
    
    public function check(Request $request)
    {
        $request->validate([
            'nomor_pendaftaran' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);
        
        $pendaftaran = Pendaftaran::where('nomor_pendaftaran', $request->nomor_pendaftaran)
            ->where('tanggal_lahir', $request->tanggal_lahir)
            ->first();
            
        if (!$pendaftaran) {
            return back()->withErrors(['error' => 'Data tidak ditemukan. Periksa kembali nomor pendaftaran dan tanggal lahir.']);
        }
        
        return view('status.detail', compact('pendaftaran'));
    }
    
    public function revisi($token)
    {
        $pendaftaran = Pendaftaran::where('revision_token', $token)->first();
        
        if (!$pendaftaran) {
            abort(404, 'Link revisi tidak valid');
        }
        
        // Cek apakah masih perlu revisi
        if (!in_array($pendaftaran->status_berkas, ['revisi']) && 
            !in_array($pendaftaran->status_pembayaran, ['revisi'])) {
            return view('status.no-revision-needed');
        }
        
        return view('status.revisi', compact('pendaftaran'));
    }
    
    public function updateRevisi(Request $request, $token)
    {
        $pendaftaran = Pendaftaran::where('revision_token', $token)->first();
        
        if (!$pendaftaran) {
            abort(404);
        }
        
        $updateData = [];
        
        // Handle file uploads untuk dokumen yang perlu direvisi
        if ($pendaftaran->status_sttb === 'revisi' && $request->hasFile('foto_sttb')) {
            $updateData['foto_sttb'] = $request->file('foto_sttb')->store('documents/sttb', 'public');
            $updateData['status_sttb'] = 'pending'; // Reset ke pending untuk re-review
        }
        
        if ($pendaftaran->status_skhun === 'revisi' && $request->hasFile('foto_skhun')) {
            $updateData['foto_skhun'] = $request->file('foto_skhun')->store('documents/skhun', 'public');
            $updateData['status_skhun'] = 'pending';
        }
        
        if ($pendaftaran->status_pas_foto === 'revisi' && $request->hasFile('pas_foto')) {
            $updateData['pas_foto'] = $request->file('pas_foto')->store('documents/pas-foto', 'public');
            $updateData['status_pas_foto'] = 'pending';
        }
        
        if ($pendaftaran->status_akta === 'revisi' && $request->hasFile('foto_akta')) {
            $updateData['foto_akta'] = $request->file('foto_akta')->store('documents/akta', 'public');
            $updateData['status_akta'] = 'pending';
        }
        
        if ($pendaftaran->status_nisn === 'revisi' && $request->hasFile('foto_nisn')) {
            $updateData['foto_nisn'] = $request->file('foto_nisn')->store('documents/nisn', 'public');
            $updateData['status_nisn'] = 'pending';
        }
        
        // Handle bukti pembayaran
        if ($pendaftaran->status_pembayaran === 'revisi' && $request->hasFile('bukti_bayar')) {
            $updateData['bukti_bayar'] = $request->file('bukti_bayar')->store('payments', 'public');
            $updateData['status_pembayaran'] = 'uploaded';
        }
        
        if (!empty($updateData)) {
            // Update status berkas jika ada dokumen yang diupload
            if (count(array_intersect(['status_sttb', 'status_skhun', 'status_pas_foto', 'status_akta', 'status_nisn'], array_keys($updateData))) > 0) {
                $updateData['status_berkas'] = 'pending';
            }
            
            $pendaftaran->update($updateData);
            
            return redirect()->route('cek-status')->with('success', 'Dokumen berhasil diperbarui. Silakan tunggu proses verifikasi ulang.');
        }
        
        return back()->withErrors(['error' => 'Tidak ada dokumen yang diupload.']);
    }
}