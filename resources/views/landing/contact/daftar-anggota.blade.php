@extends('layouts.landing')

@section('title', 'Pendaftaran Anggota Jemaat - Gereja Toraja Eben-Haezer Selili')

@section('content')

    <!-- Form Header -->
    <div class="form-header">
        <div class="form-container">
            <h1 class="form-title">Form Pendaftaran Anggota Jemaat</h1>
            <p class="form-subtitle">Silakan isi formulir di bawah ini untuk mendaftarkan diri sebagai anggota jemaat</p>
        </div>
    </div>

    <!-- Tabel Data Anggota -->
    @if(isset($anggotas) && count($anggotas) > 0)
        <div class="form-section">
            <h2 class="form-section-title"><i class="fas fa-users"></i> Daftar Anggota Jemaat</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Tempat Tinggal</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anggotas as $anggota)
                    <tr>
                        <td>{{ $anggota->nama_lengkap }}</td>
                        <td>{{ $anggota->tempat_tinggal }}</td>
                        <td>{{ $anggota->no_hp }}</td>
                        <td>
                            <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Form Content -->
    <div class="form-container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('submit-anggota') }}" method="POST" id="anggotaForm" enctype="multipart/form-data">
            @csrf

            <!-- Informasi Format -->
            <div class="info-section">
                <h2 class="info-title"><i class="fas fa-info-circle"></i> Kolom Data Anggota Keluarga</h2>
                <div class="info-table-container">
                    <table class="info-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kolom</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>1</td><td>Nomor KK/Anggota</td><td>Nomor urut keluarga dan anggota. KK = Kepala Keluarga, Ang. = Anggota.</td></tr>
                            <tr><td>2</td><td>Nama Lengkap</td><td>Nama lengkap dari masing-masing anggota keluarga.</td></tr>
                            <tr><td>3</td><td>Jenis Kelamin</td><td>Pr (Perempuan), Lk (Laki-laki).</td></tr>
                            <tr><td>4</td><td>Tempat, Tanggal Lahir</td><td>Diisi dengan tempat dan tanggal lahir anggota.</td></tr>
                            <tr><td>5</td><td>BAPTIS / SIDI</td><td>Centang S (Sudah) atau B (Belum) untuk status Baptis dan Sidi.</td></tr>
                            <tr><td>6</td><td>Tempat, Tanggal Pernikahan</td><td>Jika sudah menikah, isi tempat dan tanggal pernikahan.</td></tr>
                            <tr><td>7</td><td>Hubungan Keluarga</td><td>Misalnya: Suami, Istri, Anak, Kakak, Adik, dll.</td></tr>
                            <tr><td>8</td><td>Pendidikan Terakhir</td><td>Pendidikan formal terakhir yang diselesaikan.</td></tr>
                            <tr><td>9</td><td>Pekerjaan Sekarang</td><td>Pekerjaan aktif saat ini. Contoh: PNS, Petani, Swasta, dll.</td></tr>
                            <tr><td>10</td><td>Status</td><td>Pilihan: K (Kawin), B (Belum), J (Janda), D (Duda)</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form Data Anggota -->
            <div class="form-section">
                <h2 class="form-section-title"><i class="fas fa-users"></i> Data Anggota Keluarga</h2>

                <!-- Container untuk multiple anggota -->
                <div id="anggota-container">
                    <!-- Anggota pertama (Kepala Keluarga) -->
                    <div class="anggota-form" data-anggota="1">
                        <h3 class="anggota-title">
                            <i class="fas fa-user-tie"></i> Kepala Keluarga
                            <span class="anggota-number">KK-001</span>
                        </h3>

                        <!-- 1. Nomor KK/Anggota (Auto-generated) -->
                        <div class="form-group">
                            <label class="form-label">1. Nomor KK/Anggota</label>
                            <input type="text" class="form-input" value="KK-001" readonly style="background-color: #f8f9fa;">
                            <small class="form-text text-muted">Nomor otomatis untuk Kepala Keluarga</small>
                        </div>

                        <!-- 2. Nama Lengkap -->
                        <div class="form-group">
                            <label for="nama_lengkap_1" class="form-label">2. Nama Lengkap</label>
                            <input type="text" id="nama_lengkap_1" name="anggota[1][nama_lengkap]" class="form-input" placeholder="Masukkan nama lengkap" required>
                            @error('anggota.1.nama_lengkap')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- 3. Jenis Kelamin -->
                        <div class="form-group">
                            <label for="jenis_kelamin_1" class="form-label">3. Jenis Kelamin</label>
                            <select id="jenis_kelamin_1" name="anggota[1][jenis_kelamin]" class="form-input" required>
                                <option value="">Pilih jenis kelamin</option>
                                <option value="Lk">Lk (Laki-laki)</option>
                                <option value="Pr">Pr (Perempuan)</option>
                            </select>
                            @error('anggota.1.jenis_kelamin')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- 4. Tempat, Tanggal Lahir -->
                        <div class="form-row">
                            <div class="form-col">
                                <label for="tempat_lahir_1" class="form-label">4a. Tempat Lahir</label>
                                <input type="text" id="tempat_lahir_1" name="anggota[1][tempat_lahir]" class="form-input" placeholder="Tempat lahir" required>
                                @error('anggota.1.tempat_lahir')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-col">
                                <label for="tanggal_lahir_1" class="form-label">4b. Tanggal Lahir</label>
                                <input type="date" id="tanggal_lahir_1" name="anggota[1][tanggal_lahir]" class="form-input" required>
                                @error('anggota.1.tanggal_lahir')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- 5. BAPTIS / SIDI -->
                        <div class="form-row">
                            <div class="form-col">
                                <label class="form-label">5a. Status Baptis</label>
                                <div class="radio-group">
                                    <label class="radio-label">
                                        <input type="radio" name="anggota[1][status_baptis]" value="S" required> S (Sudah)
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="anggota[1][status_baptis]" value="B" required> B (Belum)
                                    </label>
                                </div>
                                @error('anggota.1.status_baptis')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-col">
                                <label class="form-label">5b. Status Sidi</label>
                                <div class="radio-group">
                                    <label class="radio-label">
                                        <input type="radio" name="anggota[1][status_sidi]" value="S" required> S (Sudah)
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="anggota[1][status_sidi]" value="B" required> B (Belum)
                                    </label>
                                </div>
                                @error('anggota.1.status_sidi')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- 6. Tempat, Tanggal Pernikahan -->
                        <div class="form-row">
                            <div class="form-col">
                                <label for="tempat_nikah_1" class="form-label">6a. Tempat Pernikahan</label>
                                <input type="text" id="tempat_nikah_1" name="anggota[1][tempat_nikah]" class="form-input" placeholder="Kosongkan jika belum menikah">
                                @error('anggota.1.tempat_nikah')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-col">
                                <label for="tanggal_nikah_1" class="form-label">6b. Tanggal Pernikahan</label>
                                <input type="date" id="tanggal_nikah_1" name="anggota[1][tanggal_nikah]" class="form-input">
                                @error('anggota.1.tanggal_nikah')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- 7. Hubungan Keluarga -->
                        <div class="form-group">
                            <label for="hubungan_keluarga_1" class="form-label">7. Hubungan Keluarga</label>
                            <select id="hubungan_keluarga_1" name="anggota[1][hubungan_keluarga]" class="form-input" required>
                                <option value="">Pilih hubungan keluarga</option>
                                <option value="Kepala Keluarga" selected>Kepala Keluarga</option>
                                <option value="Suami">Suami</option>
                                <option value="Istri">Istri</option>
                                <option value="Anak">Anak</option>
                                <option value="Kakak">Kakak</option>
                                <option value="Adik">Adik</option>
                                <option value="Orang Tua">Orang Tua</option>
                                <option value="Mertua">Mertua</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('anggota.1.hubungan_keluarga')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- 8. Pendidikan Terakhir -->
                        <div class="form-group">
                            <label for="pendidikan_1" class="form-label">8. Pendidikan Terakhir</label>
                            <select id="pendidikan_1" name="anggota[1][pendidikan]" class="form-input" required>
                                <option value="">Pilih pendidikan terakhir</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA/SMK">SMA/SMK</option>
                                <option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="D3">D3</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            @error('anggota.1.pendidikan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- 9. Pekerjaan Sekarang -->
                        <div class="form-group">
                            <label for="pekerjaan_1" class="form-label">9. Pekerjaan Sekarang</label>
                            <input type="text" id="pekerjaan_1" name="anggota[1][pekerjaan]" class="form-input" placeholder="Contoh: PNS, Petani, Swasta, dll" required>
                            @error('anggota.1.pekerjaan')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- 10. Status -->
                        <div class="form-group">
                            <label class="form-label">10. Status</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="anggota[1][status]" value="K" required> K (Kawin)
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="anggota[1][status]" value="B" required> B (Belum)
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="anggota[1][status]" value="J" required> J (Janda)
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="anggota[1][status]" value="D" required> D (Duda)
                                </label>
                            </div>
                            @error('anggota.1.status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol untuk menambah anggota keluarga -->
                <div class="add-member-section">
                    <button type="button" class="btn btn-add-member" onclick="addFamilyMember()">
                        <i class="fas fa-plus"></i> Tambah Anggota Keluarga
                    </button>
                </div>

                <!-- Hidden input for verified email -->
                <input type="hidden" id="hiddenEmail" name="email" value="">

                <button type="button" class="btn btn-submit" id="submitBtn" onclick="showEmailVerificationModal()" disabled>Daftar Keluarga</button>
            </div>
        </form>

        <!-- Email Verification Modal -->
        <div id="emailVerificationModal" class="modal" style="display: none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><i class="fas fa-envelope"></i> Verifikasi Email</h3>
                    <span class="close" onclick="closeEmailModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <div id="emailStep" class="verification-step">
                        <p>Masukkan email Anda untuk menerima kode verifikasi:</p>
                        <div class="form-group">
                            <input type="email" id="verificationEmail" class="form-input" placeholder="Masukkan email Anda" required>
                            <span class="error-message" id="emailError"></span>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="sendVerificationCode()">
                            <i class="fas fa-paper-plane"></i> Kirim Kode
                        </button>
                    </div>

                    <div id="codeStep" class="verification-step" style="display: none;">
                        <p>Masukkan kode verifikasi yang telah dikirim ke email Anda:</p>
                        <div class="form-group">
                            <input type="text" id="verificationCode" class="form-input" placeholder="Masukkan 6 digit kode" maxlength="6" required>
                            <span class="error-message" id="codeError"></span>
                        </div>
                        <div class="verification-actions">
                            <button type="button" class="btn btn-secondary" onclick="backToEmailStep()">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </button>
                            <button type="button" class="btn btn-primary" onclick="verifyCode()">
                                <i class="fas fa-check"></i> Verifikasi
                            </button>
                        </div>
                        <p class="resend-info">
                            Tidak menerima kode?
                            <a href="#" onclick="sendVerificationCode()" class="resend-link">Kirim ulang</a>
                        </p>
                    </div>

                    <div id="loadingStep" class="verification-step" style="display: none;">
                        <div class="loading-spinner">
                            <i class="fas fa-spinner fa-spin"></i>
                            <p>Memproses...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>
    /* Info Table Styles */
    .info-section {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
    }

    .info-title {
        color: #8B4513;
        margin-bottom: 20px;
        font-size: 1.2em;
        font-weight: 600;
    }

    .info-table-container {
        overflow-x: auto;
    }

    .info-table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .info-table th,
    .info-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #dee2e6;
    }

    .info-table th {
        background-color: #8B4513;
        color: white;
        font-weight: 600;
        font-size: 14px;
    }

    .info-table td {
        font-size: 13px;
        line-height: 1.4;
    }

    .info-table tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    .info-table tr:hover {
        background-color: #e9ecef;
    }

    /* Anggota Form Styles */
    .anggota-form {
        border: 2px solid #8B4513;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 25px;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .anggota-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #8B4513;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #8B4513;
        font-size: 1.1em;
        font-weight: 600;
    }

    .anggota-number {
        background-color: #8B4513;
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: 500;
    }

    /* Radio Group Styles */
    .radio-group {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        margin-top: 8px;
    }

    .radio-label {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-weight: 500;
        color: #495057;
        transition: color 0.3s ease;
    }

    .radio-label:hover {
        color: #8B4513;
    }

    .radio-label input[type="radio"] {
        width: 18px;
        height: 18px;
        accent-color: #8B4513;
    }

    /* Add Member Button */
    .add-member-section {
        text-align: center;
        margin: 30px 0;
        padding: 20px;
        border: 2px dashed #8B4513;
        border-radius: 12px;
        background-color: #f8f9fa;
    }

    .btn-add-member {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 auto;
    }

    .btn-add-member:hover {
        background-color: #218838;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    /* Remove Member Button */
    .btn-remove-member {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9em;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-remove-member:hover {
        background-color: #c82333;
        transform: translateY(-1px);
    }

    /* Submit Button Styles */
    .btn-submit {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin: 20px auto;
        min-width: 200px;
    }

    .btn-submit:hover:not(:disabled) {
        background-color: #218838;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .btn-submit:disabled {
        background-color: #6c757d !important;
        cursor: not-allowed !important;
        transform: none !important;
        box-shadow: none !important;
    }

    /* Modal Styles */
    .modal {
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background-color: white;
        border-radius: 12px;
        width: 90%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
        from { transform: translateY(-50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        border-bottom: 1px solid #dee2e6;
        background-color: #8B4513;
        color: white;
        border-radius: 12px 12px 0 0;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 1.2em;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .close {
        font-size: 24px;
        font-weight: bold;
        cursor: pointer;
        color: white;
        transition: color 0.3s ease;
    }

    .close:hover {
        color: #f8f9fa;
    }

    .modal-body {
        padding: 25px;
    }

    .verification-step {
        text-align: center;
    }

    .verification-actions {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 20px;
    }

    .btn-primary {
        background-color: #8B4513;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary:hover {
        background-color: #7a3e11;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
    }

    .loading-spinner {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        padding: 30px;
    }

    .loading-spinner i {
        font-size: 2em;
        color: #8B4513;
    }

    .resend-info {
        margin-top: 15px;
        font-size: 0.9em;
        color: #6c757d;
    }

    .resend-link {
        color: #8B4513;
        text-decoration: none;
        font-weight: 600;
    }

    .resend-link:hover {
        text-decoration: underline;
    }

    .error-message {
        color: #dc3545;
        font-size: 0.9em;
        margin-top: 5px;
        display: block;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .info-table {
            font-size: 12px;
        }

        .info-table th,
        .info-table td {
            padding: 8px 10px;
        }

        .anggota-form {
            padding: 20px 15px;
        }

        .anggota-title {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }

        .radio-group {
            flex-direction: column;
            gap: 10px;
        }

        .modal-content {
            width: 95%;
            margin: 10px;
        }

        .modal-body {
            padding: 20px 15px;
        }

        .verification-actions {
            flex-direction: column;
        }
    }
    </style>

    <script>
    let memberCount = 1;

    function addFamilyMember() {
        memberCount++;
        const container = document.getElementById('anggota-container');

        const newMemberHtml = `
            <div class="anggota-form" data-anggota="${memberCount}">
                <div class="anggota-title">
                    <span><i class="fas fa-user"></i> Anggota Keluarga ${memberCount}</span>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <span class="anggota-number">Ang-${String(memberCount).padStart(3, '0')}</span>
                        <button type="button" class="btn-remove-member" onclick="removeFamilyMember(${memberCount})">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>

                <!-- 1. Nomor KK/Anggota -->
                <div class="form-group">
                    <label class="form-label">1. Nomor KK/Anggota</label>
                    <input type="text" class="form-input" value="Ang-${String(memberCount).padStart(3, '0')}" readonly style="background-color: #f8f9fa;">
                    <small class="form-text text-muted">Nomor otomatis untuk Anggota ${memberCount}</small>
                </div>

                <!-- 2. Nama Lengkap -->
                <div class="form-group">
                    <label for="nama_lengkap_${memberCount}" class="form-label">2. Nama Lengkap</label>
                    <input type="text" id="nama_lengkap_${memberCount}" name="anggota[${memberCount}][nama_lengkap]" class="form-input" placeholder="Masukkan nama lengkap" required>
                </div>

                <!-- 3. Jenis Kelamin -->
                <div class="form-group">
                    <label for="jenis_kelamin_${memberCount}" class="form-label">3. Jenis Kelamin</label>
                    <select id="jenis_kelamin_${memberCount}" name="anggota[${memberCount}][jenis_kelamin]" class="form-input" required>
                        <option value="">Pilih jenis kelamin</option>
                        <option value="Lk">Lk (Laki-laki)</option>
                        <option value="Pr">Pr (Perempuan)</option>
                    </select>
                </div>

                <!-- 4. Tempat, Tanggal Lahir -->
                <div class="form-row">
                    <div class="form-col">
                        <label for="tempat_lahir_${memberCount}" class="form-label">4a. Tempat Lahir</label>
                        <input type="text" id="tempat_lahir_${memberCount}" name="anggota[${memberCount}][tempat_lahir]" class="form-input" placeholder="Tempat lahir" required>
                    </div>
                    <div class="form-col">
                        <label for="tanggal_lahir_${memberCount}" class="form-label">4b. Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir_${memberCount}" name="anggota[${memberCount}][tanggal_lahir]" class="form-input" required>
                    </div>
                </div>

                <!-- 5. BAPTIS / SIDI -->
                <div class="form-row">
                    <div class="form-col">
                        <label class="form-label">5a. Status Baptis</label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="anggota[${memberCount}][status_baptis]" value="S" required> S (Sudah)
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="anggota[${memberCount}][status_baptis]" value="B" required> B (Belum)
                            </label>
                        </div>
                    </div>
                    <div class="form-col">
                        <label class="form-label">5b. Status Sidi</label>
                        <div class="radio-group">
                            <label class="radio-label">
                                <input type="radio" name="anggota[${memberCount}][status_sidi]" value="S" required> S (Sudah)
                            </label>
                            <label class="radio-label">
                                <input type="radio" name="anggota[${memberCount}][status_sidi]" value="B" required> B (Belum)
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 6. Tempat, Tanggal Pernikahan -->
                <div class="form-row">
                    <div class="form-col">
                        <label for="tempat_nikah_${memberCount}" class="form-label">6a. Tempat Pernikahan</label>
                        <input type="text" id="tempat_nikah_${memberCount}" name="anggota[${memberCount}][tempat_nikah]" class="form-input" placeholder="Kosongkan jika belum menikah">
                    </div>
                    <div class="form-col">
                        <label for="tanggal_nikah_${memberCount}" class="form-label">6b. Tanggal Pernikahan</label>
                        <input type="date" id="tanggal_nikah_${memberCount}" name="anggota[${memberCount}][tanggal_nikah]" class="form-input">
                    </div>
                </div>

                <!-- 7. Hubungan Keluarga -->
                <div class="form-group">
                    <label for="hubungan_keluarga_${memberCount}" class="form-label">7. Hubungan Keluarga</label>
                    <select id="hubungan_keluarga_${memberCount}" name="anggota[${memberCount}][hubungan_keluarga]" class="form-input" required>
                        <option value="">Pilih hubungan keluarga</option>
                        <option value="Suami">Suami</option>
                        <option value="Istri">Istri</option>
                        <option value="Anak">Anak</option>
                        <option value="Kakak">Kakak</option>
                        <option value="Adik">Adik</option>
                        <option value="Orang Tua">Orang Tua</option>
                        <option value="Mertua">Mertua</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- 8. Pendidikan Terakhir -->
                <div class="form-group">
                    <label for="pendidikan_${memberCount}" class="form-label">8. Pendidikan Terakhir</label>
                    <select id="pendidikan_${memberCount}" name="anggota[${memberCount}][pendidikan]" class="form-input" required>
                        <option value="">Pilih pendidikan terakhir</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="D1">D1</option>
                        <option value="D2">D2</option>
                        <option value="D3">D3</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- 9. Pekerjaan Sekarang -->
                <div class="form-group">
                    <label for="pekerjaan_${memberCount}" class="form-label">9. Pekerjaan Sekarang</label>
                    <input type="text" id="pekerjaan_${memberCount}" name="anggota[${memberCount}][pekerjaan]" class="form-input" placeholder="Contoh: PNS, Petani, Swasta, dll" required>
                </div>

                <!-- 10. Status -->
                <div class="form-group">
                    <label class="form-label">10. Status</label>
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" name="anggota[${memberCount}][status]" value="K" required> K (Kawin)
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="anggota[${memberCount}][status]" value="B" required> B (Belum)
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="anggota[${memberCount}][status]" value="J" required> J (Janda)
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="anggota[${memberCount}][status]" value="D" required> D (Duda)
                        </label>
                    </div>
                </div>
            </div>
        `;

        // Insert before the add member section
        const addMemberSection = document.querySelector('.add-member-section');
        addMemberSection.insertAdjacentHTML('beforebegin', newMemberHtml);

        // Scroll to new member
        const newMember = document.querySelector(`[data-anggota="${memberCount}"]`);
        newMember.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function removeFamilyMember(memberNumber) {
        if (memberNumber === 1) {
            alert('Kepala keluarga tidak dapat dihapus!');
            return;
        }

        if (confirm('Apakah Anda yakin ingin menghapus anggota keluarga ini?')) {
            const memberElement = document.querySelector(`[data-anggota="${memberNumber}"]`);
            if (memberElement) {
                memberElement.remove();
                checkFormValidity(); // Recheck validation after removing member
            }
        }
    }

    // Form validation
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('anggotaForm');
        const submitBtn = document.getElementById('submitBtn');

        // Function to check if all required fields are filled
        function checkFormValidity() {
            const requiredFields = form.querySelectorAll('[required]');
            let allValid = true;

            requiredFields.forEach(field => {
                if (field.type === 'radio') {
                    // For radio buttons, check if any in the group is selected
                    const radioGroup = form.querySelectorAll(`[name="${field.name}"]`);
                    const isRadioGroupValid = Array.from(radioGroup).some(radio => radio.checked);
                    if (!isRadioGroupValid) {
                        allValid = false;
                    }
                } else if (field.type === 'select-one') {
                    // For select fields
                    if (!field.value || field.value === '') {
                        allValid = false;
                    }
                } else {
                    // For text, date, etc.
                    if (!field.value.trim()) {
                        allValid = false;
                    }
                }
            });

            // Enable/disable submit button based on validation
            submitBtn.disabled = !allValid;

            if (allValid) {
                submitBtn.style.backgroundColor = '#28a745';
                submitBtn.style.cursor = 'pointer';
            } else {
                submitBtn.style.backgroundColor = '#6c757d';
                submitBtn.style.cursor = 'not-allowed';
            }
        }

        // Add event listeners to all form inputs
        function addEventListeners() {
            const allInputs = form.querySelectorAll('input, select, textarea');
            allInputs.forEach(input => {
                input.addEventListener('input', checkFormValidity);
                input.addEventListener('change', checkFormValidity);
            });
        }

        // Initial setup
        addEventListeners();
        checkFormValidity();

        // Re-add event listeners when new members are added
        const originalAddFamilyMember = window.addFamilyMember;
        window.addFamilyMember = function() {
            originalAddFamilyMember();
            setTimeout(() => {
                addEventListeners();
                checkFormValidity();
            }, 100);
        };
    });

    // Make checkFormValidity globally available
    window.checkFormValidity = function() {
        const form = document.getElementById('anggotaForm');
        const submitBtn = document.getElementById('submitBtn');
        const requiredFields = form.querySelectorAll('[required]');
        let allValid = true;

        requiredFields.forEach(field => {
            if (field.type === 'radio') {
                const radioGroup = form.querySelectorAll(`[name="${field.name}"]`);
                const isRadioGroupValid = Array.from(radioGroup).some(radio => radio.checked);
                if (!isRadioGroupValid) {
                    allValid = false;
                }
            } else if (field.type === 'select-one') {
                if (!field.value || field.value === '') {
                    allValid = false;
                }
            } else {
                if (!field.value.trim()) {
                    allValid = false;
                }
            }
        });

        submitBtn.disabled = !allValid;

        if (allValid) {
            submitBtn.style.backgroundColor = '#28a745';
            submitBtn.style.cursor = 'pointer';
        } else {
            submitBtn.style.backgroundColor = '#6c757d';
            submitBtn.style.cursor = 'not-allowed';
        }
    };

    // Email Verification Functions
    function showEmailVerificationModal() {
        // Check if form is valid first
        if (!window.checkFormValidity || document.getElementById('submitBtn').disabled) {
            alert('Silakan lengkapi semua field yang wajib diisi terlebih dahulu.');
            return;
        }

        document.getElementById('emailVerificationModal').style.display = 'flex';
        document.getElementById('emailStep').style.display = 'block';
        document.getElementById('codeStep').style.display = 'none';
        document.getElementById('loadingStep').style.display = 'none';

        // Clear previous values
        document.getElementById('verificationEmail').value = '';
        document.getElementById('verificationCode').value = '';
        document.getElementById('emailError').textContent = '';
        document.getElementById('codeError').textContent = '';
    }

    function closeEmailModal() {
        document.getElementById('emailVerificationModal').style.display = 'none';
    }

    function sendVerificationCode() {
        const email = document.getElementById('verificationEmail').value.trim();
        const emailError = document.getElementById('emailError');

        // Validate email
        if (!email) {
            emailError.textContent = 'Email harus diisi';
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            emailError.textContent = 'Format email tidak valid';
            return;
        }

        // Show loading
        document.getElementById('emailStep').style.display = 'none';
        document.getElementById('loadingStep').style.display = 'block';

        // Send verification code
        fetch('{{ route("send-verification-anggota") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                email: email
            })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('loadingStep').style.display = 'none';

            if (data.success) {
                // Show code step
                document.getElementById('codeStep').style.display = 'block';
                document.getElementById('codeError').textContent = '';
            } else {
                // Show error and go back to email step
                document.getElementById('emailStep').style.display = 'block';
                emailError.textContent = data.message || 'Gagal mengirim kode verifikasi';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('loadingStep').style.display = 'none';
            document.getElementById('emailStep').style.display = 'block';
            emailError.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
        });
    }

    function backToEmailStep() {
        document.getElementById('codeStep').style.display = 'none';
        document.getElementById('emailStep').style.display = 'block';
    }

    function verifyCode() {
        const code = document.getElementById('verificationCode').value.trim();
        const codeError = document.getElementById('codeError');

        // Validate code
        if (!code) {
            codeError.textContent = 'Kode verifikasi harus diisi';
            return;
        }

        if (code.length !== 6) {
            codeError.textContent = 'Kode verifikasi harus 6 digit';
            return;
        }

        // Show loading
        document.getElementById('codeStep').style.display = 'none';
        document.getElementById('loadingStep').style.display = 'block';

        // Verify code
        fetch('{{ route("verify-email-anggota") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                verification_code: code
            })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('loadingStep').style.display = 'none';

            if (data.success) {
                // Set verified email and submit form
                document.getElementById('hiddenEmail').value = document.getElementById('verificationEmail').value;
                closeEmailModal();

                // Submit the form
                console.log('Email verified successfully, submitting form...');
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

                console.log('Form data before submit:', new FormData(document.getElementById('anggotaForm')));
                document.getElementById('anggotaForm').submit();
            } else {
                // Show error and go back to code step
                document.getElementById('codeStep').style.display = 'block';
                codeError.textContent = data.message || 'Kode verifikasi tidak valid';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('loadingStep').style.display = 'none';
            document.getElementById('codeStep').style.display = 'block';
            codeError.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
        });
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('emailVerificationModal');
        if (event.target === modal) {
            closeEmailModal();
        }
    }
    </script>
@endsection
