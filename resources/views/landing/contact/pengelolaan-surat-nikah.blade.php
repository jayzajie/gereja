@extends('layouts.landing')

@section('title', 'Pendaftaran Pernikahan - Gereja Toraja Eben-Haezer Selili')

@section('content')

    <!-- Form Header -->
    <div class="form-header">
        <div class="form-container">
            <h1 class="form-title">Form Pendaftaran Pernikahan</h1>
            <p class="form-subtitle">Silakan isi formulir di bawah ini untuk mendaftarkan pernikahan Anda</p>
        </div>
    </div>

    <!-- Form Content -->
    <div class="form-container multi-step-form">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Step Progress Bar -->
        <div class="step-progress">
            <div class="step active" id="step1">
                <div class="step-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="step-text">Data Pengantin Pria</div>
            </div>
            <div class="step" id="step2">
                <div class="step-icon">
                    <i class="fas fa-female"></i>
                </div>
                <div class="step-text">Data Pengantin Wanita</div>
            </div>
            <div class="step" id="step3">
                <div class="step-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="step-text">Data Pernikahan</div>
            </div>
            <div class="step" id="step4">
                <div class="step-icon">
                    <i class="fas fa-check"></i>
                </div>
                <div class="step-text">Konfirmasi</div>
            </div>
        </div>

        <form action="{{ route('submit-surat-nikah') }}" method="POST" id="marriageForm">
            @csrf
            <input type="hidden" name="email" id="hiddenEmail" value="">

            <!-- Data Calon Pria -->
            <div class="form-section" id="section1">
                <h2 class="form-section-title"><i class="fas fa-user"></i> Data Calon Pengantin Pria</h2>

                <div class="form-group">
                    <label for="nama_calon_pria" class="form-label"><i class="fas fa-id-card"></i> Nama Lengkap</label>
                    <input type="text" id="nama_calon_pria" name="nama_calon_pria" class="form-input" placeholder="Masukkan nama lengkap" required>
                    <span class="error-message" id="error-nama_calon_pria"></span>
                    @error('nama_calon_pria')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="tanggal_lahir_pria" class="form-label"><i class="fas fa-calendar"></i> Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir_pria" name="tanggal_lahir_pria" class="form-input" required>
                            @error('tanggal_lahir_pria')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="tempat_lahir_pria" class="form-label"><i class="fas fa-map-marker-alt"></i> Tempat Lahir</label>
                            <input type="text" id="tempat_lahir_pria" name="tempat_lahir_pria" class="form-input" placeholder="Kota tempat lahir" required>
                            @error('tempat_lahir_pria')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="pekerjaan_pria" class="form-label"><i class="fas fa-briefcase"></i> Pekerjaan</label>
                            <input type="text" id="pekerjaan_pria" name="pekerjaan_pria" class="form-input" placeholder="Pekerjaan saat ini" required>
                            @error('pekerjaan_pria')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="no_telepon_pria" class="form-label"><i class="fas fa-phone"></i> Nomor Telepon</label>
                            <input type="text" id="no_telepon_pria" name="no_telepon_pria" class="form-input" placeholder="08xxxxxxxxxx" required>
                            @error('no_telepon_pria')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="nama_ayah_pria" class="form-label"><i class="fas fa-male"></i> Nama Ayah</label>
                            <input type="text" id="nama_ayah_pria" name="nama_ayah_pria" class="form-input" placeholder="Nama lengkap ayah" required>
                            @error('nama_ayah_pria')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="nama_ibu_pria" class="form-label"><i class="fas fa-female"></i> Nama Ibu</label>
                            <input type="text" id="nama_ibu_pria" name="nama_ibu_pria" class="form-input" placeholder="Nama lengkap ibu" required>
                            @error('nama_ibu_pria')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat_pria" class="form-label"><i class="fas fa-home"></i> Alamat Lengkap</label>
                    <textarea id="alamat_pria" name="alamat_pria" class="form-input form-textarea" rows="3" placeholder="Alamat lengkap sesuai KTP" required></textarea>
                    @error('alamat_pria')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <div></div> <!-- Empty div for spacing -->
                    <button type="button" class="btn btn-next" id="next1">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <!-- Data Calon Wanita -->
            <div class="form-section" id="section2">
                <h2 class="form-section-title"><i class="fas fa-female"></i> Data Calon Pengantin Wanita</h2>

                <div class="form-group">
                    <label for="nama_calon_wanita" class="form-label"><i class="fas fa-id-card"></i> Nama Lengkap</label>
                    <input type="text" id="nama_calon_wanita" name="nama_calon_wanita" class="form-input" placeholder="Masukkan nama lengkap" required>
                    @error('nama_calon_wanita')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="tanggal_lahir_wanita" class="form-label"><i class="fas fa-calendar"></i> Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir_wanita" name="tanggal_lahir_wanita" class="form-input" required>
                            @error('tanggal_lahir_wanita')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="tempat_lahir_wanita" class="form-label"><i class="fas fa-map-marker-alt"></i> Tempat Lahir</label>
                            <input type="text" id="tempat_lahir_wanita" name="tempat_lahir_wanita" class="form-input" placeholder="Kota tempat lahir" required>
                            @error('tempat_lahir_wanita')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="pekerjaan_wanita" class="form-label"><i class="fas fa-briefcase"></i> Pekerjaan</label>
                            <input type="text" id="pekerjaan_wanita" name="pekerjaan_wanita" class="form-input" placeholder="Pekerjaan saat ini" required>
                            @error('pekerjaan_wanita')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="no_telepon_wanita" class="form-label"><i class="fas fa-phone"></i> Nomor Telepon</label>
                            <input type="text" id="no_telepon_wanita" name="no_telepon_wanita" class="form-input" placeholder="08xxxxxxxxxx" required>
                            @error('no_telepon_wanita')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email_wanita" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" id="email_wanita" name="email_wanita" class="form-input" placeholder="email@example.com" required>
                    @error('email_wanita')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="nama_ayah_wanita" class="form-label"><i class="fas fa-male"></i> Nama Ayah</label>
                            <input type="text" id="nama_ayah_wanita" name="nama_ayah_wanita" class="form-input" placeholder="Nama lengkap ayah" required>
                            @error('nama_ayah_wanita')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="nama_ibu_wanita" class="form-label"><i class="fas fa-female"></i> Nama Ibu</label>
                            <input type="text" id="nama_ibu_wanita" name="nama_ibu_wanita" class="form-input" placeholder="Nama lengkap ibu" required>
                            @error('nama_ibu_wanita')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat_wanita" class="form-label"><i class="fas fa-home"></i> Alamat Lengkap</label>
                    <textarea id="alamat_wanita" name="alamat_wanita" class="form-input form-textarea" rows="3" placeholder="Alamat lengkap sesuai KTP" required></textarea>
                    @error('alamat_wanita')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-prev" id="prev2"><i class="fas fa-arrow-left"></i> Sebelumnya</button>
                    <button type="button" class="btn btn-next" id="next2">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <!-- Data Pernikahan -->
            <div class="form-section" id="section3">
                <h2 class="form-section-title"><i class="fas fa-heart"></i> Data Pernikahan</h2>

                <div class="form-group">
                    <label for="tanggal_pernikahan" class="form-label"><i class="fas fa-calendar-alt"></i> Tanggal Pernikahan</label>
                    <input type="date" id="tanggal_pernikahan" name="tanggal_pernikahan" class="form-input" required>
                    @error('tanggal_pernikahan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tempat_pernikahan" class="form-label"><i class="fas fa-church"></i> Tempat Pernikahan</label>
                    <input type="text" id="tempat_pernikahan" name="tempat_pernikahan" class="form-input" placeholder="Nama gereja atau tempat pernikahan" required>
                    @error('tempat_pernikahan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="saksi1" class="form-label"><i class="fas fa-user-friends"></i> Saksi 1</label>
                            <input type="text" id="saksi1" name="saksi1" class="form-input" placeholder="Nama lengkap saksi 1" required>
                            @error('saksi1')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="saksi2" class="form-label"><i class="fas fa-user-friends"></i> Saksi 2</label>
                            <input type="text" id="saksi2" name="saksi2" class="form-input" placeholder="Nama lengkap saksi 2" required>
                            @error('saksi2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-prev" id="prev3"><i class="fas fa-arrow-left"></i> Sebelumnya</button>
                    <button type="button" class="btn btn-next" id="next3">Selanjutnya <i class="fas fa-arrow-right"></i></button>
                </div>
            </div>

            <!-- Konfirmasi -->
            <div class="form-section" id="section4">
                <h2 class="form-section-title"><i class="fas fa-check"></i> Konfirmasi Data</h2>

                <p>Silakan periksa kembali data yang telah Anda masukkan sebelum mengirimkan formulir.</p>

                <div id="summary" class="form-summary">
                    <!-- Data summary will be populated by JavaScript -->
                </div>

                <div class="form-group">
                    <label class="form-checkbox">
                        <input type="checkbox" id="confirm" required>
                        Saya menyatakan bahwa data yang saya masukkan adalah benar dan dapat dipertanggungjawabkan
                    </label>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-prev" id="prev4"><i class="fas fa-arrow-left"></i> Sebelumnya</button>
                    <button type="button" class="btn btn-submit" onclick="showEmailVerificationModal()">Simpan Data</button>
                </div>
            </div>
        </form>

    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 4;

    // Initialize form
    showStep(currentStep);

    // Next button handlers
    document.getElementById('next1').addEventListener('click', function() {
        if (validateStep(1)) {
            nextStep();
        }
    });

    document.getElementById('next2').addEventListener('click', function() {
        if (validateStep(2)) {
            nextStep();
        }
    });

    document.getElementById('next3').addEventListener('click', function() {
        if (validateStep(3)) {
            nextStep();
        }
    });

    // Previous button handlers
    document.getElementById('prev2').addEventListener('click', function() {
        prevStep();
    });

    document.getElementById('prev3').addEventListener('click', function() {
        prevStep();
    });

    document.getElementById('prev4').addEventListener('click', function() {
        prevStep();
    });

    function showStep(step) {
        // Hide all sections
        for (let i = 1; i <= totalSteps; i++) {
            const section = document.getElementById(`section${i}`);
            const stepElement = document.getElementById(`step${i}`);

            if (i === step) {
                section.classList.add('active');
                stepElement.classList.add('active');
                if (i > 1) {
                    stepElement.classList.add('completed');
                }
            } else {
                section.classList.remove('active');
                stepElement.classList.remove('active');
                if (i < step) {
                    stepElement.classList.add('completed');
                } else {
                    stepElement.classList.remove('completed');
                }
            }
        }

        // Update progress bar
        const progressBar = document.querySelector('.step-progress');
        progressBar.className = `step-progress step-${step}`;

        // Update summary if on step 4
        if (step === 4) {
            updateSummary();
        }
    }

    function nextStep() {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);

            // Smooth scroll to top
            document.querySelector('.form-header').scrollIntoView({
                behavior: 'smooth'
            });
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);

            // Smooth scroll to top
            document.querySelector('.form-header').scrollIntoView({
                behavior: 'smooth'
            });
        }
    }

    function validateStep(step) {
        const section = document.getElementById(`section${step}`);
        const requiredFields = section.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.style.borderColor = '#dc3545';
                field.style.backgroundColor = '#fff8f8';
                isValid = false;

                // Show error message
                const errorMsg = field.parentNode.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.style.display = 'block';
                    errorMsg.textContent = 'Field ini wajib diisi';
                }
            } else {
                field.style.borderColor = '#28a745';
                field.style.backgroundColor = '#f8fff9';

                // Hide error message
                const errorMsg = field.parentNode.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.style.display = 'none';
                }
            }
        });

        if (!isValid) {
            // Focus on first invalid field
            const firstInvalid = section.querySelector('[style*="border-color: rgb(220, 53, 69)"]');
            if (firstInvalid) {
                firstInvalid.focus();
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

        return isValid;
    }

    function updateSummary() {
        const summary = document.getElementById('summary');

        const priaData = {
            'Nama Lengkap': document.getElementById('nama_calon_pria').value,
            'Tanggal Lahir': document.getElementById('tanggal_lahir_pria').value,
            'Tempat Lahir': document.getElementById('tempat_lahir_pria').value,
            'Pekerjaan': document.getElementById('pekerjaan_pria').value,
            'No. Telepon': document.getElementById('no_telepon_pria').value,
            'Nama Ayah': document.getElementById('nama_ayah_pria').value,
            'Nama Ibu': document.getElementById('nama_ibu_pria').value,
            'Alamat': document.getElementById('alamat_pria').value
        };

        const wanitaData = {
            'Nama Lengkap': document.getElementById('nama_calon_wanita').value,
            'Tanggal Lahir': document.getElementById('tanggal_lahir_wanita').value,
            'Tempat Lahir': document.getElementById('tempat_lahir_wanita').value,
            'Pekerjaan': document.getElementById('pekerjaan_wanita').value,
            'No. Telepon': document.getElementById('no_telepon_wanita').value,
            'Email': document.getElementById('email_wanita').value,
            'Nama Ayah': document.getElementById('nama_ayah_wanita').value,
            'Nama Ibu': document.getElementById('nama_ibu_wanita').value,
            'Alamat': document.getElementById('alamat_wanita').value
        };

        const pernikahanData = {
            'Tanggal Pernikahan': document.getElementById('tanggal_pernikahan').value,
            'Tempat Pernikahan': document.getElementById('tempat_pernikahan').value,
            'Saksi 1': document.getElementById('saksi1').value,
            'Saksi 2': document.getElementById('saksi2').value
        };

        let summaryHTML = '';

        // Data Pria
        summaryHTML += '<div class="summary-section">';
        summaryHTML += '<div class="summary-title"><i class="fas fa-user"></i> Data Calon Pengantin Pria</div>';
        for (const [key, value] of Object.entries(priaData)) {
            summaryHTML += `<div class="summary-item">
                <span class="summary-label">${key}:</span>
                <span class="summary-value">${value}</span>
            </div>`;
        }
        summaryHTML += '</div>';

        // Data Wanita
        summaryHTML += '<div class="summary-section">';
        summaryHTML += '<div class="summary-title"><i class="fas fa-female"></i> Data Calon Pengantin Wanita</div>';
        for (const [key, value] of Object.entries(wanitaData)) {
            summaryHTML += `<div class="summary-item">
                <span class="summary-label">${key}:</span>
                <span class="summary-value">${value}</span>
            </div>`;
        }
        summaryHTML += '</div>';

        // Data Pernikahan
        summaryHTML += '<div class="summary-section">';
        summaryHTML += '<div class="summary-title"><i class="fas fa-heart"></i> Data Pernikahan</div>';
        for (const [key, value] of Object.entries(pernikahanData)) {
            summaryHTML += `<div class="summary-item">
                <span class="summary-label">${key}:</span>
                <span class="summary-value">${value}</span>
            </div>`;
        }
        summaryHTML += '</div>';

        summary.innerHTML = summaryHTML;

        // Set email for hidden field
        document.getElementById('hiddenEmail').value = document.getElementById('email_wanita').value;
    }

    // Real-time validation for all inputs
    const allInputs = document.querySelectorAll('.form-input');
    allInputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.style.borderColor = '#28a745';
                this.style.backgroundColor = '#f8fff9';
            } else {
                this.style.borderColor = '#e8ecf0';
                this.style.backgroundColor = '#fafbfc';
            }
        });

        input.addEventListener('blur', function() {
            if (this.hasAttribute('required') && !this.value.trim()) {
                this.style.borderColor = '#dc3545';
                this.style.backgroundColor = '#fff8f8';
            }
        });
    });
});

// Email verification modal function (if needed)
function showEmailVerificationModal() {
    const form = document.getElementById('marriageForm');
    const confirmCheckbox = document.getElementById('confirm');

    if (!confirmCheckbox.checked) {
        alert('Silakan centang kotak konfirmasi terlebih dahulu');
        confirmCheckbox.focus();
        return;
    }

    if (validateStep(4)) {
        const submitBtn = document.querySelector('.btn-submit');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

        // Submit form
        form.submit();
    }
}
</script>
@endpush
