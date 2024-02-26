@extends('layouts.pdf')

@section('content-pdf')
    <div class="header">
        <h1>Your Company Name</h1>
        <p>Your Company Address</p>
    </div>
    <div class="content">
        <h1>Payroll</h1>
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Total Working Days</th>
                <th>Total Absen</th>

            </tr>

            @foreach ($data as $pay)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$pay->nip_pegawai}}</td>
                <td>{{$pay->nip_pegawai}}</td>
                <td>{{20 - $pay->telat - $pay->tidak_masuk}}</td>
                <td>{{$pay->total_potongan}}</td>
                <td>{{$pay->total_salary}}</td>
            </tr>
            @endforeach
            <!-- Total row -->
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                <td>{{$total_pay}}</td>
            </tr>
        </table>
    </div>
@endsection
