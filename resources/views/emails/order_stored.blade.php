@component('mail::message')
# 📦 Pesanan Baru Diterima

Berikut adalah detail pesanan:<br><br>

**Nama:** {{ $pesanan->nama }}<br>
**Email:** {{ $pesanan->email }}<br>
**Nomor Telepon:** {{ $pesanan->nomor_telp }}<br>
**Negara:** {{ $pesanan->negara }}<br>
**Jumlah Peserta:** {{ $pesanan->jumlah_peserta }}<br><br>

@component('mail::button', ['url' => url('/')])
🔗 Lihat Website
@endcomponent

Terima kasih telah menggunakan layanan kami.<br>
Salam hangat,
**{{ config('app.name') }}**
@endcomponent
