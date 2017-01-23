<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track;
use App\User;
use App\TopTrack;
use App\WrongTracks;
use Auth;
use DB;
//use Response;
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

class TrackController extends Controller
{
    public function index($id)
    {
        if (Auth::check()) {
            $track = Track::find($id);
            $label = $track -> label;
            $number = $track -> top_track_id;
            $tracks = Track::where('label','!=',$label)->where('track','!=',NULL)->where('top_track_id','!=',$number)->orderBy('updated_at', 'desc')->paginate(4);
            $labeltracks = Track::where('label','=',$label)->where('top_track_id','!=',$number)->where('track','!=',NULL)->orderBy('updated_at', 'desc')->paginate(4);
            return view('track', compact('track', 'tracks'))->with('labeltracks', $labeltracks);
        }
        else {
            return redirect('/login');
        }
    }
    
    public function newtracks()
    {
        if (Auth::check()) {
            $tracks = Track::where('track','!=',NULL)->orderBy('updated_at', 'desc')->simplePaginate(25);
            return view('newtracks', compact('tracks'));
        }
        else {
            return redirect('/login');
        }
    }
    
    public function ChooseUploadFile($id)
    {
        if (Auth::check()) {
            Auth::user()->name;
            $track = Track::find($id);
            //echo $track->title;
            return view('uploadtrack')->with('track', $track);
        }
        else {
            return redirect('/login');
        }
    }
    
    public function UploadFile(Request $request, Track $track, $id)
    {
        if (Auth::check()) {
            $track = Track::find($id);
            $track-> user_id = Auth::id();
            
            /*$file = $request -> song;
            $coverfilename = $request['name'].'.jpg';
            $track -> track = $coverfilename;
            Storage::disk('local')->put($coverfilename, File::get($file));
            $track->save();*/
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
                flash('Track was uploaded!', 'success');
                $artist = $track->artist;
                //$artist = preg_replace("/ /","_",$artist);
                $trackname = $track->artist.'- '.$track->title.' '.'('.$track->remixer.')'.'.wav';
                //$trackname = preg_replace("/ /","_",$trackname);
                $track -> track = $trackname;
                    Storage::disk('s3')->put($trackname, File::get($trackfile), 'public');
                $track->save();
                $user = Auth::user();
                $user->points += 5;
                $user->save();
                return redirect()->back();
            }
        }
        else {
            return redirect('/login');
        }
        
    }
    
    public function create(Request $request, Track $track, User $user)
    {
        if (Auth::check()) {
            $beat = $request['html'];
            $html = new \Htmldom($beat);
            //$track = new Track;

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
            $number=$html->find('button.playable-play',0)->getAttribute('data-track');
            //$track = Track::find($id);
            $audio_link="https://geo-samples.beatport.com/lofi/$number.LOFI.mp3";
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            $row = Track::where('top_track_id','=',$number)->count();
            if ($row === 0) {
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
                                    'preview' => $audio_link,
                                    /*'link' => $beat*/]);
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            $track = Track::where('top_track_id','=',$number)->first();
            $tracks = Track::where('label','!=',$label)->where('track','!=',NULL)->where('top_track_id','!=',$number)->orderBy('updated_at', 'desc')->paginate(4);
            $labeltracks = Track::where('label','=',$label)->where('top_track_id','!=',$number)->where('track','!=',NULL)->orderBy('updated_at', 'desc')->paginate(4);
            return view('track', compact('track', 'tracks'))->with('labeltracks', $labeltracks);
            //return view('track')->with('track', $track); 
            }
            else {
                $track = Track::where('top_track_id',$number)->first();
                $label = $track -> label;
                $number = $track -> top_track_id;
                $tracks = Track::where('label','!=',$label)->where('track','!=',NULL)->where('top_track_id','!=',$number)->orderBy('updated_at', 'desc')->paginate(4);
                $labeltracks = Track::where('label','=',$label)->where('top_track_id','!=',$number)->where('track','!=',NULL)->orderBy('updated_at', 'desc')->paginate(4);
                return view('track', compact('track', 'tracks'))->with('labeltracks', $labeltracks);
            }
        }
        else {
            return redirect('/login');
        }
    }
    
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
    
    public function destroy($id)
    {
        $track = Track::findOrFail($id);
        $track->delete();
        return redirect('/');
    }
    
    public function wrong($id, WrongTracks $wrongTrack)
    {
        if (Auth::check()) {
            flash('Track was marked as a wrong track!', 'warning');
            $track = Track::find($id);
            $title = $track->title;
            $number = $track->top_track_id ;
            $row = WrongTracks::where('id','=',$number)->count();
            if ($row === 0) {
            $wrongTracks = WrongTracks::create(['title' => $title,
                                    'id' => $number]);
            return redirect()->back();
            }
            else {
                return redirect()->back();
            }
        }
        else {
            return redirect('/login');
        }
        //return redirect('/');
    }
    
    public function deleteFile($id)
    {
        if (Auth::user()->type === 'admin') {
            flash('Track was deleted!', 'warning');
            $track = Track::find($id);
            $trackname = $track->track;
            Storage::disk('s3')->delete($trackname);
            $track-> user_id = null;
            $track-> track = null;
            $track->save();
            return redirect()->back();
        }
        else {
            return redirect()->back();
        }
        //return redirect('/');
    }
    
    public function acceptTrack($id)
    {
        if (Auth::user()->type === 'admin') {
            flash('Track was accepted!', 'success');
            $track = Track::find($id);
            $track-> inspection = 1;
            $track->save();
            return redirect()->back();
        }
        else {
            return redirect()->back();
        }
        //return redirect('/');
    }
    
    public function download($id)
    {
        if (Auth::check()) {
        $user = Auth::user();
        //$points = $user->points;
        if ($user->points >= 1) {
            $track = Track::findOrFail($id);
            $trackname = $track->track;
            //$filePath = 'app/tracks/';
            //$image = Storage::disk('rackspace')->get($trackname);
            //$pathToFile = Storage::url($trackname);
            $url = Storage::disk('s3')->url($trackname);
            $user->points -= 1;
            $user->save();
            $tempTrack = tempnam(sys_get_temp_dir(), $trackname);
            copy($url, $tempTrack);
            return response()->download($tempTrack, $trackname);
            //return $url;
            //return (new Response($file, 200))
            //  ->header('Content-Type', '.wav');
            
            //return response()->download($file, '1.wav', $headers);
        }
        else {
            //$tracks = Track::where('track','=',NULL)->orderBy('created_at', 'desc')->simplePaginate(15);
            return redirect('/earnpoints')->with('flash_message', "You don't have enough points")/*view('earnpoints', compact('tracks'))*/;
        }
        }
        else {
            return redirect('/login');
        }
    }
    
    public function earnpoints() {
        if (Auth::check()) {
            $tracks = Track::where('track','=',NULL)->orderBy('created_at', 'desc')->simplePaginate(15);
            return view('earnpoints', compact('tracks'));
        }
        else {
            return redirect('/login');
        }
    }
    
    public function ParseNewTrack(Request $request)
    {
        return view('inputparser');
    }
    
    /*public function ShowNewTrack(Request $request)
    {
        $html = $request->input('html');
        return view('showtrack');
    }*/
}
