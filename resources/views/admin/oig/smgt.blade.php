@extends('layouts.admin')

@section('title', 'SMGT - Sekolah Minggu Gereja Toraja')

@push('styles')
<style>
    .crud-container {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .crud-header {
        background: #f8f9fa;
        padding: 20px 25px;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .crud-header h5 {
        margin: 0;
        font-weight: 600;
        color: #495057;
        font-size: 18px;
    }

    .crud-body {
        padding: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        padding: 10px 15px;
    }

    .table {
        margin-top: 20px;
    }

    .btn-group {
        gap: 5px;
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="crud-container">
        <div class="crud-header">
            <h5>👶 SMGT - Sekolah Minggu Gereja Toraja</h5>
        </div>

        <div class="crud-body">
            <!-- Form Input -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Form Data Anak SMGT</h6>
                        </div>
                        <div class="card-body">
                            <form id="smgtForm">
                                <div class="form-group">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Umur</label>
                                    <input type="number" class="form-control" name="umur" min="3" max="12">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nama Orang Tua</label>
                                    <input type="text" class="form-control" name="nama_ortu">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">No. Telepon Orang Tua</label>
                                    <input type="text" class="form-control" name="telepon">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Kelas</label>
                                    <select class="form-control" name="kelas">
                                        <option value="balita">Balita (3-5 tahun)</option>
                                        <option value="anak">Anak (6-9 tahun)</option>
                                        <option value="pra_remaja">Pra Remaja (10-12 tahun)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak_aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-2"></i>Simpan
                                    </button>
                                    <button type="reset" class="btn btn-secondary ms-2">
                                        <i class="bx bx-reset me-2"></i>Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Data Table -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Data Anak SMGT</h6>
                            <button class="btn btn-success btn-sm">
                                <i class="bx bx-export me-1"></i>Export
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Anak</th>
                                            <th>Umur</th>
                                            <th>Orang Tua</th>
                                            <th>Telepon</th>
                                            <th>Kelas</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Andi Rante</td>
                                            <td>7</td>
                                            <td>Bapak Andreas Rante</td>
                                            <td>0812-3456-7890</td>
                                            <td><span class="badge bg-info">Anak</span></td>
                                            <td><span class="badge bg-success">Aktif</span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-warning">
                                                        <i class="bx bx-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Sari Toding</td>
                                            <td>5</td>
                                            <td>Ibu Maria Toding</td>
                                            <td>0813-4567-8901</td>
                                            <td><span class="badge bg-warning">Balita</span></td>
                                            <td><span class="badge bg-success">Aktif</span></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-warning">
                                                        <i class="bx bx-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
