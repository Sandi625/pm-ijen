@component('mail::message')
# Pesanan Baru

Nama: {{ $pesanan->nama }}
Email: {{ $pesanan->email }}
Nomor Telp: {{ $pesanan->nomor_telp }}
Jumlah Peserta: {{ $pesanan->jumlah_peserta }}

@component('mail::button', ['url' => url('/')])
Lihat Website
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
