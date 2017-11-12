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
		if (Auth::check()) {
			$page_name = 'Soundcloud Tracks';
			$soundcloudtracks = SoundcloudTrack::where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->simplePaginate(12);
			return view('soundcloud.alltracks', compact('soundcloudtracks', 'page_name'));
		}
        else {
            return redirect('/login');
        }
    }
	
	//Страница трекам
    public function TrackPage($id)
    {
		// Доступ к треку, который создал, для проверки его состояния
		$soundcloudtrack = SoundcloudTrack::find($id);
		return view('soundcloud.track', compact('soundcloudtrack'));
    }
	
	
	//Страница редактирования трека
    public function EditTrack($id)
    {
		if (Auth::user()->type === 'admin') {
			$soundcloudtrack = SoundcloudTrack::find($id);
			return view('soundcloud.edittrack', compact('soundcloudtrack'));
		}
		else {
			redirect ('/');
		}
    }
	
	//Страница редактирования трека
    public function update($id, Request $request, SoundcloudTrack $soundcloudtrack)
    {
		if (Auth::user()->type === 'admin') {
			$soundcloudtrack = SoundcloudTrack::find($id);	
			$title = $request->input('title');
			$artist = $request->input('artist');
			$genre = $request->input('genre');
			$cover = $request->input('cover');
			$link = $request->input('link');
			$release = $request->input('release');
			$soundcloudtrack->title = $title;
			$soundcloudtrack->artist = $artist;
			$soundcloudtrack->genre = $genre;
			$soundcloudtrack->link = $link;
			$soundcloudtrack->release = $release;
			$soundcloudtrack->cover = $cover;
			$soundcloudtrack->save();
			return redirect ('/soundcloudtracks/'.$id);
		}
		else {
			redirect ('/');
		}
    }
	
	//Страница с вводом информации о треке
    public function InputSoundcloudParserLink()
    {
		return view('soundcloud.inputparserlink');
    }
	
	//Soundcloud парсер
	public function SoundcloudTrackCreate(Request $request, SoundcloudTrack $soundcloudtrack, User $user)
    {
		$user = Auth::user();
		$title = $request->input('title');
		$artist = $request->input('artist');
		$genre = $request->input('genre');
		$new_genre = $genre;
		$cover = "http://crossless.club/img/placeholder.jpg";
		$email = $request->input('email');
		$link = $request->input('link');
		$release = $request->input('release');
			if ($new_genre=='Funk / Soul / Disco') {
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
			elseif ($new_genre=="Drum'n'Bass") {
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
			elseif ($new_genre=='Funk') {
					$new_genre_alias='funk';
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
			elseif ($new_genre=="Hip-Hop / R'n'B") {
					$new_genre_alias='hiphop';
			}
			elseif ($new_genre=='Reggae / Dancehall / Dub') {
					$new_genre_alias='reggae-dancehall-dub-dancehall';
			}
			elseif ($new_genre=='Funky / Groove / Jackin House') {
					$new_genre_alias='funky-groove-jackin-house';
			}
		//$track = $request->input('track');
		//echo $title, $artist, $genre, $link /*$track*/;
		$v = Validator::make($request->all(), [
			"link" => "required|url"
		]);
		if ($v->fails()) {
			$error = 'INVALID URL';
			return view('errors.validate', compact('error'));
		}
		else {
			//echo $release;
			$track = SoundcloudTrack::create(['title' => $title, 
									'user_id' => $user->id,
									'artist' => $artist, 
									'cover' => $cover,
									'genre' => $genre,
								    'genre_alias' => $new_genre_alias,
									'email' => $email,
									'release' => $release,
									'link' => $link,]);
			$id = $track->id;
			return redirect ('/soundcloudtracks/'.$id);
		}
    }
	
	//Загрузка трека
    public function Upload(Request $request, SoundcloudTrack $soundcloudtrack,User $user, $id)
    {
        if (Auth::check()) {//настроить доступ к загрузке только тому, кто создал трек
            $soundcloudtrack = SoundcloudTrack::find($id);
            //$soundcloudtrack -> user_id = Auth::id();
            $soundcloudtrackfile = $request->file('track');
            $v = Validator::make($request->all(), [
                'track' => 'required|mimes:wav'
            ]);
            if ($v->fails())
            {
                $error = 'Your track is not in WAV format.';
                return view('errors.validate', ['error' => $error]);
            }
            else {
                flash('Track was uploaded! Your track would be published after checking and getting donate.', 'success');
                $number = 'c'.'_'.$soundcloudtrack->id.'.wav';
                Storage::disk('s3')->put($number, File::get($soundcloudtrackfile), 'public');
                $soundcloudtrack -> track = $number;
                $soundcloudtrack->save();
				return redirect ('/soundcloudtracks/'.$id);
            }
        }
        else {
            return redirect('/login');
        }
        
    }
	
	//Страница проверки треков
    public function CheckTracks()
    {
        if (Auth::user()->type === 'admin') {
            $tracks = SoundcloudTrack::where('track','!=',NULL)->where('inspection','==',0)->orderBy('updated_at', 'asc')->simplePaginate(25);
            return view('soundcloud.newtracks', compact('tracks'));
        }
        else {
            return redirect('/');
        }
    }
	
	//Скачать трек
    public function download($id, DownloadedTrack $downloadedtrack)
    {
        if (Auth::check()) {
			$user = Auth::user();
			$track = SoundcloudTrack::findOrFail($id);
			$trackname = $track->track;
			$number = 'c'.'_'.$track->id.'.wav';
			$track_user_id = $track -> user_id;
			$trackname = $track->track;
			$url = Storage::disk('s3')->url($trackname);
			$track->downloads +=1;
			$track->save();
			$downloadedtrack = DownloadedTrack::create([
									'title' => $track->title, 
									'user_id' => $user->id, 
									'track_id' => $track->id, 
									'artist' => $track->artist]);
			$tempTrack = tempnam(sys_get_temp_dir(), 'trackname');
			copy($url, $tempTrack);
			$track_title = $track->artist.' - '.$track->title.' '.'.wav';
			return response()->download($tempTrack, $track_title);
		}
        else {
            return redirect('/login');
        }
    }
	
	//Верефицировать трек
    public function acceptTrack($id, User $user, SoundcloudTrack $soundcloudtrack)
    {
        if (Auth::user()->type === 'admin') {
            flash('Track was accepted!', 'success');
            $track = SoundcloudTrack::find($id);
            $track -> inspection = 1;
            $track->save();
			return redirect()->back();
        }
        else {
            return redirect()->back();
        }
    }
	
}
