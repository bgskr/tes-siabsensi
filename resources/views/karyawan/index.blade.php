@extends('layouts.app')

@section('content')
    <div class="container mt-10">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
            <!-- Container wrapper -->
            <div class="container my-2">
                <!-- Navbar brand -->
                <a class="navbar-brand me-2" href="https://mdbgo.com/">
                    <img src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp" height="16" alt="MDB Logo"
                        loading="lazy" style="margin-top: -1px;" />
                </a>

                <!-- Toggle button -->
                <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarButtonsExample"
                    aria-controls="navbarButtonsExample" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarButtonsExample">
                    <!-- Left links -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <h4 style="margin-bottom: 0;">Absensi Karyawan</h4>
                        </li>
                    </ul>
                    <!-- Left links -->

                    <div class="d-flex align-items-center">
                        <div class="text-center me-3">
                            <p style="margin-bottom: 0;">Selamat Datang, {{ auth()->user()->name }}</p>
                        </div>
                        <div>
                            @if (auth()->user()->username)
                                <a data-mdb-ripple-init type="button" href="{{ route('logout') }}"
                                    class="btn btn-danger me-2">Logout</a>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Collapsible wrapper -->
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
        <div class="my-4">
            @include('karyawan.create')
        </div>

        <div class="d-flex my-5">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($data as $absensi)
                                @if ($absensi->id_karyawan == auth()->user()->nip)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ \Carbon\Carbon::parse($absensi->tanggal_masuk)->locale('id')->isoFormat('dddd') }}
                                        </td>
                                        <td>{{ $absensi->tanggal_masuk }}</td>
                                        @if($absensi->keterangan == 'Masuk')
                                        <td><p class="text-wrap bg-success badge fw-normal fs-6 my-1" style="margin: 0;">
                                            {{ $absensi->keterangan }}
                                        </p>
                                        </td>
                                        @elseif($absensi->keterangan == 'Izin')
                                        <td><p class="text-wrap bg-danger badge fw-normal fs-6 my-1" style="margin: 0;">
                                            {{ $absensi->keterangan }}
                                        </p>
                                        </td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
