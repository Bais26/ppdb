<!-- resources/views/status/revisi.blade.php -->

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Revisi Dokumen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-header bg-warning">
      <h5>Upload Dokumen Revisi</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('revisi.update', ['token' => $pendaftaran->revision_token]) }}" method="POST" enctype="multipart/form-data">

        @csrf

        @if ($pendaftaran->status_sttb == 'revisi')
          <div class="mb-3">
            <label class="form-label">Revisi STTB</label>
            <input type="file" name="foto_sttb" class="form-control">
          </div>
        @endif

        @if ($pendaftaran->status_skhun == 'revisi')
          <div class="mb-3">
            <label class="form-label">Revisi SKHUN</label>
            <input type="file" name="foto_skhun" class="form-control">
          </div>
        @endif

        @if ($pendaftaran->status_pas_foto == 'revisi')
          <div class="mb-3">
            <label class="form-label">Revisi Pas Foto</label>
            <input type="file" name="foto_skhun" class="form-control">
          </div>
        @endif

        @if ($pendaftaran->status_akta == 'revisi')
          <div class="mb-3">
            <label class="form-label">Revisi Akta</label>
            <input type="file" name="foto_skhun" class="form-control">
          </div>
        @endif

        @if ($pendaftaran->status_nisn == 'revisi')
          <div class="mb-3">
            <label class="form-label">Revisi NISN</label>
            <input type="file" name="foto_skhun" class="form-control">
          </div>
        @endif

        @if ($pendaftaran->status_pembayaran == 'revisi')
          <div class="mb-3">
            <label class="form-label">Bukti Pembayaran Baru</label>
            <input type="file" name="bukti_bayar" class="form-control">
          </div>
        @endif

        <button type="submit" class="btn btn-primary">Kirim Revisi</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>
