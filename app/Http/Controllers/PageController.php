<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;
use App\Track;
use App\TopTrack;
use App\CustomTrack;
use App\SoundcloudTrack;
use SEOMeta;
use OpenGraph;
use Twitter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
	
	//Главная страница
    public function AllCustomTracks(CustomTrack $customtrack)
    {
        //$page_name = 'Custom tracks';
        //$tracks = Track::where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->paginate(12);
        $customtracks = CustomTrack::All();
		$image = Storage::disk('public')->url('c_44.jpg');
		return view('custom.alltracks', compact('customtracks', 'image'));
    }
    
    //Страница информации
    public function about()
    {
        SEOMeta::setTitle('About Us');
        return view('about');
    }
    
    //Страница жанра
    public function genre($genre)
    {
        //UPDATE tracks SET genre=TRIM(genre)
        if ($genre=='funk-soul-disco') {
                        $page_name='Funk / Soul / Disco';
        }
        elseif ($genre=='indiedance-nudisco') {
                        $page_name='Indie Dance / Nu Disco';
        }
        elseif ($genre=='deep-house') {
                        $page_name='Deep House';
        }
        elseif ($genre=='tech-house') {
                        $page_name='Tech House';
        }
        elseif ($genre=='big-room') {
                        $page_name='Big Room';
        }
        elseif ($genre=='house') {
                        $page_name='House';
        }
        elseif ($genre=='techno') {
                        $page_name='Techno';
        }
        elseif ($genre=='psy-trance') {
                        $page_name='Psy-Trance';
        }
        elseif ($genre=='future-house') {
                        $page_name='Future House';
        }
        elseif ($genre=='drumnbass') {
                        $page_name='Drum &amp; Bass';
        }
        elseif ($genre=='electro-house') {
                        $page_name='Electro House';
        }
        elseif ($genre=='dance') {
                        $page_name='Dance';
        }
        elseif ($genre=='hiphop') {
                        $page_name='Hip-Hop';
        }
        elseif ($genre=='trance') {
                        $page_name='Trance';
        }
        elseif ($genre=='minimal') {
                        $page_name='Minimal';
        }
        elseif ($genre=='electronica-downtempo') {
                        $page_name='Electronica / Downtempo';
        }
        elseif ($genre=='trap') {
                        $page_name='Trap';
        }
        elseif ($genre=='progressive-house') {
                        $page_name='Progressive House';
        }
        elseif ($genre=='dubstep') {
                        $page_name='Dubstep';
        }
        elseif ($genre=='hard-dance') {
                        $page_name='Hard Dance';
        }
        elseif ($genre=='funk-rnb') {
                        $page_name='Funk / R&amp;B';
        }
        elseif ($genre=='breaks') {
                        $page_name='Breaks';
        }
        elseif ($genre=='glitch-hop') {
                        $page_name='Glitch Hop';
        }
        elseif ($genre=='dubstep') {
                        $page_name='Dubstep';
        }
        elseif ($genre=='hardcore-hardtechno') {
                        $page_name='Hardcore / Hard Techno';
        }
        elseif ($genre=='funk-soul-disco') {
                        $page_name='Funk / Soul / Disco';
        }
        elseif ($genre=='reggae-dancehall-dub-dancehall') {
                        $page_name='Reggae / Dancehall / Dub';
        }
        elseif ($genre=='funky-groove-jackin-house') {
                        $page_name='Funky / Groove / Jackin&#39; House';
        }
        SEOMeta::setTitle($page_name);
        $tracks = Track::where('genre_alias',$genre)->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(24);
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
			$date = $toptrack -> updated_at;
			if ($date < '2017-11-27 01:23:30') {
				$track_id = $toptrack -> id;
				$html = new \Htmldom('https://www.beatport.com/track/track/'.$track_id);
				$img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');
				$track = Track::where('top_track_id','=', $track_id)->first();
				$track -> cover = $img;
				$track->save();
				//echo $track -> cover;
				//$track->save();
			}
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
    
    /*//Страница стстистики
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
	
	//Страница с вводом ссылки для парсера
    public function arparts(Request $request)
    {
        return view('inputarparser');
    }

	//Создать трек через Add Track
    public function arpartsParser(Request $request)
    {
        if (Auth::user()->type === 'admin') {
            $beat = $request['html'];
            $v = Validator::make($request->all(), [
                "html" => "required|url"
            ]);
            if ($v->fails()) {
                $error = 'INVALID URL';
				return view('errors.validate', compact('error'));
            }
            else {
                $html = new \Htmldom($beat);

                $title=$html->find('div.infoBlock h1', 0)->innertext;
				$models=$html->find('div.brands div', 0)->plaintext;
                //$remixer=$html->find('div.interior-title h1.remixed', 0)->plaintext;
                /*foreach($html->find('div.interior-track-artists a') as $artist) {
                    $artist = $artist->innertext.' ';
                }*/
                /*$artist = $html->find('div.interior-track-artists a', 0)->innertext;
                $release=$html->find('li.interior-track-released span.value', 0)->plaintext;
                $bpm=$html->find('li.interior-track-bpm span.value', 0)->plaintext;
                $key=$html->find('li.interior-track-key span.value', 0)->plaintext;
                $genre=$html->find('li.interior-track-genre span.value', 0)->plaintext;
                $label=$html->find('li.interior-track-labels span.value', 0)->plaintext;
                $new_label = trim($label);
                $img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');
                $number=$html->find('button.playable-play',0)->getAttribute('data-track');
                $audio_link="https://geo-samples.beatport.com/lofi/$number.LOFI.mp3";
                DB::statement('SET FOREIGN_KEY_CHECKS=0');
                $row = Track::where('top_track_id','=',$number)->count();
                echo $title, $models;
            }
        }
        else {
            return redirect('/login');
        }
    }*/
}