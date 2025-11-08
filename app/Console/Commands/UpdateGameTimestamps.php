<?php

namespace App\Console\Commands;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateGameTimestamps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:update-timestamps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all game timestamps to current time with Vietnam timezone';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $games = Game::all();
        
        foreach ($games as $game) {
            $game->update(['last_updated' => Carbon::now('Asia/Ho_Chi_Minh')]);
        }
        
        $this->info('Updated ' . count($games) . ' game(s) with current timestamp.');
    }
}
