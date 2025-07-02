<?php

namespace App\Http\Controllers;

use App\Models\Salari;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Exports\SalaryExport;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class SalariController extends Controller
{
    public function listSalary()
    {
        $user = Auth::user();

        $salaries = Salari::whereIn('status_pengajuan', ['pending', 'rejected'])->get();

        if ($user->role === 'Finance') {
            return view('Finance.list-salary', compact('salaries'));
        } elseif ($user->role === 'Manager') {
            return view('Manager.list-salary', compact('salaries'));
        } else {
            return view('Director.report-salary');
        }
    }

    public function listPayment()
    {
        $salaries = Salari::where('status_pengajuan', 'approved')->get();
        foreach ($salaries as $salary) {
            $salary->payment = Payment::where('salary_id', $salary->id)->first();
        }
        return view('Finance.list-payment', compact('salaries'));
    }

    public function addSalary()
    {
        return view('Finance.add-salary');
    }

    public function storeSalary(Request $request)
    {
        $data = $request->validate([
            'nama_karyawan' => 'required|string|max:255',
            'bulan' => 'required|string|max:255',
            'gaji_pokok' => 'required|numeric',
            'bonus' => 'required|numeric',
            'pajak' => 'required|numeric',
            'total_diterima' => 'required|numeric',
            'notes' => 'nullable|string|max:500',
        ]);
        $data['nama_karyawan'] = $request->input('nama_karyawan');
        $data['bulan'] = $request->input('bulan');
        $data['gaji_pokok'] = $request->input('gaji_pokok');
        $data['bonus'] = $request->input('bonus');
        $data['pajak'] = $request->input('pajak');
        $data['total_diterima'] = $request->input('total_diterima');
        $data['notes'] = $request->input('notes');
        $data['tanggal_pengajuan'] = now();

        Salari::create($data);

        return redirect()->route('listSalary')->with('success', 'Pengajuan Gaji Berhasil.');
    }

    public function showPaymentForm($id)
    {
        $salary = Salari::findOrFail($id);
        return view('Finance.upload-payment', compact('salary'));
    }

    public function processPayment(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $payment = Payment::where('salary_id', $id)->firstOrFail(); // Ganti findOrFail($id)

        $filePath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $payment->update([
            'bukti_pembayaran' => $filePath,
            'tanggal_pembayaran' => now(),
            'status_pembayaran' => 'paid',
        ]);

        return back()->with('success', 'Pembayaran berhasil disimpan.');
    }

    public function approve($id)
    {
        $salary = Salari::findOrFail($id);
        $salary->status_pengajuan = 'approved';
        $salary->save();

        Payment::firstOrCreate(
            [
                'salary_id' => $salary->id,
            ],
            [
                'status_pembayaran' => 'pending',
            ],
        );

        return redirect()->back()->with('success', 'Pengajuan berhasil disetujui.');
    }

    public function reject($id)
    {
        $salary = Salari::findOrFail($id);
        $salary->status_pengajuan = 'rejected';
        $salary->save();

        Payment::firstOrCreate(
            [
                'salary_id' => $salary->id,
            ],
            [
                'status_pembayaran' => 'pending',
            ],
        );

        return redirect()->back()->with('success', 'Pengajuan ditolak.');
    }

    public function exportExcel()
    {
        $fileName = 'laporan-gaji-' . now()->format('Ymd_His') . '.xlsx';

        Excel::store(new SalaryExport(), 'reports/' . $fileName, 'public');

        $data = app(SalaryExport::class)->collection();
        Report::create([
            'nama_file' => $fileName,
            'jumlah_data' => $data->count(),
        ]);

        return response()->download(storage_path('app/public/reports/' . $fileName));
    }

    public function showReports()
    {
        $reports = Report::orderBy('created_at', 'desc')->get();
        return view('Director.report-salary', compact('reports'));
    }

    public function downloadReport($file)
    {
        $path = storage_path('app/public/reports/' . $file);

        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($path);
    }
}
