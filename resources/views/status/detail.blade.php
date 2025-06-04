<!-- resources/views/status/detail.blade.php -->

<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5>Detail Pendaftaran</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $pendaftaran->nama_santri }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Pendaftaran</th>
                        <td>{{ $pendaftaran->nomor_pendaftaran }}</td>
                    </tr>
                    <h4>Status Pendaftaran: {{ $pendaftaran->status_berkas }}</h4>

                    @if (
                        $pendaftaran->status_berkas === 'revisi' ||
                            $pendaftaran->status_pembayaran === 'revisi' ||
                            $pendaftaran->status_sttb === 'revisi' ||
                            $pendaftaran->status_skhun === 'revisi' ||
                            $pendaftaran->status_pas_foto === 'revisi' ||
                            $pendaftaran->status_akta === 'revisi' ||
                            $pendaftaran->status_nisn === 'revisi')
                        <div class="alert alert-warning">
                            Ada dokumen yang perlu direvisi.
                        </div>

                        <a href="{{ route('revisi', ['token' => $pendaftaran->revision_token]) }}" class="btn btn-warning">
                            Kirim Revisi Dokumen
                        </a>
                    @endif
                    <tr>
                        <th>Status Pembayaran</th>
                        <td>{{ $pendaftaran->status_pembayaran }}</td>
                    </tr>
                    <!-- Tambahkan kolom lain sesuai kebutuhan -->
                </table>
            </div>
        </div>
    </div>

</body>

</html>
