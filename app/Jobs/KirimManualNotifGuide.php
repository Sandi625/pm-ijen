<?php

namespace App\Jobs;

use App\Http\Controllers\PilihGuideController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class KirimManualNotifGuide implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $guideId;

    public function __construct($guideId)
    {
        $this->guideId = $guideId;
    }

    public function handle()
    {
        // Panggil controller method secara manual
        app(PilihGuideController::class)->sendNotifToGuide($this->guideId);
    }
}
