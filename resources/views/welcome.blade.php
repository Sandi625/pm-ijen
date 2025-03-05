@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
<div class="flex flex-col items-center justify-center mt-10">
    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4 max-w-2xl w-full text-center">
        <h1 class="text-3xl font-bold mb-4 text-gray-800">Selamat Datang di Sistem Pendukung Keputusan Rekrutmen Bidan dengan Metode Profile Matching</h1>
        <p class="text-gray-600 text-lg mb-6">
            Optimalkan proses rekrutmen bidan Anda dengan sistem pendukung keputusan berbasis metode Profile Matching. 
            Kami memadukan teknologi dan keahlian untuk membantu Anda menemukan kandidat terbaik yang 
            sesuai dengan kebutuhan spesifik institusi kesehatan Anda.
        </p>
        <div class="mb-8">
            <a href="{{ route('login') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-full transition duration-300 inline-flex items-center">
                <i class="fas fa-sign-in-alt mr-2"></i>
                Mulai Masuk Aplikasi
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-left">
            <div class="flex items-start">
                <i class="fas fa-chart-line text-green-500 text-2xl mr-3 mt-1"></i>
                <div>
                    <h3 class="font-semibold text-gray-700">Analisis Akurat</h3>
                    <p class="text-sm text-gray-600">Evaluasi komprehensif berdasarkan kriteria yang terukur</p>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-clock text-green-500 text-2xl mr-3 mt-1"></i>
                <div>
                    <h3 class="font-semibold text-gray-700">Efisiensi Waktu</h3>
                    <p class="text-sm text-gray-600">Percepat proses seleksi dengan algoritma canggih</p>
                </div>
            </div>
            <div class="flex items-start">
                <i class="fas fa-users text-green-500 text-2xl mr-3 mt-1"></i>
                <div>
                    <h3 class="font-semibold text-gray-700">Kualitas Kandidat</h3>
                    <p class="text-sm text-gray-600">Temukan bidan yang benar-benar sesuai dengan kebutuhan Anda</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
