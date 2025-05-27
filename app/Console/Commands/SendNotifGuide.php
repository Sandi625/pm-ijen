<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Guide;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class SendNotifGuide extends Command
{
    protected $signature = 'guide:send-notif {guide_id}';
    protected $description = 'Kirim notifikasi ke guide dengan delay 15 detik';

    public function handle()
    {
        $guideId = $this->argument('guide_id');

        // Delay 15 detik di sini, agar tidak blocking di controller
        sleep(15);

        $this->sendNotifToGuide($guideId);

        $this->info("Notifikasi dikirim ke guide ID: $guideId");
    }

    protected function sendNotifToGuide($id)
    {
        $guide = Guide::findOrFail($id);
        $phone = preg_replace('/^0/', '62', $guide->nomer_hp);

        Carbon::setLocale('id');
        $waktuIndonesia = Carbon::now()->translatedFormat('d F Y H:i');

        $isiPesan = "Haloo {$guide->nama_guide}, Anda terpilih untuk melakukan guiding pada {$waktuIndonesia} WIB.\nSilakan login untuk melihat detailnya:\nhttp://localhost:8000/login";

        // Simpan notifikasi ke database
        $notifikasi = Notifikasi::create([
            'guide_id'      => $guide->id,
            'isi'           => $isiPesan,
            'tanggal_kirim' => now(),
            'status'        => 'notif pending masih di proses',
        ]);

        // Kirim notifikasi ke Fonnte API
        $response = Http::withHeaders([
            'Authorization' => 'HbHggEjszXST3WxTchcd'
        ])->post('https://api.fonnte.com/send', [
            'target'  => $phone,
            'message' => $isiPesan,
        ]);

        // Update status notifikasi sesuai response API
        if ($response->successful()) {
            $notifikasi->update(['status' => 'notif sudah terkirim']);
        } else {
            $notifikasi->update(['status' => 'notif belum terkirim']);
        }
    }
}
