@extends('layouts.landing')

@section('title', 'Pendaftaran Baptis - Gereja Toraja Eben-Haezer Selili')

@section('content')

    <!-- Form Header -->
    <div class="form-header">
        <div class="form-container">
            <h1 class="form-title">Form Pendaftaran Baptis</h1>
            <p class="form-subtitle">Silakan isi formulir di bawah ini untuk mendaftarkan baptis</p>
        </div>
    </div>

    <!-- Form Content -->
    <div class="form-container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('submit-baptis') }}" method="POST" id="baptismForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="email" id="hiddenEmail" value="">

            <!-- Progress Bar -->
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-step active" data-step="1">
                        <div class="step-number">1</div>
                        <div class="step-label">Keterangan Anak</div>
                    </div>
                    <div class="progress-step" data-step="2">
                        <div class="step-number">2</div>
                        <div class="step-label">Data Ayah</div>
                    </div>
                    <div class="progress-step" data-step="3">
                        <div class="step-number">3</div>
                        <div class="step-label">Data Ibu</div>
                    </div>
                    <div class="progress-step" data-step="4">
                        <div class="step-number">4</div>
                        <div class="step-label">Lampiran</div>
                    </div>
                </div>
            </div>

            <!-- Step 1: I. KETERANGAN ANAK -->
            <div class="form-step active" id="step-1">
                <div class="form-section">
                <h2 class="form-section-title"><i class="fas fa-baby"></i> I. KETERANGAN ANAK</h2>

                <div class="form-group">
                    <label for="nomor_baptis" class="form-label">Nomor Baptis</label>
                    <input type="text" id="nomor_baptis" name="nomor_baptis" class="form-input" placeholder="Nomor akan dibuat otomatis" readonly style="background-color: #f8f9fa; cursor: not-allowed;">
                    <small class="form-text text-muted">
                        <i class="fas fa-info-circle"></i> Nomor baptis akan dibuat secara otomatis oleh sistem
                    </small>
                    @error('nomor_baptis')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama_jemaat" class="form-label">1. Nama (Sesuai Akta Kelahiran)</label>
                    <input type="text" id="nama_jemaat" name="nama_jemaat" class="form-input" placeholder="Masukkan nama lengkap sesuai akta kelahiran" required>
                    <span class="validation-error" id="error-nama_jemaat" style="color: red; display: none;">Field ini wajib diisi</span>
                    @error('nama_jemaat')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label for="tempat_lahir" class="form-label">2. Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-input" placeholder="Masukkan tempat lahir" required>
                        <span class="validation-error" id="error-tempat_lahir" style="color: red; display: none;">Field ini wajib diisi</span>
                        @error('tempat_lahir')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-col">
                        <label for="tanggal_lahir" class="form-label">3. Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-input" required>
                        <span class="validation-error" id="error-tanggal_lahir" style="color: red; display: none;">Field ini wajib diisi</span>
                        @error('tanggal_lahir')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label for="jenis_kelamin" class="form-label">4. Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-input" required>
                            <option value="">Pilih jenis kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <span class="validation-error" id="error-jenis_kelamin" style="color: red; display: none;">Field ini wajib diisi</span>
                        @error('jenis_kelamin')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-col">
                        <label for="tanggal_baptis" class="form-label">Tanggal Baptis</label>
                        <input type="date" id="tanggal_baptis" name="tanggal_baptis" class="form-input" required>
                        <span class="validation-error" id="error-tanggal_baptis" style="color: red; display: none;">Field ini wajib diisi</span>
                        @error('tanggal_baptis')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat_anak" class="form-label">5. Alamat</label>
                    <textarea id="alamat_anak" name="alamat_anak" class="form-input" rows="3" placeholder="Masukkan alamat lengkap" required></textarea>
                    <span class="validation-error" id="error-alamat_anak" style="color: red; display: none;">Field ini wajib diisi</span>
                    @error('alamat_anak')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Navigation Buttons -->
                <div class="step-navigation">
                    <button type="button" class="btn btn-next" onclick="nextStep(1)">
                        Selanjutnya <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                </div>
            </div>

            <!-- Step 2: II. KETERANGAN ORANG TUA (AYAH) -->
            <div class="form-step" id="step-2">
                <div class="form-section">
                <h2 class="form-section-title"><i class="fas fa-male"></i> II. KETERANGAN ORANG TUA (AYAH)</h2>

                <div class="form-group">
                    <label for="nama_ayah" class="form-label">1. Nama</label>
                    <input type="text" id="nama_ayah" name="nama_ayah" class="form-input" placeholder="Masukkan nama lengkap ayah" required>
                    <span class="validation-error" id="error-nama_ayah" style="color: red; display: none;">Field ini wajib diisi</span>
                    @error('nama_ayah')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label for="umur_ayah" class="form-label">2. Umur</label>
                        <input type="number" id="umur_ayah" name="umur_ayah" class="form-input" placeholder="Umur ayah" required>
                        <span class="validation-error" id="error-umur_ayah" style="color: red; display: none;">Field ini wajib diisi</span>
                        @error('umur_ayah')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-col">
                        <label for="gereja_ayah" class="form-label">3. Gereja/Agama</label>
                        <input type="text" id="gereja_ayah" name="gereja_ayah" class="form-input" placeholder="Gereja/Agama ayah" required>
                        <span class="validation-error" id="error-gereja_ayah" style="color: red; display: none;">Field ini wajib diisi</span>
                        @error('gereja_ayah')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label for="pekerjaan_ayah" class="form-label">4. Pekerjaan</label>
                        <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" class="form-input" placeholder="Pekerjaan ayah" required>
                        <span class="validation-error" id="error-pekerjaan_ayah" style="color: red; display: none;">Field ini wajib diisi</span>
                        @error('pekerjaan_ayah')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-col">
                        <label for="dibaptis_oleh" class="form-label">Di Baptis Oleh</label>
                        <input type="text" id="dibaptis_oleh" name="dibaptis_oleh" class="form-input" placeholder="Nama pendeta pembaptis" required>
                        <span class="validation-error" id="error-dibaptis_oleh" style="color: red; display: none;">Field ini wajib diisi</span>
                        @error('dibaptis_oleh')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat_ayah" class="form-label">5. Alamat</label>
                    <textarea id="alamat_ayah" name="alamat_ayah" class="form-input" rows="3" placeholder="Masukkan alamat lengkap ayah" required></textarea>
                    <span class="validation-error" id="error-alamat_ayah" style="color: red; display: none;">Field ini wajib diisi</span>
                    @error('alamat_ayah')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Navigation Buttons -->
                <div class="step-navigation">
                    <button type="button" class="btn btn-prev" onclick="prevStep(2)">
                        <i class="fas fa-arrow-left"></i> Sebelumnya
                    </button>
                    <button type="button" class="btn btn-next" onclick="nextStep(2)">
                        Selanjutnya <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                </div>
            </div>

            <!-- Step 3: III. KETERANGAN ORANG TUA (IBU) -->
            <div class="form-step" id="step-3">
                <div class="form-section">
                <h2 class="form-section-title"><i class="fas fa-female"></i> III. KETERANGAN ORANG TUA (IBU)</h2>

                <div class="form-group">
                    <label for="nama_ibu" class="form-label">1. Nama</label>
                    <input type="text" id="nama_ibu" name="nama_ibu" class="form-input" placeholder="Masukkan nama lengkap ibu" required>
                    <span class="validation-error" id="error-nama_ibu" style="color: red; display: none;">Field ini wajib diisi</span>
                    @error('nama_ibu')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label for="umur_ibu" class="form-label">2. Umur</label>
                        <input type="number" id="umur_ibu" name="umur_ibu" class="form-input" placeholder="Umur ibu" required>
                        <span class="validation-error" id="error-umur_ibu" style="color: red; display: none;">Field ini wajib diisi</span>
                        @error('umur_ibu')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-col">
                        <label for="gereja_ibu" class="form-label">3. Gereja/Agama</label>
                        <input type="text" id="gereja_ibu" name="gereja_ibu" class="form-input" placeholder="Gereja/Agama ibu" required>
                        <span class="validation-error" id="error-gereja_ibu" style="color: red; display: none;">Field ini wajib diisi</span>
                        @error('gereja_ibu')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="pekerjaan_ibu" class="form-label">4. Pekerjaan</label>
                    <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" class="form-input" placeholder="Pekerjaan ibu" required>
                    <span class="validation-error" id="error-pekerjaan_ibu" style="color: red; display: none;">Field ini wajib diisi</span>
                    @error('pekerjaan_ibu')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat_ibu" class="form-label">5. Alamat</label>
                    <textarea id="alamat_ibu" name="alamat_ibu" class="form-input" rows="3" placeholder="Masukkan alamat lengkap ibu" required></textarea>
                    <span class="validation-error" id="error-alamat_ibu" style="color: red; display: none;">Field ini wajib diisi</span>
                    @error('alamat_ibu')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Navigation Buttons -->
                <div class="step-navigation">
                    <button type="button" class="btn btn-prev" onclick="prevStep(3)">
                        <i class="fas fa-arrow-left"></i> Sebelumnya
                    </button>
                    <button type="button" class="btn btn-next" onclick="nextStep(3)">
                        Selanjutnya <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                </div>
            </div>

            <!-- Step 4: IV. LAMPIRAN -->
            <div class="form-step" id="step-4">
                <div class="form-section">
                <h2 class="form-section-title"><i class="fas fa-paperclip"></i> IV. LAMPIRAN (DILENGKAPI SEBELUM BAPTIS)</h2>

                <div class="lampiran-info">
                    <p><strong>Dokumen yang diperlukan:</strong></p>
                    <ul>
                        <li>1. Foto Copy Surat Nikah 1 lembar</li>
                        <li>2. Surat keterangan lahir</li>
                        <li>3. Foto Copy Akta Kelahiran (kalau ada) 1 lembar</li>
                        <li>4. Sertakan Nomor telepon/HP yang bisa dihubungi</li>
                    </ul>
                </div>

                <div class="form-group">
                    <label for="foto" class="form-label">Upload Dokumen Pendukung (Opsional)</label>
                    <div class="file-input-container">
                        <label for="foto" class="file-input-label" id="foto-label">
                            <i class="fas fa-upload"></i> Pilih File
                        </label>
                        <input type="file" id="foto" name="foto" class="file-input" accept="image/*,application/pdf">
                        <div id="file-name" class="file-name">Belum ada file yang dipilih</div>
                    </div>
                    <small class="form-text text-muted">
                        <i class="fas fa-info-circle"></i> Format yang diterima: JPG, PNG, PDF (Max: 2MB)
                    </small>
                    <span class="validation-error" id="error-foto" style="color: red; display: none;">Field ini wajib diisi</span>
                    @error('foto')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_telepon" class="form-label">Nomor Telepon/HP yang bisa dihubungi</label>
                    <input type="tel" id="no_telepon" name="no_telepon" class="form-input" placeholder="Contoh: 08123456789" required>
                    <span class="validation-error" id="error-no_telepon" style="color: red; display: none;">Field ini wajib diisi</span>
                    @error('no_telepon')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Navigation Buttons -->
                <div class="step-navigation">
                    <button type="button" class="btn btn-prev" onclick="prevStep(4)">
                        <i class="fas fa-arrow-left"></i> Sebelumnya
                    </button>
                    <button type="button" class="btn btn-submit" id="submitBtn" disabled onclick="showEmailVerificationModal()">
                        <i class="fas fa-paper-plane"></i> Daftar
                    </button>
                </div>
                </div>
            </div>
        </form>

    </div>

    <style>
    /* Progress Bar Styles */
    .progress-container {
        margin-bottom: 40px;
        padding: 20px 0;
    }

    .progress-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        max-width: 800px;
        margin: 0 auto;
    }

    .progress-bar::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #dee2e6;
        z-index: 1;
        transform: translateY(-50%);
    }

    .progress-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
        background-color: white;
        padding: 0 15px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #dee2e6;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }

    .step-label {
        font-size: 12px;
        color: #6c757d;
        text-align: center;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .progress-step.active .step-number {
        background-color: #8B4513;
        color: white;
    }

    .progress-step.active .step-label {
        color: #8B4513;
        font-weight: 600;
    }

    .progress-step.completed .step-number {
        background-color: #28a745;
        color: white;
    }

    .progress-step.completed .step-label {
        color: #28a745;
    }

    /* Form Step Styles */
    .form-step {
        display: none;
        animation: fadeIn 0.3s ease-in-out;
    }

    .form-step.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* Step Navigation Styles */
    .step-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #dee2e6;
    }

    .btn-prev, .btn-next {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-prev {
        background-color: #6c757d;
        color: white;
    }

    .btn-prev:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
    }

    .btn-next {
        background-color: #8B4513;
        color: white;
    }

    .btn-next:hover {
        background-color: #7a3e11;
        transform: translateY(-2px);
    }

    .btn-submit {
        background-color: #28a745;
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-submit:hover:not(:disabled) {
        background-color: #218838;
        transform: translateY(-2px);
    }

    .btn-submit:disabled {
        background-color: #6c757d;
        cursor: not-allowed;
        transform: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .progress-bar {
            flex-wrap: wrap;
            gap: 10px;
        }

        .step-label {
            font-size: 10px;
        }

        .step-number {
            width: 35px;
            height: 35px;
        }

        .step-navigation {
            flex-direction: column;
            gap: 15px;
        }

        .btn-prev, .btn-next, .btn-submit {
            width: 100%;
            justify-content: center;
        }
    }

    /* Existing Styles */
    .lampiran-info {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .lampiran-info p {
        margin-bottom: 10px;
        font-weight: 600;
        color: #495057;
    }

    .lampiran-info ul {
        margin: 0;
        padding-left: 20px;
    }

    .lampiran-info li {
        margin-bottom: 8px;
        color: #6c757d;
        line-height: 1.5;
    }

    .form-section-title {
        color: #8B4513;
        border-bottom: 2px solid #8B4513;
        padding-bottom: 10px;
        margin-bottom: 25px;
    }

    .form-section {
        margin-bottom: 40px;
    }
    </style>

    <script>
    let currentStep = 1;
    const totalSteps = 4;

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize form
        showStep(1);
        updateProgressBar();

        // Override form validation to exclude nomor_baptis
        const form = document.getElementById('baptismForm');
        const submitBtn = document.getElementById('submitBtn');

        // Function to check if current step fields are valid
        function checkCurrentStepValidity() {
            const currentStepElement = document.getElementById(`step-${currentStep}`);
            const requiredFields = currentStepElement.querySelectorAll('[required]');
            let allValid = true;

            requiredFields.forEach(field => {
                // Skip nomor_baptis validation since it's auto-generated
                if (field.id === 'nomor_baptis') {
                    return;
                }

                if (!field.value.trim()) {
                    allValid = false;
                }
            });

            return allValid;
        }

        // Function to check if all form fields are valid
        function checkFormValidity() {
            const requiredFields = form.querySelectorAll('[required]');
            let allValid = true;

            requiredFields.forEach(field => {
                // Skip nomor_baptis validation since it's auto-generated
                if (field.id === 'nomor_baptis') {
                    return;
                }

                if (!field.value.trim()) {
                    allValid = false;
                }
            });

            // Enable/disable submit button based on validation
            if (currentStep === totalSteps) {
                submitBtn.disabled = !allValid;
            }
        }

        // Add event listeners to all form inputs
        const allInputs = form.querySelectorAll('input, select, textarea');
        allInputs.forEach(input => {
            input.addEventListener('input', checkFormValidity);
            input.addEventListener('change', checkFormValidity);
        });

        // File input handler
        const fileInput = document.getElementById('foto');
        const fileName = document.getElementById('file-name');

        if (fileInput && fileName) {
            fileInput.addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    fileName.textContent = e.target.files[0].name;
                } else {
                    fileName.textContent = 'Belum ada file yang dipilih';
                }
                checkFormValidity();
            });
        }

        // Initial check
        checkFormValidity();

        // Override form submission to remove nomor_baptis from validation
        form.addEventListener('submit', function(e) {
            // Remove required attribute from nomor_baptis before submission
            const nomorBaptisField = document.getElementById('nomor_baptis');
            if (nomorBaptisField) {
                nomorBaptisField.removeAttribute('required');
            }
        });
    });

    // Step Navigation Functions
    function showStep(step) {
        // Hide all steps
        for (let i = 1; i <= totalSteps; i++) {
            const stepElement = document.getElementById(`step-${i}`);
            if (stepElement) {
                stepElement.classList.remove('active');
            }
        }

        // Show current step
        const currentStepElement = document.getElementById(`step-${step}`);
        if (currentStepElement) {
            currentStepElement.classList.add('active');
        }

        currentStep = step;
        updateProgressBar();
    }

    function nextStep(step) {
        // Validate current step before proceeding
        const currentStepElement = document.getElementById(`step-${step}`);
        const requiredFields = currentStepElement.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (field.id === 'nomor_baptis') return; // Skip auto-generated field

            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = '#dc3545';

                // Show error message
                const errorElement = field.parentNode.querySelector('.validation-error');
                if (errorElement) {
                    errorElement.style.display = 'block';
                }
            } else {
                field.style.borderColor = '';

                // Hide error message
                const errorElement = field.parentNode.querySelector('.validation-error');
                if (errorElement) {
                    errorElement.style.display = 'none';
                }
            }
        });

        if (isValid && step < totalSteps) {
            showStep(step + 1);
        } else if (!isValid) {
            // Scroll to first invalid field
            const firstInvalidField = currentStepElement.querySelector('[required]:invalid, [required][value=""]');
            if (firstInvalidField) {
                firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalidField.focus();
            }
        }
    }

    function prevStep(step) {
        if (step > 1) {
            showStep(step - 1);
        }
    }

    function updateProgressBar() {
        // Update progress steps
        for (let i = 1; i <= totalSteps; i++) {
            const progressStep = document.querySelector(`[data-step="${i}"]`);
            if (progressStep) {
                progressStep.classList.remove('active', 'completed');

                if (i < currentStep) {
                    progressStep.classList.add('completed');
                } else if (i === currentStep) {
                    progressStep.classList.add('active');
                }
            }
        }
    }

    // Allow clicking on progress steps to navigate (only to completed or current step)
    document.addEventListener('DOMContentLoaded', function() {
        const progressSteps = document.querySelectorAll('.progress-step');
        progressSteps.forEach(step => {
            step.addEventListener('click', function() {
                const stepNumber = parseInt(this.getAttribute('data-step'));
                if (stepNumber <= currentStep || this.classList.contains('completed')) {
                    showStep(stepNumber);
                }
            });
        });
    });
    </script>
@endsection
