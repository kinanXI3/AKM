<?php

namespace App\Console\Commands;

use App\Models\Kunjungan;
use Illuminate\Console\Command;

class MoveToHistory extends Command
{
    protected $signature = 'kunjungan:move-history';
    protected $description = 'Move yesterday kunjungan data to history';

    public function handle()
    {
        $yesterday = now()->subDay()->toDateString();
        
        Kunjungan::whereDate('tanggal', $yesterday)
                 ->where('is_history', false)
                 ->update(['is_history' => true]);

        $this->info('Data kunjungan kemarin telah dipindahkan ke riwayat.');
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('kunjungan:move-history')->dailyAt('00:01');
    }
}
