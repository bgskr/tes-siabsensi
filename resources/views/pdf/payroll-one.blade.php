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
                <th>Nama</th>
                <th>NIP</th>
                <th>Total Working Days</th>
                <th>Cost/Potongan</th>
                <th>Total Salary</th>
            </tr>

            <tr>
                <td>{{$data->payroll_name->name}}</td>
                <td>{{$data->nip_pegawai}}</td>
                <td>{{20 - $data->tidak_masuk}}</td>
                <td>{{formatRupiah($data->total_potongan)}}</td>
                <td>{{formatRupiah($data->total_salary)}}</td>
            </tr>
            <!-- Total row -->
            <tr>
                <td colspan="4" style="text-align: right;"><strong>Total:</strong></td>
                <td>{{formatRupiah($data->total_salary)}}</td>
            </tr>
        </table>
    </div>
@endsection
