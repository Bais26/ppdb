<!-- resources/views/admin/check.blade.php -->

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cek Status Pendaftaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h4>Cek Status Pendaftaran</h4>
        </div>
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              {{ $errors->first() }}
            </div>
          @endif

          <form action="{{ route('cek-status.check') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="nomor_pendaftaran" class="form-label">Nomor Pendaftaran</label>
              <input type="text" name="nomor_pendaftaran" id="nomor_pendaftaran" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
              <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Cek Status</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
