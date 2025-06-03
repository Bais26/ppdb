<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class PendaftaranController extends Controller
{
    public function showForm()
    {
        return view('pendaftaran.form');
    }

    public function storeDataSantri(Request $request)
    {
        $request->validate([
            'nama_santri' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'asal_sekolah' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'nisn' => 'required|string|max:20',
            'email' => 'required|email|max:255'
        ]);

        Session::put('data_santri', $request->only([
            'nama_santri', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
            'alamat', 'no_hp', 'asal_sekolah', 'nik', 'nisn', 'email'
        ]));

        return response()->json(['success' => true]);
    }

    public function storeDataOrtu(Request $request)
    {
        $request->validate([
            'nama_orangtua' => 'required|string|max:255',
            'pekerjaan_orangtua' => 'required|string|max:255',
            'no_hp_ortu' => 'required|string|max:20',
            'alamat_ortu' => 'required|string'
        ]);

        Session::put('data_ortu', $request->only([
            'nama_orangtua', 'pekerjaan_orangtua', 'no_hp_ortu', 'alamat_ortu'
        ]));

        return response()->json(['success' => true]);
    }

    public function storeBerkas(Request $request)
    {
        $request->validate([
            'foto_sttb' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_skhun' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pas_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_akta' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_nisn' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $berkas = [];

        foreach (['foto_sttb', 'foto_skhun', 'pas_foto', 'foto_akta', 'foto_nisn'] as $file) {
            if ($request->hasFile($file)) {
                $berkas[$file] = $request->file($file)->store('berkas', 'public');
            }
        }

        Session::put('berkas', $berkas);

        return response()->json(['success' => true]);
    }

    public function getSummary()
    {
        return response()->json([
            'data_santri' => Session::get('data_santri', []),
            'data_ortu' => Session::get('data_ortu', []),
            'berkas' => Session::get('berkas', []),
        ]);
    }

    public function submitPendaftaran(Request $request)
    {
        $request->validate([
            'persetujuan' => 'required|accepted',
        ]);

        $dataSantri = Session::get('data_santri', []);
        $dataOrtu = Session::get('data_ortu', []);
        $berkas = Session::get('berkas', []);

        if (empty($dataSantri) || empty($dataOrtu) || empty($berkas)) {
            return response()->json(['error' => 'Data tidak lengkap'], 400);
        }

        $pendaftaran = Pendaftaran::create(array_merge(
            $dataSantri,
            $dataOrtu,
            $berkas,
            ['persetujuan' => true]
        ));

        Session::forget(['data_santri', 'data_ortu', 'berkas']);

        return response()->json([
            'success' => true,
            'redirect' => route('pembayaran', $pendaftaran->id)
        ]);
    }

    public function showPembayaran($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('pendaftaran.pembayaran', compact('pendaftaran'));
    }

    public function uploadBuktiBayar(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        if ($request->hasFile('bukti_bayar')) {
            if ($pendaftaran->bukti_bayar) {
                Storage::disk('public')->delete($pendaftaran->bukti_bayar);
            }

            $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

            $pendaftaran->update([
                'bukti_bayar' => $path,
                'status_pembayaran' => 'uploaded',
            ]);
        }

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload!');
    }
}
