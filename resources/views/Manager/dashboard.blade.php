@extends('Manager.header-footer')

@section('content')
    <x-dashboard breadcrumb="Home" title="Selamat Datang, {{ Auth::user()->name }} 👋">
        Anda telah berhasil masuk ke sistem penggajian karyawan. Silakan gunakan menu di samping untuk mengelola
        pengajuan gaji, melihat riwayat transaksi, serta melakukan administrasi lainnya secara efisien dan mudah.
    </x-dashboard>
@endsection
