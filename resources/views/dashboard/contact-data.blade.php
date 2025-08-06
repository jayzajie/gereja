@extends('layouts.admin')

@section('title', 'Data Contact')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold py-3 mb-4" style="color: #8B4513;">
                <span class="text-muted fw-light">🏠 Dashboard /</span> 📞 Data Contact
            </h4>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-heart text-danger" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-medium d-block mb-1">💒 Pernikahan</span>
                    <h3 class="card-title mb-2">{{ $stats['total_marriages'] }}</h3>
                    <small class="text-warning fw-medium">
                        <i class="bx bx-time"></i> {{ $stats['pending_marriages'] }} Pending
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-water text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-medium d-block mb-1">💧 Baptisan</span>
                    <h3 class="card-title mb-2">{{ $stats['total_baptisms'] }}</h3>
                    <small class="text-warning fw-medium">
                        <i class="bx bx-time"></i> {{ $stats['pending_baptisms'] }} Pending
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-user-plus text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-medium d-block mb-1">👤 Anggota Baru</span>
                    <h3 class="card-title mb-2">{{ $stats['total_members'] }}</h3>
                    <small class="text-warning fw-medium">
                        <i class="bx bx-time"></i> {{ $stats['pending_members'] }} Pending
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-message-dots text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-medium d-block mb-1">💬 Saran</span>
                    <h3 class="card-title mb-2">{{ $stats['total_suggestions'] }}</h3>
                    <small class="text-muted">Total masukan</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs for different contact types -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Data Contact</h5>
                        <!-- Search Form -->
                        <div class="d-flex align-items-center">
                            <form method="GET" action="{{ route('dashboard.contact-data') }}" class="d-flex" id="search-form">
                                <input type="hidden" name="tab" value="{{ $tab ?? 'marriages' }}" id="current-tab">
                                <div class="input-group" style="width: 300px;">
                                    <input type="text"
                                           class="form-control"
                                           name="search"
                                           value="{{ $search ?? '' }}"
                                           placeholder="Cari nama, email, no HP..."
                                           style="border-radius: 0.375rem 0 0 0.375rem;"
                                           id="search-input">
                                    <button class="btn btn-outline-primary" type="submit" style="border-radius: 0 0.375rem 0.375rem 0;">
                                        <i class="bx bx-search"></i>
                                    </button>
                                </div>
                                @if($search)
                                    <a href="{{ route('dashboard.contact-data') }}?tab={{ $tab ?? 'marriages' }}" class="btn btn-outline-secondary ms-2" title="Hapus pencarian">
                                        <i class="bx bx-x"></i>
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>

                    @if($search && strlen(trim($search)) > 0)
                        <div class="alert alert-info mb-3">
                            <i class="bx bx-info-circle me-1"></i>
                            Menampilkan hasil pencarian untuk: <strong>"{{ $search }}"</strong>
                            <a href="{{ route('dashboard.contact-data') }}?tab={{ $tab ?? 'marriages' }}" class="alert-link ms-2">Hapus filter</a>
                        </div>
                    @endif

                    <ul class="nav nav-tabs" id="contactTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ ($tab ?? 'marriages') == 'marriages' ? 'active' : '' }}"
                                    id="marriages-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#marriages"
                                    type="button"
                                    role="tab"
                                    onclick="updateTabInput('marriages')">
                                <i class="bx bx-heart me-1"></i>Pernikahan ({{ $stats['total_marriages'] }})
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ ($tab ?? '') == 'baptisms' ? 'active' : '' }}"
                                    id="baptisms-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#baptisms"
                                    type="button"
                                    role="tab"
                                    onclick="updateTabInput('baptisms')">
                                <i class="bx bx-water me-1"></i>Baptisan ({{ $stats['total_baptisms'] }})
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ ($tab ?? '') == 'members' ? 'active' : '' }}"
                                    id="members-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#members"
                                    type="button"
                                    role="tab"
                                    onclick="updateTabInput('members')">
                                <i class="bx bx-user-plus me-1"></i>Anggota Baru ({{ $stats['total_members'] }})
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ ($tab ?? '') == 'suggestions' ? 'active' : '' }}"
                                    id="suggestions-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#suggestions"
                                    type="button"
                                    role="tab"
                                    onclick="updateTabInput('suggestions')">
                                <i class="bx bx-message-dots me-1"></i>Saran ({{ $stats['total_suggestions'] }})
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="contactTabsContent">
                        <!-- Marriages Tab -->
                        <div class="tab-pane fade {{ ($tab ?? 'marriages') == 'marriages' ? 'show active' : '' }}" id="marriages" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Pria</th>
                                            <th>Nama Wanita</th>
                                            <th>Email</th>
                                            <th>No. HP</th>
                                            <th>Tanggal Pernikahan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($marriages as $marriage)
                                            <tr>
                                                <td>{{ $marriage->nama_calon_pria }}</td>
                                                <td>{{ $marriage->nama_calon_wanita }}</td>
                                                <td>{{ $marriage->email_pria ?? $marriage->email_wanita ?? '-' }}</td>
                                                <td>{{ $marriage->no_telepon_pria ?? $marriage->no_telepon_wanita ?? '-' }}</td>
                                                <td>{{ $marriage->tanggal_pernikahan ? \Carbon\Carbon::parse($marriage->tanggal_pernikahan)->format('d/m/Y') : '-' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $marriage->status == 'approved' ? 'success' : ($marriage->status == 'pending' ? 'warning' : 'danger') }}">
                                                        {{ ucfirst($marriage->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        @if($marriage->status == 'pending')
                                                            <button class="btn btn-sm btn-success" onclick="updateStatus('marriage', {{ $marriage->id }}, 'approved')" title="Approve">
                                                                <i class="bx bx-check"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-danger" onclick="updateStatus('marriage', {{ $marriage->id }}, 'rejected')" title="Reject">
                                                                <i class="bx bx-x"></i>
                                                            </button>
                                                        @endif
                                                        <a href="{{ route('marriages.show', $marriage->id) }}" class="btn btn-sm btn-outline-primary" title="View">
                                                            <i class="bx bx-show"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">
                                                    @if($search)
                                                        Tidak ditemukan data pernikahan dengan kata kunci "{{ $search }}"
                                                    @else
                                                        Belum ada data pernikahan
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if($marriages->hasPages())
                                <div class="mt-3">
                                    {{ $marriages->links() }}
                                </div>
                            @endif
                        </div>

                        <!-- Baptisms Tab -->
                        <div class="tab-pane fade {{ ($tab ?? '') == 'baptisms' ? 'show active' : '' }}" id="baptisms" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Nomor Baptis</th>
                                            <th>No. HP</th>
                                            <th>Tanggal Baptis</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($baptisms as $baptism)
                                            <tr>
                                                <td>{{ $baptism->nama_jemaat }}</td>
                                                <td>{{ $baptism->nomor_baptis }}</td>
                                                <td>{{ '-' }}</td>
                                                <td>{{ $baptism->tanggal_baptis ? \Carbon\Carbon::parse($baptism->tanggal_baptis)->format('d/m/Y') : '-' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $baptism->status == 'approved' ? 'success' : ($baptism->status == 'pending' ? 'warning' : 'danger') }}">
                                                        {{ ucfirst($baptism->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        @if($baptism->status == 'pending')
                                                            <button class="btn btn-sm btn-success" onclick="updateStatus('baptism', {{ $baptism->id }}, 'approved')" title="Approve">
                                                                <i class="bx bx-check"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-danger" onclick="updateStatus('baptism', {{ $baptism->id }}, 'rejected')" title="Reject">
                                                                <i class="bx bx-x"></i>
                                                            </button>
                                                        @endif
                                                        <a href="{{ route('baptisms.show', $baptism->id) }}" class="btn btn-sm btn-outline-primary" title="View">
                                                            <i class="bx bx-show"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">
                                                    @if($search)
                                                        Tidak ditemukan data baptisan dengan kata kunci "{{ $search }}"
                                                    @else
                                                        Belum ada data baptisan
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if($baptisms->hasPages())
                                <div class="mt-3">
                                    {{ $baptisms->links() }}
                                </div>
                            @endif
                        </div>

                        <!-- Members Tab -->
                        <div class="tab-pane fade {{ ($tab ?? '') == 'members' ? 'show active' : '' }}" id="members" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tempat, Tanggal Lahir</th>
                                            <th>Email</th>
                                            <th>Pekerjaan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($members as $member)
                                            <tr>
                                                <td>
                                                    <div>
                                                        <strong>{{ $member->nama_lengkap }}</strong>
                                                        @if($member->alamat && str_contains($member->alamat, 'Data keluarga'))
                                                            <br><small class="text-muted">{{ str_replace('Data keluarga - ', '', $member->alamat) }}</small>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-{{ $member->jenis_kelamin == 'Laki-laki' ? 'primary' : 'info' }}">
                                                        {{ $member->jenis_kelamin == 'Laki-laki' ? 'L' : 'P' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <small>{{ $member->tempat_lahir }}</small><br>
                                                        <small class="text-muted">{{ \Carbon\Carbon::parse($member->tanggal_lahir)->format('d M Y') }}</small>
                                                    </div>
                                                </td>
                                                <td>{{ $member->email ?? '-' }}</td>
                                                <td>{{ $member->pekerjaan ?? '-' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $member->status == 'active' ? 'success' : 'secondary' }}">
                                                        {{ $member->status == 'active' ? 'Aktif' : 'Nonaktif' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-sm btn-info" onclick="viewMemberDetail({{ $member->id }})" title="Lihat Detail">
                                                            <i class="bx bx-show"></i>
                                                        </button>
                                                        @if($member->status == 'active')
                                                            <button class="btn btn-sm btn-warning" onclick="updateStatus('member', {{ $member->id }}, 'inactive')" title="Nonaktifkan">
                                                                <i class="bx bx-pause"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn btn-sm btn-success" onclick="updateStatus('member', {{ $member->id }}, 'active')" title="Aktifkan">
                                                                <i class="bx bx-play"></i>
                                                            </button>
                                                        @endif
                                                        <button class="btn btn-sm btn-danger" onclick="deleteMember({{ $member->id }})" title="Hapus">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">
                                                    @if($search)
                                                        Tidak ditemukan data anggota dengan kata kunci "{{ $search }}"
                                                    @else
                                                        Belum ada data anggota baru
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if($members->hasPages())
                                <div class="mt-3">
                                    {{ $members->links() }}
                                </div>
                            @endif
                        </div>

                        <!-- Suggestions Tab -->
                        <div class="tab-pane fade {{ ($tab ?? '') == 'suggestions' ? 'show active' : '' }}" id="suggestions" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No. HP</th>
                                            <th>Saran</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($suggestions as $suggestion)
                                            <tr>
                                                <td>{{ $suggestion->nama }}</td>
                                                <td>{{ $suggestion->nama_gmail }}</td>
                                                <td>{{ $suggestion->no_hp }}</td>
                                                <td>{{ Str::limit($suggestion->saran, 50) }}</td>
                                                <td>{{ $suggestion->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <a href="{{ route('suggestions.show', $suggestion->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bx bx-show"></i> 👁️
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">
                                                    @if($search)
                                                        Tidak ditemukan saran dengan kata kunci "{{ $search }}"
                                                    @else
                                                        Belum ada saran
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if($suggestions->hasPages())
                                <div class="mt-3">
                                    {{ $suggestions->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function updateTabInput(tab) {
    document.getElementById('current-tab').value = tab;
}

// Update status function
function updateStatus(type, id, status) {
    if (!confirm(`Apakah Anda yakin ingin mengubah status menjadi ${status}?`)) {
        return;
    }

    // Show loading state
    const button = event.target.closest('button');
    const originalContent = button.innerHTML;
    button.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i>';
    button.disabled = true;

    fetch('{{ route("dashboard.contact-data.update-status") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            type: type,
            id: id,
            status: status
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            showAlert('success', data.message);
            // Reload page to reflect changes
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showAlert('danger', data.message);
            // Restore button
            button.innerHTML = originalContent;
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('danger', 'Terjadi kesalahan saat mengupdate status');
        // Restore button
        button.innerHTML = originalContent;
        button.disabled = false;
    });
}

// Show alert function
function showAlert(type, message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    // Insert at top of container
    const container = document.querySelector('.container-xxl');
    container.insertBefore(alertDiv, container.firstChild);

    // Auto dismiss after 5 seconds
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}

// View member detail function
function viewMemberDetail(id) {
    // Create modal to show member details
    const modal = document.createElement('div');
    modal.className = 'modal fade';
    modal.innerHTML = `
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Anggota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p>Memuat data anggota...</p>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.body.appendChild(modal);
    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();

    // Load member details via AJAX
    fetch(`/dashboard/members/${id}`)
        .then(response => response.text())
        .then(html => {
            modal.querySelector('.modal-body').innerHTML = html;
        })
        .catch(error => {
            modal.querySelector('.modal-body').innerHTML = `
                <div class="alert alert-danger">
                    Gagal memuat data anggota. Silakan coba lagi.
                </div>
            `;
        });

    // Remove modal when hidden
    modal.addEventListener('hidden.bs.modal', () => {
        modal.remove();
    });
}

// Delete member function
function deleteMember(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus data anggota ini?')) {
        return;
    }

    fetch(`/dashboard/members/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('success', data.message);
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showAlert('danger', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('danger', 'Terjadi kesalahan saat menghapus data anggota');
    });
}

// Update search form when tab changes
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
    tabButtons.forEach(button => {
        button.addEventListener('shown.bs.tab', function(e) {
            const tabId = e.target.getAttribute('data-bs-target').replace('#', '');
            updateTabInput(tabId);
        });
    });
});
</script>
@endpush
