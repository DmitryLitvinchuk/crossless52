<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Track;
use App\User;
use App\TopTrack;
use App\WrongTracks;
use App\DownloadedTrack;
use App\CustomTrack;
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
use Illuminate\Http\Request;
use GrahamCampbell\Dropbox\Facades\Dropbox;

class TrackController extends Controller
{
    
    //Страница трека
    public function index($id)
    {
        if (Auth::check()) {
            $track = Track::find($id);
            $label = $track -> label;
            if ($label === 'Spinnin&#39; Remixes') {
                $link_label = 'label/spinnin';
            }
            elseif ($label === 'SPINNIN&#39; RECORDS') {
                $link_label = 'label/spinnin';
            }
            elseif ($label === 'SPRS') {
                $link_label = 'label/spinnin';
            }
            elseif ($label === "SPINNIN&#39; DEEP") {
                $link_label = 'label/spinnin';
            }
            elseif ($label === "Who&#39;s Afraid Of 138?!") {
                $link_label = 'label/who-is-afraid-of-138';
            }
            else {
                $link_label = 'labels/'.$label;
            }
            $number = $track -> top_track_id;
			//parser #1
			$date = $track -> updated_at;
			if ($date < '2017-11-27 01:23:30') {
				$track_id = $track -> top_track_id;
				$html = new \Htmldom('https://www.beatport.com/track/track/'.$track_id);
				$img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');
				$track -> cover = $img;
				$track->save();
			}
			//parser #1
            SEOMeta::setTitle($track->artist.' - '.$track->title);
            SEOMeta::setKeywords([$track->artist,$track->title,$track->remixer,$track->genre,$track->label,'lossless', 'download wav', 'beatport', 'download music', 'top 100']);
            OpenGraph::addImage(['url' => $track->cover, 'size' => 300]);
            OpenGraph::setTitle('FREE DOWNLOAD WAV'.' | '.$track->artist.'- '.$track->title);
            OpenGraph::setUrl('http://crossless.club/tracks/'.$track->id);
            $tracks = Track::where('label','!=',$label)->where('track','!=',NULL)->where('top_track_id','!=',$number)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->paginate(4);
            $labeltracks = Track::where('label','=',$label)->where('top_track_id','!=',$number)->where('track','!=',NULL)->where('inspection','!=',0)->orderBy('updated_at', 'desc')->paginate(4);
            return view('track', compact('track', 'tracks','link_label'))->with('labeltracks', $labeltracks);
        }
        else {
            return redirect('/login');
        }
    }
    
	
	//Обновить картинку и ссылку на аудиофайл
    public function UpdateImage($id, Track $Track)
    {
        if (Auth::user()->type === 'admin' or Auth::user()->type === 'checker') {
            flash('Image was updated!', 'success');
			//$track = Track::find($id);
			$track = Track::find($id)/*where('genre','!=','Breaks')*/;
			/*$track_id = $track -> top_track_id;
			$html = new \Htmldom('https://www.beatport.com/track/track/'.$track_id);
			$img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');
			$track -> cover = $img;
			$track->save();*/
			$track_id = $track -> top_track_id;
				$html = new \Htmldom('https://www.beatport.com/track/track/'.$track_id);
				$img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');
			 	$audio_link=$html->find('meta[name=twitter:player:stream]',0)->getAttribute('content');
				$track -> cover = $img;
				$track -> preview = $audio_link;
				$track->save();
			/*foreach($tracks as $track) {
				$track_id = $track -> top_track_id;
				$html = new \Htmldom('https://www.beatport.com/track/track/'.$track_id);
				$img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');
				$track -> cover = $img;
				$track->save();
				
			}*/
            return redirect()->back();
        }
        else {
            return redirect('/login');
        }
    }
	
	
    //Создать трек через Add Track
    public function create(Request $request, Track $track, User $user)
    {
        if (Auth::check()) {
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
					elseif ($new_genre=='Trap / Future Bass') {
							$new_genre_alias='trap-future-bass';
					}
					elseif ($new_genre=='Leftfield House &amp; Techno') {
							$new_genre_alias='letfield-house-techno';
					}
					elseif ($new_genre=='Leftfield Bass') {
							$new_genre_alias='letfield-bass';
					}
					elseif ($new_genre=='Minimal / Deep Tech') {
							$new_genre_alias='minimal-deep-tech';
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
					}
                $label=$html->find('li.interior-track-labels span.value', 0)->plaintext;
                $new_label = trim($label);
                $img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');
                $number=$html->find('button.playable-play',0)->getAttribute('data-track');
                //$audio_link="https://geo-samples.beatport.com/lofi/$number.LOFI.mp3";
                $audio_link=$html->find('meta[name=twitter:player:stream]',0)->getAttribute('content');
				DB::statement('SET FOREIGN_KEY_CHECKS=0');
                $row = Track::where('top_track_id','=',$number)->count();
                if ($row === 0) {
                   $track = Track::create(['title' => $title, 
                                        'user_id' => NULL, 
                                        'top_track_id' => $number, 
                                        'artist' => $artist, 
                                        'genre' => $new_genre,
										'genre_alias' => $new_genre_alias,
                                        'bpm' => $bpm, 
                                        'key' => $key, 
                                        'cover' => $img,
                                        'remixer' => $remixer,
                                        'label' => $new_label,
                                        'release' => $release, 
                                        'preview' => $audio_link,]);
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
                $id = $track -> id;
                return redirect('/tracks/'.$id);
                }
                else {
                    $track = Track::where('top_track_id',$number)->first();
                    $id = $track -> id;
                    return redirect('/tracks/'.$id);
                }
            }
        }
        else {
            return redirect('/login');
        }
    }
	
	//Страница добавления кастомного трека
	public function CreateCustomTrack()
	{
		return view('custom.create');
	}
	
	public function CustomTracksStore(Request $request)
	{
		//$input = Request::All();
		$user = Auth::user();
		$title = $request->input('title');
		$artist = $request->input('artist');
		//$trackfile = $request->file('track');
		$cover = $request->input('image');
		//$storagePath  = public_path();
		$v = Validator::make($request->all(), [
			'track' => 'required|mimes:wav'
		]);
			$track = CustomTrack::create(['title' => $title, 
										'user_id' => $user->id,
										'artist' => $artist, 
										'cover' => $cover,
										/*'genre' => $new_genre,
										'genre_alias' => $new_genre_alias,
										'bpm' => $bpm, 
										'key' => $key, 
										'cover' => $img,
										'remixer' => $remixer,
										'label' => $new_label,
										'release' => $release, 
										'preview' => $audio_link,*/]);

			if ($v->fails())
			{
				$error = 'Your track is not in WAV format.';
				return view('errors.validate', ['error' => $error]);
			}
			else {
				flash('Track was uploaded! You will get remaining points after checking.', 'success');
				$number = 'c'.'_'.$track->id;
				//Storage::disk('dropbox')->put($number.'.jpg', File::get($cover));
				//Storage::disk('public')->put($number.'.jpg', File::get($cover), 'public');
				//Storage::disk('s3')->put($number.'.wav', File::get($trackfile), 'public');
				//$track -> cover = $storagePath."\\".$number.'.jpg';
				$track->save();
				//$user = Auth::user();
				/*if (Auth::user()->accepted_tracks > 10) {
					$user->points += 1;
					$user->save();
					return redirect()->back();
				}
				else {
					return redirect()->back();
				}*/

			}
		
		return redirect('/customtracks');
	}
    
    //Страница с Top-100 Tracks
    public function TopTrack(Track $track, TopTrack $topTrack)
    {
        if (Auth::user()->type === 'admin') {
            flash('Top100 was refreshed');
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
            }
            return redirect('/top');
        }
        else {
            return redirect('/');
        }
    }
    
    
    //Страница с новыми треками
    public function newtracks()
    {
        SEOMeta::setTitle('New Tracks');
        SEOMeta::setKeywords(['lossless', 'download wav', 'beatport', 'download music', 'new tracks']);
        if (Auth::check()) {
            $tracks = Track::where('track','!=',NULL)->orderBy('updated_at', 'desc')->simplePaginate(10);
			foreach($tracks as $track) {
				$date = $track -> updated_at;
				if ($date < '2017-11-27 01:23:30') {
					$track_id = $track -> top_track_id;
					$html = new \Htmldom('https://www.beatport.com/track/track/'.$track_id);
					$img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');
					$track -> cover = $img;
					$track->save();
				}
				
			}
            return view('newtracks', compact('tracks'));
        }
        else {
            return redirect('/login');
        }
    }
    
    
    //Страница проверки треков
    public function checktracks()
    {
        if (Auth::user()->type === 'admin' or Auth::user()->type === 'checker') {
            $tracks = Track::where('track','!=',NULL)->where('inspection','==',0)->orderBy('updated_at', 'asc')->simplePaginate(25);
            return view('newtracks', compact('tracks'));
        }
        else {
            return redirect('/');
        }
    }
    
    
    //Страница неправильных треков
    public function wrongtracks(WrongTracks $wrongtrack)
    {
        if (Auth::user()->type === 'admin') {
            $tracks = Track::where('wrong','!=',0)->orderBy('updated_at', 'asc')->simplePaginate(25);
            return view('wrongtracks', compact('tracks'));
        }
        else {
            return redirect('/');
        }
    }
	
    
    
    //Выбрать трек для загрузки
    public function ChooseUploadFile($id)
    {
        if (Auth::check()) {
            Auth::user()->name;
            $track = Track::find($id);
            return view('uploadtrack')->with('track', $track);
        }
        else {
            return redirect('/login');
        }
    }
    
    
    //Загрузка трека
    public function UploadFile(Request $request, Track $track, $id)
    {
        if (Auth::check()) {
            $track = Track::find($id);
            $track-> user_id = Auth::id();
            $trackfile = $request->file('track');
            $v = Validator::make($request->all(), [
                'track' => 'required|mimes:wav'
            ]);
            if ($v->fails())
            {
                $error = 'Your track is not in WAV format.';
                return view('errors.validate', ['error' => $error]);
            }
            else {
                flash('Track was uploaded! You will get remaining points after checking.', 'success');
                $number = $track->top_track_id.'.wav';
                Storage::disk('s3')->put($number, File::get($trackfile), 'public');
                $track -> track = $number;
                $track->save();
                $user = Auth::user();
                if (Auth::user()->accepted_tracks > 10) {
                    $user->points += 1;
                    $user->save();
                    return redirect()->back();
                }
                else {
                    return redirect()->back();
                }
                
            }
        }
        else {
            return redirect('/login');
        }
        
    }
    
    /*public function destroy($id)
    {
        $track = Track::findOrFail($id);
        $track -> delete();
        return redirect('/');
    }*/
    
    
    //Отметить трек как неправильный
    public function wrong($id, WrongTracks $wrongTrack)
    {
        if (Auth::check()) {
            flash('Track was marked as a wrong track!', 'warning');
            $track = Track::find($id);
            if ($track->wrong === 0) {
                $track->wrong = 1;
                $track->save();
            return redirect()->back();
            }
            else {
                return redirect()->back();
            }
        }
        else {
            return redirect('/login');
        }
    }
    
    
    //Удалить трек
    public function deleteFile($id)
    {
        if (Auth::user()->type === 'admin' or Auth::user()->type === 'checker') {
            flash('Track was deleted!', 'warning');
            $track = Track::find($id);
            $trackname = $track->track;
            $current = Carbon::now();
            $newtrackname = '('.$current.')'.' '.$track->artist.' - '.$track->title.' '.$trackname;
            Storage::disk('s3')->move($trackname, 'deleted/'.$newtrackname);
            $user = User::find($track -> user_id);
            $user -> accepted_tracks = 0;
            $user->save();
            $track-> user_id = null;
            $track-> track = null;
            $track-> wrong = null;
            $track -> inspection = 0;
            $track->save();
            return redirect()->back();
        }
        else {
            return redirect()->back();
        }
    }
    
    
    //Верефицировать трек
    public function acceptTrack($id, User $user)
    {
        if (Auth::user()->type === 'admin' or Auth::user()->type === 'checker') {
            flash('Track was accepted!', 'success');
            $track = Track::find($id);
            $number = $track -> top_track_id;
            $track -> inspection = 1;
            $track -> wrong = 0;
            $track->save();
            $user = User::find($track->user_id);
            $release = $track -> release;
            $current_year = '2017-01-01';
            $last_year = '2016-01-01';
            if ($user -> accepted_tracks > 10) {
                $user -> accepted_tracks +=1;
                $row = TopTrack::where('id','=',$number)->count();
                if ($row !== 0) {
                    $user -> points += 5;
                    $user -> save();
                }
                elseif ($release <= $last_year) {
                    $user -> points += 1;
                    $user -> save();
                }
                elseif ($release <= $current_year) {
                    $user -> points += 3;
                    $user -> save();  
                }
                else {
                    $user -> points += 4;
                    $user -> save();
                }
                return redirect()->back(); 
            }
            else {
                $row = TopTrack::where('id','=',$number)->count();
                if ($row !== 0) {
                    $user -> accepted_tracks +=2;
                    $user -> points += 6;
                    $user -> save();
                }
                elseif ($release <= $last_year) {
                    $user -> accepted_tracks +=1;
                    $user -> points += 2;
                    $user -> save();
                }
                elseif ($release <= $current_year) {
                    $user -> accepted_tracks +=1;
                    $user -> points += 4;
                    $user -> save();  
                }
                else {
                    $user -> accepted_tracks +=2;
                    $user -> points += 5;
                    $user -> save();
                }
                return redirect()->back();
            }
        }
        else {
            return redirect()->back();
        }
    }
    
    
    //Переверифицировать трек
    public function reacceptTrack($id, User $user)
    {
        if (Auth::user()->type === 'admin') {
            flash('Track was accepted!', 'success');
            $track = Track::find($id);
            $track -> wrong = 0;
            $track->save();
            return redirect()->back();
        }
        else {
            return redirect()->back();
        }
    }
    
    
    //Скачать трек
    public function download($id, DownloadedTrack $downloadedtrack)
    {
        if (Auth::check()) {
        $user = Auth::user();
		if ($user -> type == 'admin' or $user -> type == 'checker') {
			$user -> points += 1;
		}
        if ($user->points >= 1) {
            $track = Track::findOrFail($id);
            $trackname = $track->track;
            $number = $track->top_track_id.'.wav';
            $track_user_id = $track -> user_id;
            if ($trackname !== $number) {  //Изменение названия файла, если оно не соответствует стандарту
                Storage::disk('s3')->move($trackname, $number);
                $track -> track = $number;
                $track -> user_id = $track_user_id;
                $track -> save();
                $trackname = $track->track;
                $url = Storage::disk('s3')->url($number);
                $user -> points -= 1;
                $user -> save();
                $track->downloads +=1;
                $track->save();
                $downloadedtrack = DownloadedTrack::create([
                                        'title' => $track->title, 
                                        'user_id' => $user->id, 
                                        'track_id' => $track->id, 
                                        'artist' => $track->artist]);
                $tempTrack = tempnam(sys_get_temp_dir(), 'trackname');
                copy($url, $tempTrack);
                $track_title = $track->artist.' - '.$track->title.' '.'('.$track->remixer.')'.'.wav';
                return response()->download($tempTrack, $track_title);
            }
            else {
                $trackname = $track->track;
                $url = Storage::disk('s3')->url($trackname);
                $user->points -= 1;
                $user->save();
                $track->downloads +=1;
                $track->save();
                $downloadedtrack = DownloadedTrack::create([
                                        'title' => $track->title, 
                                        'user_id' => $user->id, 
                                        'track_id' => $track->id, 
                                        'artist' => $track->artist]);
                $tempTrack = tempnam(sys_get_temp_dir(), 'trackname');
                copy($url, $tempTrack);
                $track_title = $track->artist.' - '.$track->title.' '.'('.$track->remixer.')'.'.wav';
                return response()->download($tempTrack, $track_title);
            }
        }
        else {
            return redirect('/earnpoints')->with('flash_message', "You don't have enough points");
        }
        }
        else {
            return redirect('/login');
        }
    }
    
    
    //Страница с треками, которые нужно загрузить
    public function earnpoints() {
        if (Auth::check()) {
            $tracks = Track::where('track','=',NULL)->orderBy('created_at', 'desc')->simplePaginate(15);
            return view('earnpoints', compact('tracks'));
        }
        else {
            return redirect('/login');
        }
    }
    
    
    //Страница с вводом ссылки для парсера
    public function ParseNewTrack(Request $request)
    {
        return view('inputparser');
    }
    
    //Изменения для трека
    /*public function changes($id)
    {
        if (Auth::check()) {
            if (Auth::user()->type === 'admin') {
                flash('Track was canged!', 'success');

                $track = Track::find($id);
                $label = $track -> label;
                $new_label = trim($label);
                $track -> label = $new_label;
                $track->save();
                return redirect()->back();
            }
            else {
                return redirect()->back();
            }
        }
        else {
            return redirect('/login');
        }
        
    }*/
    
    public function info($id)
    {
        if (Auth::check()) {
            if (Auth::user()->type === 'admin') {
                $track = Track::findOrFail($id);
                $trackname = $track->track;
                $url = Storage::disk('s3')->get($trackname);
                Flavy::info($url);
            }
            else {
                return redirect()->back();
            }
        }
        else {
            return redirect('/login');
        }
    }
}

