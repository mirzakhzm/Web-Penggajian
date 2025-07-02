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
                    Data Pengajuan Gaji
                </li>
            </ol>
        </nav>


        <div class="bg-white rounded-xl border border-gray-200 px-8 py-10 shadow-sm">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Data Pengajuan Gaji</h2>

            <div class="text-end mb-8">
                <a href="{{ route('Finance.addSalary') }}"
                    class=" mb-4 px-4 py-2 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Tambah Pengajuan Gaji
                </a>
            </div>

            <p class="text-gray-600 leading-relaxed text-sm mb-4">
                Berikut adalah daftar pengajuan gaji yang telah diajukan oleh karyawan. Anda dapat melihat detail
                pengajuan, status, dan melakukan tindakan yang diperlukan.
            </p>

            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th
                            class="px-6 py-3 text-center align-middle text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Pengajuan
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
                    </tr>
                </thead>

                <tbody>
                    @foreach ($salaries as $salary)
                        <tr class="border-b border-gray-200">
                            <td class="px-6 py-4 text-center text-sm text-gray-700">
                                {{ Carbon\Carbon::parse($salary->tanggal_pengajuan)->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700">
                                {{ $salary->nama_karyawan }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700">
                                {{ $salary->bulan }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700">
                                {{ number_format($salary->total_diterima, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center text-sm text-gray-700">
                                {{ $salary->status_pengajuan }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
