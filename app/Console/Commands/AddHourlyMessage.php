<?php

namespace App\Console\Commands;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddHourlyMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:hourly-message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Her 15 dakikada saati gösteren mesaj ekler.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $currentTime = Carbon::now()->format('H:i');
        $messageText = "Guk guk! Saat " . $currentTime;

        $model = new Message();
        $model->forceFill([
            'user_id' => 1,
            'message' => $messageText,
        ])->save();

        $this->info('Otomatik mesaj eklendi: ' . $messageText);
    }
}
