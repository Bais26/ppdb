<?php
// app/Http/Requests/DataSantriRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataSantriRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_santri' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string|max:1000',
            'no_hp' => 'required|string|max:20|regex:/^[0-9+\-\s]+$/',
            'asal_sekolah' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'nama_santri.required' => 'Nama santri wajib diisi',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'alamat.required' => 'Alamat wajib diisi',
            'no_hp.required' => 'Nomor HP wajib diisi',
            'no_hp.regex' => 'Format nomor HP tidak valid',
            'asal_sekolah.required' => 'Asal sekolah wajib diisi'
        ];
    }
}

// app/Http/Requests/DataOrtuRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataOrtuRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_ayah' => 'required|string|max:255',
            'pekerjaan_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_ibu' => 'required|string|max:255',
            'no_hp_ortu' => 'required|string|max:20|regex:/^[0-9+\-\s]+$/',
            'alamat_ortu' => 'required|string|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'nama_ayah.required' => 'Nama ayah wajib diisi',
            'pekerjaan_ayah.required' => 'Pekerjaan ayah wajib diisi',
            'nama_ibu.required' => 'Nama ibu wajib diisi',
            'pekerjaan_ibu.required' => 'Pekerjaan ibu wajib diisi',
            'no_hp_ortu.required' => 'Nomor HP orang tua wajib diisi',
            'no_hp_ortu.regex' => 'Format nomor HP tidak valid',
            'alamat_ortu.required' => 'Alamat orang tua wajib diisi'
        ];
    }
}

// app/Http/Requests/BerkasRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BerkasRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'ktp_ortu' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'kartu_keluarga' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'ijazah' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'foto.required' => 'Foto 3x4 wajib diupload',
            'foto.image' => 'File foto harus berupa gambar',
            'foto.mimes' => 'Format foto harus JPG, PNG, atau JPEG',
            'foto.max' => 'Ukuran foto maksimal 2MB',
            
            'ktp_ortu.required' => 'KTP orang tua wajib diupload',
            'ktp_ortu.image' => 'File KTP harus berupa gambar',
            'ktp_ortu.mimes' => 'Format KTP harus JPG, PNG, atau JPEG',
            'ktp_ortu.max' => 'Ukuran KTP maksimal 2MB',
            
            'kartu_keluarga.required' => 'Kartu keluarga wajib diupload',
            'kartu_keluarga.image' => 'File kartu keluarga harus berupa gambar',
            'kartu_keluarga.mimes' => 'Format kartu keluarga harus JPG, PNG, atau JPEG',
            'kartu_keluarga.max' => 'Ukuran kartu keluarga maksimal 2MB',
            
            'ijazah.required' => 'Ijazah/Raport wajib diupload',
            'ijazah.image' => 'File ijazah harus berupa gambar',
            'ijazah.mimes' => 'Format ijazah harus JPG, PNG, atau JPEG',
            'ijazah.max' => 'Ukuran ijazah maksimal 2MB'
        ];
    }
}