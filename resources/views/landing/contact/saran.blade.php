@extends('layouts.landing')

@section('title', 'Saran & Masukan - Gereja Toraja Eben-Haezer Selili')

@section('content')
    <!-- Form Header -->
    <div class="form-header">
        <div class="form-container">
            <h1 class="form-title">Saran & Masukan</h1>
            <p class="form-subtitle">
                Kami menghargai setiap masukan dari jemaat untuk kemajuan pelayanan gereja.
                Sampaikan saran, kritik, atau ide Anda untuk membantu kami melayani dengan lebih baik.
            </p>
        </div>
    </div>

    <!-- Form Content -->
    <div class="form-container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="form-section">
            <form action="{{ route('submit-saran') }}" method="POST" id="saranForm">
                @csrf
                <!-- Hidden input for verified email -->
                <input type="hidden" id="hiddenEmail" name="email" value="">

                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="nama" class="form-label"><i class="fas fa-user"></i> Nama</label>
                            <input type="text" id="nama" name="nama" class="form-input" placeholder="Masukkan nama lengkap" required>
                            <span class="error-message" id="error-nama">Nama harus minimal 5 karakter</span>
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label for="no_hp" class="form-label"><i class="fas fa-phone"></i> No HP</label>
                            <input type="text" id="no_hp" name="no_hp" class="form-input" placeholder="Masukkan nomor HP" required>
                            <span class="error-message" id="error-no_hp">Nomor HP harus minimal 5 karakter</span>
                            @error('no_hp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group has-counter">
                    <label for="saran" class="form-label"><i class="fas fa-comment-dots"></i> Saran / Masukan</label>
                    <textarea id="saran" name="saran" class="form-input form-textarea" placeholder="Tuliskan saran atau masukan Anda" maxlength="1000" required></textarea>
                    <div class="char-counter">
                        <span id="char-count">0</span>/1000
                    </div>
                    <span class="error-message" id="error-saran">Saran harus minimal 5 karakter</span>
                    @error('saran')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="button" class="btn btn-submit" id="submitBtn" onclick="showEmailVerificationModal()">
                    <i class="fas fa-paper-plane"></i> Kirim Saran
                </button>
            </form>
        </div>

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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('saranForm');
    const inputs = form.querySelectorAll('.form-input');
    const saranTextarea = document.getElementById('saran');
    const charCount = document.getElementById('char-count');

    // Character counter for textarea
    if (saranTextarea && charCount) {
        saranTextarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count;

            if (count > 800) {
                charCount.style.color = '#dc3545';
            } else if (count > 600) {
                charCount.style.color = '#ffc107';
            } else {
                charCount.style.color = '#666';
            }
        });
    }

    // Real-time validation
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            validateField(this);
        });

        input.addEventListener('blur', function() {
            validateField(this);
        });
    });

    function validateField(field) {
        const value = field.value.trim();
        const fieldName = field.name;
        const errorElement = document.getElementById(`error-${fieldName}`);

        let isValid = true;
        let errorMessage = '';

        switch(fieldName) {
            case 'nama':
                if (value.length < 5) {
                    isValid = false;
                    errorMessage = 'Nama harus minimal 5 karakter';
                }
                break;
            case 'no_hp':
                if (value.length < 5) {
                    isValid = false;
                    errorMessage = 'Nomor HP harus minimal 5 karakter';
                } else if (!/^[0-9+\-\s()]+$/.test(value)) {
                    isValid = false;
                    errorMessage = 'Nomor HP hanya boleh berisi angka dan karakter +, -, (), spasi';
                }
                break;
            case 'saran':
                if (value.length < 5) {
                    isValid = false;
                    errorMessage = 'Saran harus minimal 5 karakter';
                }
                break;
        }

        if (isValid) {
            field.style.borderColor = '#28a745';
            field.style.backgroundColor = '#f8fff9';
            if (errorElement) {
                errorElement.style.display = 'none';
            }
        } else {
            field.style.borderColor = '#dc3545';
            field.style.backgroundColor = '#fff8f8';
            if (errorElement) {
                errorElement.textContent = errorMessage;
                errorElement.style.display = 'block';
            }
        }

        return isValid;
    }
});

// Email Verification Functions
function showEmailVerificationModal() {
    // Check if form is valid first
    const form = document.getElementById('saranForm');
    const inputs = form.querySelectorAll('.form-input[required]');
    let isFormValid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            isFormValid = false;
            input.focus();
            return;
        }
    });

    if (!isFormValid) {
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
    fetch('{{ route("send-verification-saran") }}', {
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
            document.getElementById('codeStep').style.display = 'block';
        } else {
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
    fetch('{{ route("verify-email-saran") }}', {
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
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';

            document.getElementById('saranForm').submit();
        } else {
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

<style>
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
    background-color: var(--primary);
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
    background-color: var(--primary);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: var(--primary-dark);
    transform: translateY(-2px);
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
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
}

.loading-spinner i {
    font-size: 2rem;
    color: var(--primary);
}

.resend-info {
    margin-top: 15px;
    font-size: 0.9rem;
    color: #666;
}

.resend-link {
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
}

.resend-link:hover {
    text-decoration: underline;
}

@media (max-width: 768px) {
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
@endpush
