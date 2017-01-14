<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;
use DB;
use App\Track;
use App\TopTrack;

class MainController extends Controller
{
    public function index(Track $track)
    {
        $tracks = Track::where('track','!=',NULL)->orderBy('updated_at', 'desc')->get();
        return view('main', compact('tracks'));
    }
    
    public function top(Track $track)
    {
        //$toptracks = TopTrack::all();
        $toptracks = DB::table('top_tracks')->get();
        foreach ($toptracks as $toptrack) {
            //echo $toptrack->id;
            $number = $toptrack->id;
            $track = DB::table('tracks')->where('top_track_id', $number)->first();
            if ($track === null) {
                $html = new \Htmldom('https://www.beatport.com/track/chemistry-original-mix/'.$number);
                $title=$html->find('div.interior-title h1', 0)->plaintext;
                $remixer=$html->find('div.interior-title h1.remixed', 0)->plaintext;
                foreach($html->find('div.interior-track-artists a') as $artist) {
                    $artist = $artist->innertext.' ';
                }
                $release=$html->find('li.interior-track-released span.value', 0)->plaintext;
                $bpm=$html->find('li.interior-track-bpm span.value', 0)->plaintext;
                $key=$html->find('li.interior-track-key span.value', 0)->plaintext;
                $genre=$html->find('li.interior-track-genre span.value', 0)->plaintext;
                $label=$html->find('li.interior-track-labels span.value', 0)->plaintext;
                $img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');;
                //$number=$html->find('button.playable-play',0)->getAttribute('data-track');
                $audio_link="https://geo-samples.beatport.com/lofi/$number.LOFI.mp3";
                $track = Track::create(['title' => $title, 
                                        'user_id' => NULL, 
                                        'top_track_id' => $number, 
                                        'artist' => $artist, 
                                        'genre' => $genre, 
                                        'bpm' => $bpm, 
                                        'key' => $key, 
                                        'cover' => $img,
                                        'remixer' => $remixer,
                                        'label' => $label,
                                        'release' => $release, 
                                        'preview' => $audio_link]);
                //echo $track->label;
            }
            /*if ($track !== null) {
                echo $track->label;
            }*/
            
        }
        $toptracks = TopTrack::orderBy('top')->paginate(100);
        return view('top', compact('toptracks'));
    }
}
