<?php

namespace App\Http\Controllers;

use App\Models\AbsensiKaryawan;
use App\Models\Payroll;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    public function index() {
        $karyawanCollection = User::role('karyawan')->get();
        $payrolls = [];

        // foreach($karyawanCollection as $karyawan) {
        //     $absences = DB::table('tbl_absensi')->where('id_karyawan', $karyawan->nip)
        //                 ->where('keterangan', 'Izin')
        //                 ->whereMonth('tanggal_masuk', now()->month)
        //                 ->count();
        //     $work = DB::table('tbl_absensi')->where('id_karyawan', $karyawan->nip)
        //                 ->where('keterangan', 'Masuk')
        //                 ->whereMonth('tanggal_masuk', now()->month)
        //                 ->count();
        //     $absenceCost = $absences * 100000;
        //     $salary = 2500000 - $absenceCost;

        //     $payrolls[] = [
        //         'name'      => $karyawan->name,
        //         'nip'       => $karyawan->nip,
        //         'absence'   => $absences,
        //         'cost'      => $absenceCost,
        //         'workday'   => $work,
        //         'salary'    => $salary
        //     ];
        // }

        // dd($karyawanCollection->nip);
        return view('staff.index', [
            'payrolls' => $payrolls,
            'user' => $karyawanCollection
        ]);
    }
    public function payrollIndex() {
        $payrollCollection = Payroll::all();

        return view('staff.payroll-index', [
            'data' => $payrollCollection
        ]);
    }

    public function absensiIndex() {
        $user = User::role('karyawan')->get();
        // $monthName = $user->filter(getMonth('created_at'));
        // dd($monthName);

        return view('staff.absensi-index', [
            'data' => $user
        ]);

    }
    /**
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $updateData = User::find($id);

        $validated = $request->validate([
            'salary'    => 'required|integer',
            'nip'       => 'required'
        ]);
        $updateData->nip = $validated['nip'];
        $updateData->salary = $validated['salary'];
        $updateData->save();
        return redirect()->back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function doPayroll(Request $request) {

        $validated = $request->validate([
            'nip_pegawai' => '',
            'tidak_masuk' => 'integer|max:20',
            'telat' => 'max:20',
            'pph' => 'integer',
        ]);

        if ($validated['telat'] == '') {
            $validated['telat'] = 0;
        }

        $dataKaryawan = User::where('nip', $request->input('nip_pegawai'))->first();
        $perDay = $dataKaryawan->salary / 20;

        $costAbsence = $perDay * $validated['tidak_masuk'];
        $costLate = ($perDay / 2) * $validated['telat'];
        // $costPPh = $validated['pph'];
        $work = (20 - $validated['tidak_masuk'] - $validated['telat']);

        $totalCost = $costAbsence + $costLate;
        $totalSalary = ($perDay * $work);

        $validated['total_salary'] = $totalSalary;

                if ($totalSalary <= 0) {
                    $validated['total_salary'] = 0;
                }
        $validated['total_potongan'] = $totalCost;
        $dataPayroll = Payroll::create($validated);

        if($dataPayroll) {
            return redirect()->back();
        }

        return redirect()->back()->withErrors('error', 'error bang');
    }

    public function generatePDF() {

        $allPayroll = Payroll::all();
        $payrolls = [];

        $sumTotal = $allPayroll->sum('total_salary');
        // foreach($karyawanCollection as $karyawan) {
            // $absences = DB::table('tbl_absensi')->where('id_karyawan', $karyawan->nip)
                        // ->where('keterangan', 'Izin')
                        // ->whereMonth('tanggal_masuk', now()->month)
                        // ->count();
            // $work = DB::table('tbl_absensi')->where('id_karyawan', $karyawan->nip)
                        // ->where('keterangan', 'Masuk')
                        // ->whereMonth('tanggal_masuk', now()->month)
                        // ->count();
            // $absenceCost = $absences * 100000;
            // $salary = 2500000 - $absenceCost;
//
            // $payrolls[] = [
//
                // 'name'      => $karyawan->name,
                // 'nip'       => $karyawan->nip,
                // 'absence'   => $absences,
                // 'cost'      => $absenceCost,
                // 'workday'   => $work,
                // 'salary'    => $salary
            // ];

        // dd($allPayroll->nip_pegawai);
        $pdf = Pdf::loadView('pdf.payrolls', [
            'data' => $allPayroll,
            'total_pay' => $sumTotal
        ]);
        // $pdf = Pdf::loadView('pdf.payroll', [
        //     'nip' => $allPayroll->nip_pegawai,
        //     'absence' => $allPayroll->tidak_masuk,
        //     'late' => $allPayroll->telat,
        //     'pph' => $allPayroll->pph,
        //     'total_cost' => $allPayroll->total_potongan,
        //     'total_salary' => $allPayroll->total_salary,
        // ]);
        return $pdf->stream('tested.pdf');
    }

    public function generatePDFOne($id) {
        $print = Payroll::where('nip_pegawai', $id)->first();
        // dd($print);
        $pdf = Pdf::loadView('pdf.payroll-one', [
            'data' => $print
        ]);

        return $pdf->stream('tested-person-' . $id . '.pdf');
    }

}
