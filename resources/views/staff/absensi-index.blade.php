@extends('layouts.app')

@section('content')
    <!-- Tabs content -->

    <div class="container pt-5 mx-auto">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-between align-items-center gap-3">
                <h1>User Management</h1>
            </div>
            <div class="">
                @if (auth()->user()->username)
                    <div class="text-end">
                        <a href="{{ route('logout') }}" class="btn btn-danger me-2">Logout</a>
                    </div>
                @endif
            </div>
        </div>
        <!-- Tabs navs -->
        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a data-mdb-tab-init class="nav-link" id="ex1-tab-1" href="{{ route('staff.index') }}" role="tab"
                    aria-controls="staff" aria-selected="true">Data Karyawan</a>
            </li>
            <li class="nav-item" role="presentation">
                <a data-mdb-tab-init class="nav-link" id="ex1-tab-2" href="{{ route('staff.payroll-index') }}"
                    role="tab" aria-controls="data-payroll" aria-selected="false">Rekap Payroll</a>
            </li>
            <li class="nav-item" role="presentation">
                <a data-mdb-tab-init class="nav-link active" id="ex1-tab-3" href="{{ route('staff.absensi-index') }}"
                    role="tab" aria-controls="data-payroll" aria-selected="false">Rekap Absensi</a>
            </li>
        </ul>
        <!-- Tabs navs -->
    </div>

    <div class="tab-content" id="ex1-content">
        <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
            <div class="container">
                <div class="d-flex my-5">
                    <div class="card" style="width: 100%;">
                        <div class="card-body">
                            <table class="table table-striped align-middle">
                                <thead class="text-center">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">NIP</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Total Masuk</th>
                                        <th scope="col">Total Izin</th>
                                        <th scope="col">Bulan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dataAbsensi)
                                        <tr>
                                            <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                            <td>{{ $dataAbsensi->nip }}</td>
                                            <td class="text-center">{{ $dataAbsensi->name }}</td>
                                            <td class="text-center">{{ $dataAbsensi->total_masuk['total_masuk'] }}</td>
                                            <td class="text-center">{{ $dataAbsensi->total_izin }}</td>
                                            <td class="text-center">{{ $dataAbsensi->total_masuk['month'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div>
                                <a class="btn btn-outline-danger mt-5" href="{{ route('export.pdf') }}"
                                    style="pointer-events: none; opacity: 0.5;">Print PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
