<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Track;
use App\TopTrack;

class ParserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    
    /*public function TopTrack(Track $track, TopTrack $topTrack)
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
    }*/
}
