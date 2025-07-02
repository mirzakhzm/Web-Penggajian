@extends('Finance.header-footer')

@section('content')
    <div class="p-6 space-y-6">
        <nav class="text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex items-center space-x-1">
                <li>
                    <a href="/dashboard-finance" class="hover:underline text-gray-500">Home</a>
                </li>
                <li>
                    <span class="text-gray-400">/</span>
                </li>
                <li class="text-gray-700 font-semibold">
                    Data Pembayaran Gaji
                </li>
            </ol>
        </nav>


        <div class="bg-white rounded-xl border border-gray-200 px-8 py-10 shadow-sm">
            <h2 class="text-2xl font-semibold text-gray-800 mb-10 text-center">Data Pembayaran Gaji</h2>

            <p class="text-gray-600 leading-relaxed text-sm mb-4">
                Berikut adalah daftar pembayaran gaji yang telah disetujui oleh manager. Anda dapat melihat detail
                data, status, dan melakukan tindakan yang diperlukan.
            </p>

            <div class="flex justify-end">
                <a href="{{ route('Finance.exportExcel') }}"
                    class="mb-4 inline-block bg-green-600 text-white px-4 py-2 text-sm rounded hover:bg-green-700 transition">
                    📥 Export Excel
                </a>
            </div>
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th
                            class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Pembayaran
                        </th>
                        <th
                            class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Karyawan
                        </th>
                        <th
                            class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Bulan
                        </th>
                        <th
                            class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah Gaji
                        </th>
                        <th
                            class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status Pengajuan
                        </th>
                        <th
                            class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status Pembayaran
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($salaries as $salary)
                        <!-- Baris Utama -->
                        <tr onclick="window.location='{{ route('Finance.showPaymentForm', $salary->id) }}';"
                            class="border-b border-gray-200 cursor-pointer hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-center text-sm text-gray-700">
                                {{ optional($salary->payment)->tanggal_pembayaran
                                    ? \Carbon\Carbon::parse($salary->payment->tanggal_pembayaran)->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td class="px-6 py-4 text-center text-sm text-gray-700">{{ $salary->nama_karyawan }}</td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700">{{ $salary->bulan }}</td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700">
                                {{ number_format($salary->total_diterima, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700">{{ $salary->status_pengajuan }}</td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700">
                                {{ $salary->payment->status_pembayaran ?? '-' }}</td>
                        </tr>

                        <tr class="detail-row hidden" id="detail-{{ $salary->id }}">
                            <td colspan="7" class="px-6 py-4 bg-gray-50">
                                <form action="{{ route('Finance.processPayment', $salary->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="text-sm text-gray-700">Unggah Bukti Pembayaran:</div>
                                    <input type="file" name="bukti_pembayaran" accept="image/*,application/pdf"
                                        class="block w-full text-sm text-gray-700 border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring focus:border-blue-500">

                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
                                        Simpan Pembayaran
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @endsection
