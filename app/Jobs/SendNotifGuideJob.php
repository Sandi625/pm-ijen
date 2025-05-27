<?php

namespace App\Jobs;

use App\Models\Guide;
use App\Models\Notifikasi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class SendNotifGuideJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public int $guideId) {}

    public function handle(): void
    {
        $guide = Guide::findOrFail($this->guideId);
        $phone = preg_replace('/^0/', '62', $guide->nomer_hp);

        Carbon::setLocale('id');
        $waktu = Carbon::now()->translatedFormat('d F Y H:i');
        $pesan = "Haloo {$guide->nama_guide}, Anda terpilih untuk guiding pada {$waktu} WIB.\nSilakan login:\nhttp://localhost:8000/login";

        $notifikasi = Notifikasi::create([
            'guide_id' => $guide->id,
            'isi' => $pesan,
            'tanggal_kirim' => now(),
            'status' => 'notif pending masih di proses',
        ]);

        $res = Http::withHeaders([
            'Authorization' => 'HbHggEjszXST3WxTchcd'
        ])->post('https://api.fonnte.com/send', [
            'target' => $phone,
            'message' => $pesan,
        ]);

        $notifikasi->update(['status' => $res->successful() ? 'notif sudah terkirim' : 'notif belum terkirim']);
    }
}
