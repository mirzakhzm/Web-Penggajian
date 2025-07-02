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
                    Tambah Pengajuan Gaji
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-2xl border border-gray-200 p-8 md:p-10 shadow">
            <h2 class="text-2xl font-semibold text-gray-800 text-center mb-8">Tambah Pengajuan Gaji</h2>

            <form id="salaryForm" action="{{ route('Finance.storeSalary') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_karyawan" class="block text-sm font-medium text-gray-700 mb-1">Nama
                            Karyawan</label>
                        <input type="text" id="nama_karyawan" name="nama_karyawan"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            placeholder="Masukkan nama karyawan" autocomplete="off" required>
                    </div>

                    <div>
                        <label for="bulan" class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                        <select id="bulan" name="bulan"
                            class="block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            required>
                            <option value="" disabled selected>Pilih bulan</option>
                        </select>
                    </div>

                    <div>
                        <label for="gaji_pokok" class="block text-sm font-medium text-gray-700 mb-1">Nilai Gaji</label>
                        <input id="gaji_pokok" name="gaji_pokok"
                            class="uang block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            placeholder="Masukkan nilai gaji" autocomplete="off" required>
                        </input>
                    </div>

                    <div>
                        <label for="bonus" class="block text-sm font-medium text-gray-700 mb-1">Bonus</label>
                        <input id="bonus" name="bonus"
                            class="uang block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            placeholder="Masukkan nilai bonus" autocomplete="off" required>
                        </input>
                    </div>
                    <div>
                        <label for="pajak" class="block text-sm font-medium text-gray-700 mb-1">Pajak Pph</label>
                        <input id="pajak" name="pajak"
                            class="uang block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            readonly>
                        </input>
                    </div>
                    <div>
                        <label for="total_diterima" class="block text-sm font-medium text-gray-700 mb-1">Gaji Bersih</label>
                        <input id="total_diterima" name="total_diterima"
                            class="uang block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
                            readonly>
                        </input>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition duration-200 ease-in-out">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    @endsection

    @section('scripts')
        <script>
            function capitalize(str) {
                if (!str) return str;
                return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
            }

            const namaBulan = [
                "januari", "februari", "maret", "april", "mei", "juni",
                "juli", "agustus", "september", "oktober", "november", "desember"
            ];

            const select = document.getElementById('bulan');

            namaBulan.forEach(name => {
                const option = document.createElement('option');
                option.value = capitalize(name); 
                option.textContent = capitalize(name);
                select.appendChild(option);
            });

            function formatRupiah(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function cleanNumber(input) {
                return parseInt(input.replace(/\./g, '').replace(/\D/g, '')) || 0;
            }

            function updateInputs() {
                const gajiInput = document.getElementById('gaji_pokok');
                const bonusInput = document.getElementById('bonus');

                const gaji = cleanNumber(gajiInput.value);
                const bonus = cleanNumber(bonusInput.value);
                const total = gaji + bonus;

                // Tentukan persentase pajak
                let persen = 0;
                if (total <= 5000000) {
                    persen = 0.05;
                } else if (total <= 20000000) {
                    persen = 0.10;
                } else {
                    persen = 0.15;
                }

                const pajak = Math.round(total * persen);
                const totalDiterima = total - pajak;

                // Update input
                document.getElementById('pajak').value = formatRupiah(pajak);
                document.getElementById('total_diterima').value = formatRupiah(totalDiterima);
            }

            function handleInputFormatAndCalc(e) {
                const input = e.target;
                const cleaned = cleanNumber(input.value);
                input.value = formatRupiah(cleaned);
                updateInputs();
            }

            // Event listener untuk kedua input
            document.getElementById('gaji_pokok').addEventListener('input', handleInputFormatAndCalc);
            document.getElementById('bonus').addEventListener('input', handleInputFormatAndCalc);

            document.getElementById('salaryForm').addEventListener('submit', function(e) {
                const uangInputs = document.querySelectorAll('.uang');
                uangInputs.forEach(input => {
                    input.value = input.value.replace(/\./g, '');
                });
            });
        </script>
    @endsection
