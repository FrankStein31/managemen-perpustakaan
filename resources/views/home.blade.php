@extends('layouts.admin')

@section('main-content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Books</p>
                                <h3 class="font-weight-bolder mb-0">
                                    {{ $bookCount }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fas fa-book text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Categories</p>
                                <h3 class="font-weight-bolder mb-0">
                                    {{ $categoryCount }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                <i class="fas fa-tag text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12 mb-4">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Welcome Dashboard</h6>
                </div>
                <div class="card-body p-3">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h1 class="display-4 text-center mb-4">Selamat Datang di Sistem Manajemen Perpustakaan</h1>
                    <p class="lead text-center">Kelola buku, kategori, dan lihat statistik perpustakaan Anda dari sini.</p>
                    <div class="text-center mt-4">
                        <a href="{{ route('books.index') }}" class="btn btn-primary btn-lg m-2">
                            <i class="fas fa-book mr-2"></i> Kelola Buku
                        </a>
                        <a href="{{ route('categories.index') }}" class="btn btn-success btn-lg m-2">
                            <i class="fas fa-tag mr-2"></i> Kelola Kategori
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px 0 rgba(0, 0, 0, 0.1), 0 11px 15px -5px rgba(0, 0, 0, 0.05);
    }
    .icon-shape {
        width: 60px;
        height: 60px;
        background-position: center;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .border-radius-md {
        border-radius: 0.5rem;
    }
    .display-4 {
        font-weight: 600;
        color: #344767;
    }
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
    .bg-gradient-primary {
        background: linear-gradient(195deg, #49a3f1 0%, #1A73E8 100%);
    }
    .bg-gradient-success {
        background: linear-gradient(195deg, #66BB6A 0%, #43A047 100%);
    }
</style>
@endpush

