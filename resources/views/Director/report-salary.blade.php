@extends('Director.header-footer')

@section('content')
    <div class="p-6 space-y-6">
        <nav class="text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex items-center space-x-1">
                <li>
                    <a href="/dashboard-director" class="hover:underline text-gray-500">Home</a>
                </li>
                <li>
                    <span class="text-gray-400">/</span>
                </li>
                <li class="text-gray-700 font-semibold">
                    Laporan Gaji
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-xl border border-gray-200 px-8 py-10 shadow-sm">
            <h2 class="text-2xl font-semibold text-gray-800 mb-10 text-center">Laporan Gaji Karyawan</h2>

            <p class="text-gray-600 leading-relaxed text-sm mb-4">
                Berikut adalah daftar file laporan gaji yang telah diekspor oleh bagian finance. Anda dapat melihat tanggal
                export dan mengunduh kembali file laporan.
            </p>

            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Dibuat
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Periode Laporan
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama File
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah Data
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($reports as $report)
                        <tr class="border-b border-gray-200">
                            <td class="px-6 py-4 text-center text-sm text-gray-700">
                                {{ Carbon\Carbon::parse($report->created_at)->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($report->created_at)->locale('id')->translatedFormat('F') }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700">
                                {{ $report->nama_file }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700">
                                {{ $report->jumlah_data }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm">
                                <a href="{{ route('Director.downloadReport', $report->nama_file) }}"
                                    class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition text-xs">
                                    📥 Download
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
