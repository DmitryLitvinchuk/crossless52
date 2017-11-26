<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;
use DB;
use App\Track;
use App\TopTrack;

class MainController extends Controller
{
    //Главная страница
    public function index(Track $track, TopTrack $toptrack)
    {
        $page_name = 'New Tracks';
        $tracks = Track::where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->paginate(12);
		//parser #1
		foreach($tracks as $track) {
			$date = $track -> updated_at;
			if ($date < '2017-11-27 02:23:30') {
				$track_id = $track -> top_track_id;
				$html = new \Htmldom('https://www.beatport.com/track/track/'.$track_id);
				$img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');
				$track -> cover = $img;
				$track->save();
			}
			
		}
		//parser #1
        $toptracks = TopTrack::orderBy('top')->paginate(10);
        return view('main', compact('tracks', 'toptracks','page_name'));
    }
    
    //Страница информации
    public function about()
    {
        return view('about');
    }
    
    //Страница жанра
    public function genre($genre, Track $track)
    {
        //UPDATE tracks SET genre=TRIM(genre)
        $page_name = $genre;
        $tracks = Track::where('genre',$genre)->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница лейбла
    public function label($label)
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = $label;
        $tracks = Track::where('label',$label)->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Spinnin
    public function Spinnin()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = "SPINNIN' RECORDS";
        $tracks = Track::where('label','Spinnin&#39; Remixes')->orWhere('label','SPRS')->orWhere('label','SPINNIN&#39; RECORDS')->orWhere('label',"SPINNIN&#39; DEEP")->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Indie Dance / Nu Disco
    public function IndieDanceNuDisco()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = 'Indie Dance / Nu Disco';
        $tracks = Track::where('genre','Indie Dance / Nu Disco')->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Indie Dance / Nu Disco
    public function DrumBass()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = 'Drum&Bass';
        $tracks = Track::where('genre','Drum &amp; Bass')->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Electronica / Downtempo
    public function ElectronicaDowntempo()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = 'Electronica / Downtempo';
        $tracks = Track::where('genre','Electronica / Downtempo')->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Electronica / Downtempo
    public function HardcoreHardTechno()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = 'Hardcore / Hard Techno';
        $tracks = Track::where('genre','Hardcore / Hard Techno')->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Топ100
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
                /*foreach($html->find('div.interior-track-artists a') as $artist) {
                    $artist = $artist->innertext.' ';
                }*/
                $artist = $html->find('div.interior-track-artists a', 0)->innertext;
                $release=$html->find('li.interior-track-released span.value', 0)->plaintext;
                $bpm=$html->find('li.interior-track-bpm span.value', 0)->plaintext;
                $key=$html->find('li.interior-track-key span.value', 0)->plaintext;
                $genre=$html->find('li.interior-track-genre span.value', 0)->plaintext;
                $new_genre = trim($genre);
                $label=$html->find('li.interior-track-labels span.value', 0)->plaintext;
                $new_label = trim($label);
                $img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');;
                //$number=$html->find('button.playable-play',0)->getAttribute('data-track');
                $audio_link="https://geo-samples.beatport.com/lofi/$number.LOFI.mp3";
                $track = Track::create(['title' => $title, 
                                        'user_id' => NULL, 
                                        'top_track_id' => $number, 
                                        'artist' => $artist, 
                                        'genre' => $new_genre, 
                                        'bpm' => $bpm, 
                                        'key' => $key, 
                                        'cover' => $img,
                                        'remixer' => $remixer,
                                        'label' => $new_label,
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
