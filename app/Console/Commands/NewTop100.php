<?php

namespace App\Console\Commands;

use App\Track;
use App\TopTrack;
use DB;
use Illuminate\Support\Facades\Schema;

use Illuminate\Console\Command;

class NewTop100 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:top100';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Track $track, TopTrack $topTrack)
    {
        $beat = 'https://www.beatport.com/top-100';
        $html = new \Htmldom($beat);
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('top_tracks')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        foreach($html->find('li.bucket-item') as $track) {
            $number = $track->find('button.track-queue',0)->getAttribute('data-track');
            $top = $track->find('div.buk-track-num',0)->plaintext;
            $title = $track->find('span.buk-track-primary-title',0)->plaintext;
            $topTrack = TopTrack::create(['title' => $title,
                                'id' => $number, 
                                'top' => $top]);
            echo $top.' '.$title.'<br>';
        }
    }
}
