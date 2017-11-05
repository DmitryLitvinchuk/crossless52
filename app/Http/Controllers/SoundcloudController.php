<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\WrongTracks;
use App\DownloadedTrack;
use App\SoundcloudTrack;
use Carbon\Carbon;
use Auth;
use Flavy;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use File;
use Flash;
use Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Response;
use SEOMeta;
use OpenGraph;
use Twitter;

class SoundcloudController extends Controller
{
	//Страница со всеми треками
    public function AllTracks(SoundcloudTrack $soundcloudtrack)
    {
		if (Auth::user()->type === 'admin') {
			//$page_name = 'Custom tracks';
			//$tracks = Track::where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->paginate(12);
			$soundcloudtracks = SoundcloudTrack::All();
			return view('soundcloud.alltracks', compact('soundcloudtracks'));
		}
		else {
			redirect ('/');
		}
    }
	
	//Страница трекам
    public function TrackPage($id)
    {
		if (Auth::user()->type === 'admin') {
			$soundcloudtrack = SoundcloudTrack::find($id);
			return view('soundcloud.track', compact('soundcloudtrack'));
		}
		else {
			redirect ('/');
		}
    }
	
	
	//Soundcloud парсер
	public function SoundcloudTrackCreate(Request $request, SoundcloudTrack $soundcloudtrack, User $user)
    {
		if (Auth::user()->type === 'admin') {
            $beat = $request['link'];
			//$beat = urlencode ($beat);
            $v = Validator::make($request->all(), [
                "link" => "required|url"
            ]);
            if ($v->fails()) {
                echo 'invalid url';
            }
            else {
                $html = new \Htmldom($beat);
                $title=$html->find('div.interior-title h1', 0)->plaintext;
                //$remixer=$html->find('div.interior-title h1.remixed', 0)->plaintext;
                /*foreach($html->find('div.interior-track-artists a') as $artist) {
                    $artist = $artist->innertext.' ';
                }*/
                	//$artist = $html->find('div.soundTitle__usernameHeroContainer a', 0)->innertext;
                	//$release=$html->find('dd.listenInfo__releaseData', 0)->plaintext;
                //$bpm=$html->find('li.interior-track-bpm span.value', 0)->plaintext;
                //$key=$html->find('li.interior-track-key span.value', 0)->plaintext;
                	//$genre=$html->find('span.sc-truncate', 0)->plaintext;
                //$new_genre = trim($genre);
					/*if ($new_genre=='Funk / Soul / Disco') {
							$new_genre_alias='funk-soul-disco';
					}
					elseif ($new_genre=='Indie Dance / Nu Disco') {
							$new_genre_alias='indiedance-nudisco';
					}
					elseif ($new_genre=='Deep House') {
							$new_genre_alias='deep-house';
					}
					elseif ($new_genre=='Tech House') {
							$new_genre_alias='tech-house';
					}
					elseif ($new_genre=='Big Room') {
							$new_genre_alias='big-room';
					}
					elseif ($new_genre=='House') {
							$new_genre_alias='house';
					}
					elseif ($new_genre=='Techno') {
							$new_genre_alias='techno';
					}
					elseif ($new_genre=='Psy-Trance') {
							$new_genre_alias='psy-trance';
					}
					elseif ($new_genre=='Future House') {
							$new_genre_alias='future-house';
					}
					elseif ($new_genre=='Drum &amp; Bass') {
							$new_genre_alias='drumnbass';
					}
					elseif ($new_genre=='Electro House') {
							$new_genre_alias='electro-house';
					}
					elseif ($new_genre=='Dance') {
							$new_genre_alias='dance';
					}
					elseif ($new_genre=='Hip-Hop') {
							$new_genre_alias='hiphop';
					}
					elseif ($new_genre=='Trance') {
							$new_genre_alias='trance';
					}
					elseif ($new_genre=='Minimal') {
							$new_genre_alias='minimal';
					}
					elseif ($new_genre=='Electronica / Downtempo') {
							$new_genre_alias='electronica-downtempo';
					}
					elseif ($new_genre=='Trap') {
							$new_genre_alias='trap';
					}
					elseif ($new_genre=='Progressive House') {
							$new_genre_alias='progressive-house';
					}
					elseif ($new_genre=='Dubstep') {
							$new_genre_alias='dubstep';
					}
					elseif ($new_genre=='Hard Dance') {
							$new_genre_alias='hard-dance';
					}
					elseif ($new_genre=='Funk / R&amp;B') {
							$new_genre_alias='funk-rnb';
					}
					elseif ($new_genre=='Breaks') {
							$new_genre_alias='breaks';
					}
					elseif ($new_genre=='Glitch Hop') {
							$new_genre_alias='glitch-hop';
					}
					elseif ($new_genre=='Dubstep') {
							$new_genre_alias='dubstep';
					}
					elseif ($new_genre=='Hardcore / Hard Techno') {
							$new_genre_alias='hardcore-hardtechno';
					}
					elseif ($new_genre=='Funk / Soul / Disco') {
							$new_genre_alias='funk-soul-disco';
					}
					elseif ($new_genre=='Hip-Hop / R&amp;B') {
							$new_genre_alias='hiphop';
					}
					elseif ($new_genre=='Reggae / Dancehall / Dub') {
							$new_genre_alias='reggae-dancehall-dub-dancehall';
					}
					elseif ($new_genre=='Funky / Groove / Jackin&#39; House') {
							$new_genre_alias='funky-groove-jackin-house';
					}*/
                //$label=$html->find('li.interior-track-labels span.value', 0)->plaintext;
                //$new_label = trim($label);
                	//$img=$html->find('div.image__lightOutline span', 0)->getAttribute('style');;
                //$number=$html->find('button.playable-play',0)->getAttribute('data-track');
                //$audio_link="https://geo-samples.beatport.com/lofi/$number.LOFI.mp3";
                //DB::statement('SET FOREIGN_KEY_CHECKS=0');
                //$row = Track::where('top_track_id','=',$number)->count();
				//echo $title, $artist, $release, $genre, $img;
			}
		}
		else {
			redirect ('/');
		}
    }
	
	//Страница с вводом ссылки для парсера
    public function InputSoundcloudParserLink()
    {
		if (Auth::user()->type === 'admin') {
        	return view('soundcloud.inputparserlink');
		}
		else {
			redirect ('/');
		}
    }
}
