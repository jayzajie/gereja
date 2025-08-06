@extends('layouts.admin')

@section('title', 'Program Kerja')

@push('styles')
<style>
    .program-kerja-container {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        margin: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .table-header-section {
        background: #f8f9fa;
        padding: 15px 25px;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header-section h5 {
        margin: 0;
        font-weight: 600;
        color: #495057;
        font-size: 16px;
    }

    .header-actions {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .btn-create {
        background: #007bff;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s ease;
    }

    .btn-create:hover {
        background: #0056b3;
        color: white;
        text-decoration: none;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-input {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        width: 200px;
        background: white;
        transition: border-color 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #007bff;
    }

    .program-table-wrapper {
        background: white;
        overflow-x: auto;
        position: relative;
    }

    .program-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin: 0;
        font-size: 14px;
        background: white;
    }

    .program-table thead th {
        background: #f8f9fa;
        padding: 15px 20px;
        text-align: center;
        font-weight: 600;
        color: #495057;
        border: 1px solid #dee2e6;
        font-size: 14px;
    }

    .program-table thead th:last-child::after {
        content: "⚙";
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
        color: #6c757d;
    }

    .program-table tbody td {
        padding: 15px;
        border: 1px solid #dee2e6;
        vertical-align: middle;
        background: white;
    }

    .program-table tbody tr:nth-child(even) td {
        background: #f8f9fa;
    }

    .program-table tbody tr:hover td {
        background: #e3f2fd;
    }

    .komisi-cell {
        font-weight: 600;
        color: #495057;
        width: 120px;
        text-align: center;
        vertical-align: middle;
    }

    .program-cell {
        color: #495057;
        line-height: 1.5;
        font-weight: 400;
    }

    .action-cell {
        width: 280px;
        text-align: center;
        vertical-align: middle;
    }

    .btn-action-group {
        display: flex;
        gap: 8px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 8px;
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid;
        background: white;
        cursor: pointer;
        transition: all 0.2s ease;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .btn-action i {
        font-size: 16px;
    }

    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .btn-create {
        border-color: #007bff;
        color: #007bff;
    }

    .btn-create:hover {
        background: #007bff;
        color: white;
    }

    .btn-view {
        border-color: #6c757d;
        color: #6c757d;
    }

    .btn-view:hover {
        background: #6c757d;
        color: white;
    }

    .btn-edit {
        border-color: #ffc107;
        color: #ffc107;
    }

    .btn-edit:hover {
        background: #ffc107;
        color: white;
    }

    .btn-delete {
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
    }

    /* Tooltip untuk button */
    .btn-action::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0,0,0,0.8);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s ease;
        z-index: 1000;
    }

    .btn-action:hover::after {
        opacity: 1;
    }

    .pagination-section {
        background: #f8f9fa;
        padding: 15px 20px;
        border-top: 1px solid #dee2e6;
        text-align: center;
    }

    .pagination-nav {
        display: inline-flex;
        gap: 5px;
        align-items: center;
    }

    .page-btn {
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        background: white;
        color: #495057;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        transition: all 0.2s ease;
        min-width: 35px;
    }

    .page-btn:hover {
        background: #e9ecef;
        text-decoration: none;
        color: #495057;
    }

    .page-btn.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }

    .page-btn.disabled {
        background: #f8f9fa;
        color: #6c757d;
        cursor: not-allowed;
        opacity: 0.6;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .program-kerja-container {
            margin: 10px;
        }

        .table-header-section {
            flex-direction: column;
            gap: 15px;
            padding: 20px;
        }

        .search-input {
            width: 100%;
        }

        .btn-action-group {
            flex-direction: column;
            gap: 8px;
        }

        .btn-action {
            width: 100%;
        }

        .pagination-nav {
            flex-wrap: wrap;
            gap: 5px;
        }

        .page-btn {
            min-width: 35px;
            height: 35px;
            font-size: 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Program Kerja Container -->
    <div class="program-kerja-container">
        <!-- Table Header Section -->
        <div class="table-header-section">
            <div>
                <h5>Program Kerja</h5>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <input type="text" class="search-input" placeholder="Cari program...">
                </div>
                <a href="{{ route('program-kerja.create') }}" class="btn-create">
                    <i class="bx bx-plus"></i>
                    Tambah Program
                </a>
            </div>
        </div>

        <!-- Program Table -->
        <div class="program-table-wrapper">
            <table class="program-table">
                <thead>
                    <tr>
                        <th style="width: 120px;">Nama Komisi</th>
                        <th>Nama Program</th>
                        <th style="width: 280px;">Nama Program</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $samplePrograms = [
                            ['komisi' => 'Komisi I', 'program' => 'Ibadah Liturgi Musik Gerejawi Dan Multimedia'],
                            ['komisi' => 'Komisi II', 'program' => 'Pembinaan Warga Gereja & Organisasi Intra Gereja'],
                            ['komisi' => 'Komisi III', 'program' => 'Diakonia Dan Lansia'],
                            ['komisi' => 'Komisi IV', 'program' => 'Pelayanan Injil & Partisipasi Dan Peningkatan Peran Kebangsaan'],
                            ['komisi' => 'Komisi V', 'program' => 'Sarana Prasarana Pemeliharaan Aset & Pembangunan'],
                            ['komisi' => 'Komisi VI', 'program' => 'Keuangan'],
                            ['komisi' => 'Komisi VII', 'program' => 'Verifikasi Keuangan Dan Aset Jemaat'],
                            ['komisi' => 'Komisi VIII', 'program' => 'Usmu & Kesekretariatan (Bendahara)'],
                            ['komisi' => 'Komisi IX', 'program' => ''],
                            ['komisi' => 'Komisi X', 'program' => 'Usmutn & Kesekretariatan (Wakil Bendahara)']
                        ];
                    @endphp

                    @foreach($samplePrograms as $index => $item)
                        <tr>
                            <td class="komisi-cell">
                                {{ $item['komisi'] }}
                            </td>
                            <td class="program-cell">
                                {{ $item['program'] }}
                            </td>
                            <td class="action-cell">
                                <div class="btn-action-group">
                                    <a href="{{ route('program-kerja.create') }}" class="btn-action btn-create" data-tooltip="Create">
                                        <i class="bx bx-plus"></i>
                                    </a>
                                    <a href="#" class="btn-action btn-view" data-tooltip="View"
                                       onclick="viewProgram('{{ $item['komisi'] }}', '{{ $item['program'] }}')">
                                        <i class="bx bx-show"></i>
                                    </a>
                                    <a href="#" class="btn-action btn-edit" data-tooltip="Edit"
                                       onclick="editProgram('{{ $item['komisi'] }}', '{{ $item['program'] }}')">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    <button type="button" class="btn-action btn-delete" data-tooltip="Delete"
                                            onclick="deleteProgram('{{ $item['komisi'] }}', '{{ $item['program'] }}')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Section -->
        <div class="pagination-section">
            <div class="pagination-nav">
                <a href="#" class="page-btn disabled">&lt;&lt;</a>
                <a href="#" class="page-btn disabled">&lt;</a>
                <a href="#" class="page-btn">1</a>
                <a href="#" class="page-btn">2</a>
                <a href="#" class="page-btn">3</a>
                <a href="#" class="page-btn">4</a>
                <a href="#" class="page-btn">5</a>
                <a href="#" class="page-btn">6</a>
                <a href="#" class="page-btn">7</a>
                <a href="#" class="page-btn">8</a>
                <a href="#" class="page-btn">9</a>
                <a href="#" class="page-btn">10</a>
                <a href="#" class="page-btn">&gt;</a>
                <a href="#" class="page-btn">&gt;&gt;</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Function untuk Create Program
    function createProgram(komisi, program) {
        // Show modal atau redirect ke form create
        Swal.fire({
            title: 'Create Program',
            html: `
                <div style="text-align: left;">
                    <p><strong>Komisi:</strong> ${komisi}</p>
                    <p><strong>Program:</strong> ${program}</p>
                    <br>
                    <label for="newProgram">Nama Program Baru:</label>
                    <input type="text" id="newProgram" class="swal2-input" placeholder="Masukkan nama program baru">
                    <br>
                    <label for="description">Deskripsi:</label>
                    <textarea id="description" class="swal2-textarea" placeholder="Masukkan deskripsi program"></textarea>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Create',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#007bff',
            preConfirm: () => {
                const newProgram = document.getElementById('newProgram').value;
                const description = document.getElementById('description').value;

                if (!newProgram) {
                    Swal.showValidationMessage('Nama program harus diisi!');
                    return false;
                }

                return { newProgram, description };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Simulate API call
                Swal.fire({
                    title: 'Success!',
                    text: `Program "${result.value.newProgram}" berhasil dibuat untuk ${komisi}`,
                    icon: 'success',
                    confirmButtonColor: '#007bff'
                });

                // TODO: Implement actual API call
                // createProgramAPI(komisi, result.value.newProgram, result.value.description);
            }
        });
    }

    // Function untuk View Program
    function viewProgram(komisi, program) {
        Swal.fire({
            title: 'Detail Program',
            html: `
                <div style="text-align: left;">
                    <h4 style="color: #007bff; margin-bottom: 15px;">Informasi Program</h4>
                    <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                        <p><strong>Nama Komisi:</strong> ${komisi}</p>
                        <p><strong>Nama Program:</strong> ${program || 'Belum ada program'}</p>
                        <p><strong>Status:</strong> <span style="color: #28a745;">Aktif</span></p>
                        <p><strong>Tanggal Dibuat:</strong> ${new Date().toLocaleDateString('id-ID')}</p>
                    </div>
                    <div style="background: #e3f2fd; padding: 15px; border-radius: 8px;">
                        <p><strong>Deskripsi:</strong></p>
                        <p style="margin: 0;">Program kerja untuk ${komisi} yang mencakup berbagai kegiatan dan aktivitas sesuai dengan bidang tugasnya.</p>
                    </div>
                </div>
            `,
            confirmButtonText: 'Close',
            confirmButtonColor: '#6c757d',
            width: '600px'
        });
    }

    // Function untuk Edit Program
    function editProgram(komisi, program) {
        Swal.fire({
            title: 'Edit Program',
            html: `
                <div style="text-align: left;">
                    <p><strong>Komisi:</strong> ${komisi}</p>
                    <br>
                    <label for="editProgram">Nama Program:</label>
                    <input type="text" id="editProgram" class="swal2-input" value="${program}" placeholder="Masukkan nama program">
                    <br>
                    <label for="editDescription">Deskripsi:</label>
                    <textarea id="editDescription" class="swal2-textarea" placeholder="Masukkan deskripsi program">Program kerja untuk ${komisi}</textarea>
                    <br>
                    <label for="editStatus">Status:</label>
                    <select id="editStatus" class="swal2-select">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Non-Aktif</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#ffc107',
            preConfirm: () => {
                const editProgram = document.getElementById('editProgram').value;
                const editDescription = document.getElementById('editDescription').value;
                const editStatus = document.getElementById('editStatus').value;

                if (!editProgram) {
                    Swal.showValidationMessage('Nama program harus diisi!');
                    return false;
                }

                return { editProgram, editDescription, editStatus };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Updated!',
                    text: `Program "${result.value.editProgram}" berhasil diupdate`,
                    icon: 'success',
                    confirmButtonColor: '#ffc107'
                });

                // TODO: Implement actual API call
                // updateProgramAPI(komisi, result.value);
            }
        });
    }

    // Function untuk Delete Program
    function deleteProgram(komisi, program) {
        Swal.fire({
            title: 'Hapus Program?',
            html: `
                <div style="text-align: left;">
                    <p>Apakah Anda yakin ingin menghapus program ini?</p>
                    <div style="background: #fff3cd; padding: 15px; border-radius: 8px; margin: 15px 0; border-left: 4px solid #ffc107;">
                        <p><strong>Komisi:</strong> ${komisi}</p>
                        <p><strong>Program:</strong> ${program || 'Belum ada program'}</p>
                    </div>
                    <p style="color: #dc3545; font-weight: bold;">⚠️ Tindakan ini tidak dapat dibatalkan!</p>
                </div>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleted!',
                    text: `Program "${program}" berhasil dihapus dari ${komisi}`,
                    icon: 'success',
                    confirmButtonColor: '#dc3545'
                });

                // TODO: Implement actual API call
                // deleteProgramAPI(komisi, program);
            }
        });
    }

    // Search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('.search-input');
        const tableRows = document.querySelectorAll('.program-table tbody tr');

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                tableRows.forEach(row => {
                    const komisi = row.querySelector('.komisi-cell').textContent.toLowerCase();
                    const program = row.querySelector('.program-cell').textContent.toLowerCase();

                    if (komisi.includes(searchTerm) || program.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endpush
