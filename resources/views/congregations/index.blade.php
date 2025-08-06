@extends('layouts.admin')

@section('title', 'Congregations')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4" style="color: #8B4513;">
                    <span class="text-muted fw-light">🏠 Dashboard /</span> 👥 Congregations
                </h4>
                <a href="{{ route('congregations.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i>➕ Add New Congregation
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Pastor</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($congregations as $congregation)
                                    <tr>
                                        <td>{{ $congregation->name }}</td>
                                        <td>{{ $congregation->location }}</td>
                                        <td>{{ $congregation->pastor_name ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $congregation->status === 'active' ? 'success' : 'danger' }}">
                                                {{ ucfirst($congregation->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('congregations.show', $congregation) }}">
                                                        <i class="bx bx-show me-1"></i> View
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('congregations.edit', $congregation) }}">
                                                        <i class="bx bx-edit me-1"></i> Edit
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('congregations.destroy', $congregation) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this congregation?')">
                                                            <i class="bx bx-trash me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($congregations->hasPages())
                        <div class="mt-4">
                            {{ $congregations->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
