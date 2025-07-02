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
                    Upload Bukti Pembayaran Gaji
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-xl border border-gray-200 px-8 py-10 shadow-sm">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Upload Bukti Pembayaran Gaji</h2>

            {{-- Tampilkan jika bukti sudah ada --}}
            @if ($salary->payment && $salary->payment->bukti_pembayaran)
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bukti yang sudah diunggah:</label>
                    @php
                        $ext = pathinfo($salary->payment->bukti_pembayaran, PATHINFO_EXTENSION);
                    @endphp

                    @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $salary->payment->bukti_pembayaran) }}" alt="Bukti Pembayaran"
                            class="max-w-sm border rounded">
                    @elseif ($ext === 'pdf')
                        <a href="{{ asset('storage/' . $salary->payment->bukti_pembayaran) }}" target="_blank"
                            class="inline-block px-4 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                            Lihat Bukti PDF
                        </a>
                    @endif
                </div>
            @endif

            {{-- Form Upload (tetap ditampilkan untuk update/ganti) --}}
            <form action="{{ route('Finance.processPayment', $salary->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <div class="mb-6">
                    <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700 mb-1">
                        @if ($salary->payment && $salary->payment->bukti_pembayaran)
                            Ganti Bukti Pembayaran
                        @else
                            Upload Bukti Pembayaran
                        @endif
                    </label>
                    <input type="file" id="bukti_pembayaran" name="bukti_pembayaran"
                        class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        required>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Simpan Bukti
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
