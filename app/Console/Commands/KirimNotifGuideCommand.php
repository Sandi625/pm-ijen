<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Guide;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class KirimNotifGuideCommand extends Command
{
    protected $signature = 'guide:send-notif {guide_id}';
    protected $description = 'Mengirim notifikasi ke guide setelah delay 15 detik';

    public function handle()
    {
        sleep(15); // Delay 15 detik

        $guideId = $this->argument('guide_id');
        $guide = Guide::find($guideId);

        if (!$guide) {
            $this->error("Guide tidak ditemukan.");
            return;
        }

        $phone = preg_replace('/^0/', '62', $guide->nomer_hp);
        Carbon::setLocale('id');
        $waktuIndonesia = Carbon::now()->translatedFormat('d F Y H:i');

        $isiPesan = "Haloo {$guide->nama_guide}, Anda terpilih untuk melakukan guiding pada {$waktuIndonesia} WIB.\nSilakan login untuk melihat detailnya:\nhttp://localhost:8000/login";

        $notifikasi = Notifikasi::create([
            'guide_id'      => $guide->id,
            'isi'           => $isiPesan,
            'tanggal_kirim' => now(),
            'status'        => 'notif pending masih di proses',
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'HbHggEjszXST3WxTchcd'
        ])->post('https://api.fonnte.com/send', [
            'target'  => $phone,
            'message' => $isiPesan,
        ]);

        if ($response->successful()) {
            $notifikasi->update(['status' => 'notif sudah terkirim']);
        } else {
            $notifikasi->update(['status' => 'notif belum terkirim']);
        }

        $this->info("Notifikasi dikirim ke guide ID: {$guide->id}");
    }
}
