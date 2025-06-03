<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Pondok Pesantren Salafiyah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .payment-card {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .payment-info {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .payment-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #007bff;
        }

        .registration-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
        }

        .amount {
            font-size: 2rem;
            font-weight: bold;
        }

        .bank-info {
            background: white;
            padding: 20px;
            border-radius: 10px;
            border: 2px dashed #007bff;
            margin: 20px 0;
        }

        .copy-btn {
            cursor: pointer;
            color: #007bff;
        }

        .copy-btn:hover {
            color: #0056b3;
        }

        .status-badge {
            font-size: 0.9rem;
            padding: 8px 15px;
        }
        
        .fee-list {
            max-height: 400px;
            overflow-y: auto;
            padding-right: 10px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Header -->
                <div class="text-center mb-4">
                    <h2 class="text-primary">
                        <i class="fas fa-check-circle me-2"></i>
                        Pendaftaran Berhasil!
                    </h2>
                    <p class="text-muted">Silakan lanjutkan dengan melakukan pembayaran</p>
                </div>

                <!-- Registration Info -->
                <div class="card payment-card mb-4">
                    <div class="card-body">
                        <div class="payment-info text-center">
                            <h4><i class="fas fa-user-graduate me-2"></i>{{ $pendaftaran->nama_santri }}</h4>
                            <div class="registration-number">{{ $pendaftaran->nomor_pendaftaran }}</div>
                            <div class="mt-2">
                                @if ($pendaftaran->status_pembayaran == 'pending')
                                    <span class="badge bg-warning status-badge">Menunggu Pembayaran</span>
                                @elseif($pendaftaran->status_pembayaran == 'uploaded')
                                    <span class="badge bg-info status-badge">Bukti Bayar Diunggah</span>
                                @else
                                    <span class="badge bg-success status-badge">Pembayaran Terverifikasi</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="card payment-card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Detail Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="payment-details">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Rincian Biaya:</h6>
                                    <div class="fee-list">
                                        <ul class="list-unstyled">
                                            <li>• Pendaftaran Pondok: <strong>Rp 170.000</strong></li>
                                            <li>• Pendaftaran Madrasah Diniyah: <strong>Rp 170.000</strong></li>
                                            <li>• Muawanah: <strong>Rp 850.000</strong></li>
                                            <li>• Seragam Olah Raga Pondok: <strong>Rp 360.000</strong></li>
                                            <li>• Jas Almannater: <strong>Rp 240.000</strong></li>
                                            <li>• Kitab Pengajian Pondok & Madrasah: <strong>Rp 995.000</strong></li>
                                            <li>• Atribut Madin/pondok, batik madin: <strong>Rp 385.000</strong></li>
                                            <li>• Kartu Santri (Foto): <strong>Rp 80.000</strong></li>
                                            <li>• DP awal Ziarah-wali songo: <strong>Rp 500.000</strong></li>
                                            <li>• Masa Oriental Santri: <strong>Rp 140.000</strong></li>
                                            <li>• Syahriyah Pondok Perbulan: <strong>Rp 160.000</strong></li>
                                            <li>• Syahriyah Madrasah Perbulan: <strong>Rp 140.000</strong></li>
                                            <li>• Makah Perbulan (3x sehari): <strong>Rp 450.000</strong></li>
                                            <li>• Kegiatan Santri Perbulan: <strong>Rp 100.000</strong></li>
                                            <li>• Material: <strong>Rp 10.000</strong></li>
                                        </ul>
                                    </div>
                                    @php
                                        $pendaftaran_pondok = 170000;
                                        $pendaftaran_madrasah = 170000;
                                        $muawanah = 850000;
                                        $seragam_olahraga = 360000;
                                        $jas_almannater = 240000;
                                        $kitab_pengajian = 995000;
                                        $atribut = 385000;
                                        $kartu_santri = 80000;
                                        $ziarah = 500000;
                                        $orientasi = 140000;
                                        $syahriyah_pondok = 160000;
                                        $syahriyah_madrasah = 140000;
                                        $makah = 450000;
                                        $kegiatan_santri = 100000;
                                        $material = 10000;
                                        
                                        $total_bayar = 
                                            $pendaftaran_pondok +
                                            $pendaftaran_madrasah +
                                            $muawanah +
                                            $seragam_olahraga +
                                            $jas_almannater +
                                            $kitab_pengajian +
                                            $atribut +
                                            $kartu_santri +
                                            $ziarah +
                                            $orientasi +
                                            $syahriyah_pondok +
                                            $syahriyah_madrasah +
                                            $makah +
                                            $kegiatan_santri +
                                            $material;
                                    @endphp
                                </div>
                                <div class="col-md-6 text-end">
                                    <h6>Total Pembayaran:</h6>
                                    <div class="amount text-success">
                                        Rp {{ number_format($total_bayar, 0, ',', '.') }}
                                    </div>
                                    <small class="text-muted">*Pembayaran dilakukan sekali</small>
                                    <div class="mt-3">
                                        <div class="alert alert-warning">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <strong>Catatan:</strong> Biaya bulanan akan ditagih setiap bulan sesuai periode
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($pendaftaran->status_pembayaran == 'pending')
                    <!-- Payment Instructions -->
                    <div class="card payment-card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Petunjuk Pembayaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Penting!</strong> Lakukan pembayaran dalam waktu 24 jam untuk memastikan
                                pendaftaran Anda diproses.
                            </div>

                            <ol>
                                <li>Transfer ke rekening yang tertera di bawah</li>
                                <li>Pastikan nominal transfer <strong>TEPAT</strong> sesuai dengan total pembayaran (Rp 4.750.000)</li>
                                <li>Simpan bukti transfer</li>
                                <li>Upload bukti transfer melalui form di bawah</li>
                                <li>Tunggu konfirmasi dari admin (1-2 hari kerja)</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Bank Information -->
                    <div class="card payment-card mb-4">
                        <div class="card-body">
                            <button class="btn btn-success w-100 mb-3" onclick="showPaymentInfo()">
                                <i class="fas fa-credit-card me-2"></i>Lanjutkan Pembayaran
                            </button>

                            <div id="payment-info" style="display: none;">
                                <div class="bank-info text-center">
                                    <h5 class="text-primary mb-3">Informasi Transfer</h5>
                                    <hr>
                                    <div class="registration-number mb-2">{{ $pendaftaran->nomor_pendaftaran }}</div>
                                    <div class="amount mb-3">Rp 4.750.000</div>
                                    <hr>
                                    <div class="mb-2">
                                        <strong>Transfer ke:</strong><br>
                                        <span class="fs-5">BANK ABC - 123 456 7890</span>
                                        <i class="fas fa-copy copy-btn ms-2" onclick="copyToClipboard('1234567890')"
                                            title="Copy nomor rekening"></i>
                                    </div>
                                    <div class="mb-2">
                                        <strong>a.n. Pondok Pesantren Salafiyah</strong>
                                    </div>
                                    <hr>
                                    <small class="text-muted">
                                        * Pastikan nama pengirim sesuai dengan nama pendaftar<br>
                                        * Transfer harus dilakukan sebelum batas waktu yang ditentukan<br>
                                        * Cantumkan nomor pendaftaran pada keterangan transfer
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Upload Bukti Bayar -->
                <div class="card payment-card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="fas fa-upload me-2"></i>Upload Bukti Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            </div>
                        @endif

                        @if ($pendaftaran->bukti_bayar)
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Bukti pembayaran sudah diupload.</strong> Anda dapat mengupload ulang jika
                                diperlukan.
                                <br>
                                <small>Status:
                                    @if ($pendaftaran->status_pembayaran == 'uploaded')
                                        <span class="badge bg-info">Menunggu Verifikasi</span>
                                    @else
                                        <span class="badge bg-success">Terverifikasi</span>
                                    @endif
                                </small>
                            </div>
                        @endif

                        <form action="{{ route('pembayaran.upload', $pendaftaran->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Pilih File Bukti Pembayaran</label>
                                <input type="file" class="form-control" name="bukti_bayar" accept="image/*" required>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Format yang didukung: JPG, PNG, JPEG (Maksimal 2MB)
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="alert alert-light">
                                    <h6><i class="fas fa-camera me-2"></i>Tips Foto Bukti Transfer:</h6>
                                    <ul class="mb-0">
                                        <li>Pastikan foto jelas dan tidak buram</li>
                                        <li>Semua informasi transfer terlihat lengkap (nominal Rp 4.750.000)</li>
                                        <li>Nomor pendaftaran terlihat pada keterangan transfer</li>
                                        <li>Tanggal dan nomor rekening tujuan terlihat jelas</li>
                                        <li>Ukuran file tidak lebih dari 2MB</li>
                                    </ul>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-cloud-upload-alt me-2"></i>Upload Bukti Pembayaran
                            </button>
                        </form>

                        @if ($pendaftaran->bukti_bayar)
                            <div class="mt-3">
                                <h6>Bukti Pembayaran Saat Ini:</h6>
                                <img src="{{ Storage::url($pendaftaran->bukti_bayar) }}" class="img-thumbnail"
                                    style="max-width: 300px;" alt="Bukti Bayar">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="text-center mt-4">
                    <div class="alert alert-light">
                        <h6><i class="fas fa-headset me-2"></i>Butuh Bantuan?</h6>
                        <p class="mb-2">Hubungi kami jika mengalami kesulitan:</p>
                        <p class="mb-0">
                            <i class="fas fa-phone me-1"></i> 0812-3456-7890 |
                            <i class="fas fa-envelope me-1"></i> admin@pesantrensalafiyah.ac.id
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showPaymentInfo() {
            const paymentInfo = document.getElementById('payment-info');
            if (paymentInfo.style.display === 'none') {
                paymentInfo.style.display = 'block';
                paymentInfo.scrollIntoView({
                    behavior: 'smooth'
                });
            } else {
                paymentInfo.style.display = 'none';
            }
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show temporary success message
                const originalText = event.target.nextSibling;
                const originalIcon = event.target.className;
                event.target.className = 'fas fa-check copy-btn ms-2 text-success';

                setTimeout(() => {
                    event.target.className = originalIcon;
                }, 2000);

                // Show toast notification
                showToast('Nomor rekening berhasil disalin!');
            });
        }

        function showToast(message) {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #28a745;
                color: white;
                padding: 15px 20px;
                border-radius: 5px;
                z-index: 9999;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            `;
            toast.textContent = message;

            document.body.appendChild(toast);

            // Remove after 3 seconds
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 3000);
        }

        // Auto-hide payment info after successful upload
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                setTimeout(() => {
                    const alert = document.querySelector('.alert-success');
                    if (alert) {
                        alert.style.display = 'none';
                    }
                }, 5000);
            @endif
        });
    </script>
</body>

</html>