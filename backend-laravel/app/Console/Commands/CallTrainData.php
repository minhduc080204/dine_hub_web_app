<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CallTrainData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:call-train-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $base_url = config('services.train_url');
        // dd($base_url);
        $recommend = Http::post($base_url.'/train/recommend');
        $item = Http::post($base_url.'/train/item');
        $trending = Http::post($base_url.'/train/trending');

        if ($recommend->successful()) {
            $this->info('API recommend called successfully');
        } else {
            $this->error('API recommend call failed');
        }

        if ($item->successful()) {
            $this->info('API item called successfully');
        } else {
            $this->error('API item call failed');
        }

        if ($trending->successful()) {
            $this->info('API trending called successfully');
        } else {
            $this->error('API trending call failed');
        }
    }
}
