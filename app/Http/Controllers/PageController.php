<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use App\Track;
use App\TopTrack;
use SEOMeta;
use OpenGraph;
use Twitter;

class PageController extends Controller
{
    //Главная страница
    public function index(Track $track, TopTrack $toptrack)
    {
        $page_name = 'New Tracks';
        $tracks = Track::where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->paginate(12);
        $toptracks = TopTrack::orderBy('top')->paginate(10);
        return view('main', compact('tracks', 'toptracks','page_name'));
    }
    
    //Страница информации
    public function about()
    {
        SEOMeta::setTitle('About Us');
        return view('about');
    }
    
    //Страница жанра
    public function genre($genre, Track $track)
    {
        //UPDATE tracks SET genre=TRIM(genre)
        
        $page_name = $genre;
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('genre',$genre)->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница лейбла
    public function label($label)
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = $label;
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('label',$label)->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Spinnin
    public function Spinnin()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = "SPINNIN' RECORDS";
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('label','Spinnin&#39; Remixes')->orWhere('label','SPRS')->orWhere('label','SPINNIN&#39; RECORDS')->orWhere('label',"SPINNIN&#39; DEEP")->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Spinnin
    public function AfraidOf138()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = "Who's Afraid Of 138?!";
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('label',"Who&#39;s Afraid Of 138?!")->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Indie Dance / Nu Disco
    public function IndieDanceNuDisco()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = 'Indie Dance / Nu Disco';
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('genre','Indie Dance / Nu Disco')->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Indie Dance / Nu Disco
    public function DrumBass()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = 'Drum&Bass';
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('genre','Drum &amp; Bass')->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Electronica / Downtempo
    public function ElectronicaDowntempo()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = 'Electronica / Downtempo';
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('genre','Electronica / Downtempo')->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Electronica / Downtempo
    public function HardcoreHardTechno()
    {
        //UPDATE tracks SET label=TRIM(label)
        $page_name = 'Hardcore / Hard Techno';
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('genre','Hardcore / Hard Techno')->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
        return view('genre', compact('tracks', 'page_name'));
    }
    
    //Страница Топ100
    public function top(Track $track)
    {
        //$toptracks = TopTrack::all();
        SEOMeta::setTitle('TOP100');
        SEOMeta::setKeywords(['lossless', 'download wav', 'beatport', 'download music', 'top 100']);
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
    
    //Страница стстистики
    public function analytics(User $User)
    {
        if (Auth::user()->type === 'admin') {
            $page_name = 'Analytics';
            $number_of_tracks = Track::where('track','!=',NULL)->count();
            $number_of_users = User::count();
            $checked_tracks = Track::where('track','!=',NULL)->where('inspection','!=',0)->count();
            return view('analytics', compact('page_name', 'number_of_tracks', 'checked_tracks', 'number_of_users'));
        }
        else {
            return redirect('/');
        }
    }
}

