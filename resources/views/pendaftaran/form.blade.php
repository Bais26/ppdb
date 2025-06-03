<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran - Pondok Pesantren Salafiyah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .step {
            display: flex;
            align-items: center;
            margin: 0 10px;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }

        .step.active .step-number {
            background: #007bff;
            color: white;
        }

        .step.completed .step-number {
            background: #28a745;
            color: white;
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }

        .card {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .btn-next,
        .btn-prev {
            min-width: 120px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">Form Pendaftaran Santri Baru</h3>
                    </div>
                    <div class="card-body p-4">
                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            <div class="step active" id="step-1">
                                <div class="step-number">1</div>
                                <span>Data Santri</span>
                            </div>
                            <div class="step" id="step-2">
                                <div class="step-number">2</div>
                                <span>Data Orang Tua</span>
                            </div>
                            <div class="step" id="step-3">
                                <div class="step-number">3</div>
                                <span>Upload Berkas</span>
                            </div>
                            <div class="step" id="step-4">
                                <div class="step-number">4</div>
                                <span>Konfirmasi</span>
                            </div>
                        </div>

                        <div class="form-section active" id="section-1">
                            <h5 class="mb-3"><i class="fas fa-user me-2"></i>Data Santri</h5>
                            <form id="form-santri">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama_santri" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="tempat_lahir" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tanggal_lahir" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select class="form-select" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" name="alamat" rows="3" required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">No. HP</label>
                                        <input type="text" class="form-control" name="no_hp" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Asal Sekolah</label>
                                        <input type="text" class="form-control" name="asal_sekolah" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">NIK</label>
                                        <input type="text" class="form-control" name="nik" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">NISN</label>
                                        <input type="text" class="form-control" name="nisn" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </form>
                            <div class="d-flex justify-content-end mt-4">
                                <button class="btn btn-primary btn-next" onclick="nextStep(1)">Selanjutnya <i class="fas fa-arrow-right ms-1"></i></button>
                            </div>
                        </div>

                        <!-- Form Section 2: Data Orang Tua -->
                        <div class="form-section" id="section-2">
                            <h5 class="mb-3"><i class="fas fa-users me-2"></i>Data Orang Tua</h5>
                            <form id="form-ortu">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Orang Tua</label>
                                        <input type="text" class="form-control" name="nama_orangtua" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Pekerjaan Orang Tua</label>
                                        <input type="text" class="form-control" name="pekerjaan_orangtua" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">No. HP Orang Tua</label>
                                        <input type="text" class="form-control" name="no_hp_ortu" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat Orang Tua</label>
                                    <textarea class="form-control" name="alamat_ortu" rows="3" required></textarea>
                                </div>
                            </form>
                            <div class="d-flex justify-content-between mt-4">
                                <button class="btn btn-secondary btn-prev" onclick="prevStep(2)"><i
                                        class="fas fa-arrow-left me-1"></i> Sebelumnya</button>
                                <button class="btn btn-primary btn-next" onclick="nextStep(2)">Selanjutnya <i
                                        class="fas fa-arrow-right ms-1"></i></button>
                            </div>
                        </div>

                        <!-- Form Section 3: Upload Berkas -->
                        <div class="form-section" id="section-3">
                            <h5 class="mb-3"><i class="fas fa-file-upload me-2"></i>Upload Berkas</h5>
                            <form id="form-berkas" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Foto STTB (Ijazah)</label>
                                        <input type="file" class="form-control" name="foto_sttb" accept="image/*"
                                            required>
                                        <div class="form-text">Format: JPG, PNG (Max: 2MB)</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Foto SKHUN</label>
                                        <input type="file" class="form-control" name="foto_skhun"
                                            accept="image/*" required>
                                        <div class="form-text">Format: JPG, PNG (Max: 2MB)</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Pas Foto 3x4</label>
                                        <input type="file" class="form-control" name="pas_foto" accept="image/*"
                                            required>
                                        <div class="form-text">Format: JPG, PNG (Max: 2MB)</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Foto Akta Kelahiran</label>
                                        <input type="file" class="form-control" name="foto_akta" accept="image/*"
                                            required>
                                        <div class="form-text">Format: JPG, PNG (Max: 2MB)</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Foto Kartu NISN</label>
                                        <input type="file" class="form-control" name="foto_nisn" accept="image/*"
                                            required>
                                        <div class="form-text">Format: JPG, PNG (Max: 2MB)</div>
                                    </div>
                                </div>
                            </form>

                            <div class="d-flex justify-content-between mt-4">
                                <button class="btn btn-secondary btn-prev" onclick="prevStep(3)">
                                    <i class="fas fa-arrow-left me-1"></i> Sebelumnya
                                </button>
                                <button class="btn btn-primary btn-next" onclick="nextStep(3)">
                                    Selanjutnya <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>


                        <!-- Form Section 4: Konfirmasi -->
                        <div class="form-section" id="section-4">
                            <h5 class="mb-3"><i class="fas fa-check-circle me-2"></i>Konfirmasi Data</h5>

                            <div id="summary-data">
                                <!-- Summary akan dimuat via JavaScript -->
                            </div>

                            <div class="alert alert-info mt-4">
                                <h6><i class="fas fa-info-circle me-2"></i>Surat Pernyataan</h6>
                                <p class="mb-3">Dengan ini saya menyatakan bahwa:</p>
                                <ul class="mb-3">
                                    <li>Semua data yang saya berikan adalah benar dan dapat dipertanggungjawabkan</li>
                                    <li>Saya bersedia mengikuti semua peraturan yang berlaku di Pondok Pesantren
                                        Salafiyah</li>
                                    <li>Saya memahami bahwa pemberian data palsu dapat mengakibatkan pembatalan
                                        pendaftaran</li>
                                </ul>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="persetujuan"
                                        name="persetujuan" required>
                                    <label class="form-check-label" for="persetujuan">
                                        <strong>Saya setuju dengan semua pernyataan di atas</strong>
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button class="btn btn-secondary btn-prev" onclick="prevStep(4)"><i
                                        class="fas fa-arrow-left me-1"></i> Sebelumnya</button>
                                <button class="btn btn-success" onclick="submitForm()"><i
                                        class="fas fa-paper-plane me-1"></i> Kirim Pendaftaran</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="confirmModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Pendaftaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Apakah Anda yakin semua data sudah benar?</strong></p>
                    <div id="final-summary"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Periksa Lagi</button>
                    <button type="button" class="btn btn-success" onclick="finalSubmit()">Ya, Kirim
                        Pendaftaran</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Modal -->
    <div class="modal fade" id="loadingModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3 mb-0">Mengirim data...</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentStep = 1;
        const maxSteps = 4;

        function showStep(step) {
            // Hide all sections
            document.querySelectorAll('.form-section').forEach(section => {
                section.classList.remove('active');
            });

            // Show current section
            document.getElementById(`section-${step}`).classList.add('active');

            // Update step indicators
            document.querySelectorAll('.step').forEach((stepEl, index) => {
                stepEl.classList.remove('active', 'completed');
                if (index + 1 === step) {
                    stepEl.classList.add('active');
                } else if (index + 1 < step) {
                    stepEl.classList.add('completed');
                }
            });
        }

        async function nextStep(step) {
            if (await validateStep(step)) {
                currentStep = step + 1;
                if (currentStep === 4) {
                    await loadSummary();
                }
                showStep(currentStep);
            }
        }

        function prevStep(step) {
            currentStep = step - 1;
            showStep(currentStep);
        }

        async function validateStep(step) {
            const forms = ['form-santri', 'form-ortu', 'form-berkas'];
            const form = document.getElementById(forms[step - 1]);

            if (!form.checkValidity()) {
                form.reportValidity();
                return false;
            }

            // Submit data for current step
            const formData = new FormData(form);
            const routes = [
                '{{ route('pendaftaran.santri') }}',
                '{{ route('pendaftaran.ortu') }}',
                '{{ route('pendaftaran.berkas') }}'
            ];

            try {
                const response = await fetch(routes[step - 1], {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                const data = await response.json();

                if (!data.success) {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                    return false;
                }

                return true;
            } catch (error) {
                alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
                return false;
            }
        }

        async function loadSummary() {
            try {
                const response = await fetch('{{ route('pendaftaran.summary') }}');
                const data = await response.json();

                let summaryHtml = `
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Data Santri:</h6>
                            <p><strong>Nama:</strong> ${data.data_santri.nama_santri}</p>
                            <p><strong>TTL:</strong> ${data.data_santri.tempat_lahir}, ${data.data_santri.tanggal_lahir}</p>
                            <p><strong>Jenis Kelamin:</strong> ${data.data_santri.jenis_kelamin}</p>
                            <p><strong>No. HP:</strong> ${data.data_santri.no_hp}</p>
                            <p><strong>Asal Sekolah:</strong> ${data.data_santri.asal_sekolah}</p>
                            <p><strong>NIK:</strong> ${data.data_santri.nik}</p>
                            <p><strong>NISN:</strong> ${data.data_santri.nisn}</p>
                            <p><strong>Email:</strong> ${data.data_santri.email}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Data Orang Tua:</h6>
                            <p><strong>Nama orangtua:</strong> ${data.data_ortu.nama_orangtua} (${data.data_ortu.pekerjaan_orangtua})</p>
                            <p><strong>No. HP:</strong> ${data.data_ortu.no_hp_ortu}</p>
                            <p><strong>Alamat</strong> ${data.data_ortu.alamat_ortu}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h6>Berkas Terupload:</h6>
                        <ul>
                            <li>✅ Foto 3x4</li>
                            <li>✅ KTP Orang Tua</li>
                            <li>✅ Kartu Keluarga</li>
                            <li>✅ Ijazah/Raport</li>
                        </ul>
                    </div>
                `;

                document.getElementById('summary-data').innerHTML = summaryHtml;
                document.getElementById('final-summary').innerHTML = summaryHtml;
            } catch (error) {
                console.error('Error loading summary:', error);
            }
        }

        function submitForm() {
            const persetujuan = document.getElementById('persetujuan');
            if (!persetujuan.checked) {
                alert('Anda harus menyetujui surat pernyataan terlebih dahulu.');
                return;
            }

            // Show confirmation modal
            new bootstrap.Modal(document.getElementById('confirmModal')).show();
        }

        async function finalSubmit() {
            // Hide confirm modal and show loading
            bootstrap.Modal.getInstance(document.getElementById('confirmModal')).hide();
            new bootstrap.Modal(document.getElementById('loadingModal')).show();

            try {
                const response = await fetch('{{ route('pendaftaran.submit') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        persetujuan: true
                    })
                });

                const data = await response.json();

                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                    bootstrap.Modal.getInstance(document.getElementById('loadingModal')).hide();
                }
            } catch (error) {
                alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
                bootstrap.Modal.getInstance(document.getElementById('loadingModal')).hide();
            }
        }
    </script>
</body>

</html>
