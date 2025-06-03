<?php
// database/migrations/create_pendaftaran_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pendaftaran')->unique();
            
            // Data Santri
            $table->string('nama_santri');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('asal_sekolah');
            $table->string('nik');
            $table->string('nisn');
            $table->string('email');
            
            // Data Orang Tua
            $table->string('nama_orangtua');
            $table->string('pekerjaan_orangtua');
            $table->string('no_hp_ortu');
            $table->text('alamat_ortu');
            
            // Berkas
            $table->string('foto_sttb')->nullable();
            $table->string('foto_skhun')->nullable();
            $table->string('pas_foto')->nullable();
            $table->string('foto_akta')->nullable();
            $table->string('foto_nisn')->nullable();
            
            // Status
            $table->boolean('persetujuan')->default(false);
            $table->enum('status_pembayaran', ['pending', 'uploaded', 'verified'])->default('pending');
            $table->string('bukti_bayar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
};  