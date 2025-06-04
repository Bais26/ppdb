<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Revisi Dokumen Pendaftaran</title>
</head>
<body>
    <h2>Revisi Dokumen Pendaftaran PPDB</h2>
    
    <p>Yth. Orang Tua/Wali dari <strong>{{ $pendaftaran->nama_santri }}</strong>,</p>
    
    <p>Nomor Pendaftaran: <strong>{{ $pendaftaran->nomor_pendaftaran }}</strong></p>
    
    <p>Terdapat dokumen yang perlu direvisi untuk pendaftaran putra/putri Anda:</p>
    
    @if($pendaftaran->status_pembayaran === 'revisi')
    <div style="background: #fef3cd; padding: 10px; margin: 10px 0; border-radius: 5px;">
        <h4>Bukti Pembayaran</h4>
        <p><strong>Catatan:</strong> {{ $pendaftaran->catatan_pembayaran }}</p>
    </div>
    @endif
    
    @if($pendaftaran->status_sttb === 'revisi')
    <div style="background: #fef3cd; padding: 10px; margin: 10px 0; border-radius: 5px;">
        <h4>STTB</h4>
        <p><strong>Catatan:</strong> {{ $pendaftaran->catatan_sttb }}</p>
    </div>
    @endif
    
    @if($pendaftaran->status_skhun === 'revisi')
    <div style="background: #fef3cd; padding: 10px; margin: 10px 0; border-radius: 5px;">
        <h4>SKHUN</h4>
        <p><strong>Catatan:</strong> {{ $pendaftaran->catatan_skhun }}</p>
    </div>
    @endif
    
    @if($pendaftaran->status_pas_foto === 'revisi')
    <div style="background: #fef3cd; padding: 10px; margin: 10px 0; border-radius: 5px;">
        <h4>Pas Foto</h4>
        <p><strong>Catatan:</strong> {{ $pendaftaran->catatan_pas_foto }}</p>
    </div>
    @endif
    
    @if($pendaftaran->status_akta === 'revisi')
    <div style="background: #fef3cd; padding: 10px; margin: 10px 0; border-radius: 5px;">
        <h4>Akta Kelahiran</h4>
        <p><strong>Catatan:</strong> {{ $pendaftaran->catatan_akta }}</p>
    </div>
    @endif
    
    @if($pendaftaran->status_nisn === 'revisi')
    <div style="background: #fef3cd; padding: 10px; margin: 10px 0; border-radius: 5px;">
        <h4>NISN</h4>
        <p><strong>Catatan:</strong> {{ $pendaftaran->catatan_nisn }}</p>
    </div>
    @endif
    
    <p>Silakan upload ulang dokumen yang diperlukan melalui link berikut:</p>
    <p><a href="{{ $pendaftaran->getRevisionUrl() }}" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Upload Dokumen Revisi</a></p>
    
    <p><strong>Penting:</strong></p>
    <ul>
        <li>Link revisi berlaku selama 7 hari</li>
        <li>Pastikan dokumen yang diupload sesuai dengan catatan yang diberikan</li>
        <li>Jika ada kendala, silakan hubungi panitia PPDB</li>
    </ul>
    
    <p>Terima kasih atas perhatiannya.</p>
    
    <hr>
    <p><small>Email ini dikirim otomatis oleh sistem PPDB. Jangan membalas email ini.</small></p>
</body>
</html>
