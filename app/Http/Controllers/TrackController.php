<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track;
use App\User;
use App\TopTrack;
use Auth;
use DB;
use Response;
use Illuminate\Support\Facades\Input;
use Storage;
use File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\UploadedFile;

class TrackController extends Controller
{
    public function index()
    {
        return view('main');
    }
    
    public function ChooseUploadFile($id)
    {
        if (Auth::check()) {
            Auth::user()->name;
            $track = Track::find($id);
            //echo $track->title;
            return view('trackedit')->with('track', $track);
        }
        else {
            return redirect('/login');
        }
    }
    
    public function UploadFile(Request $request, Track $track, $id)
    {
        $track = Track::find($id);
        $track-> user_id = Auth::id();
        
        /*$file = $request -> song;
        $coverfilename = $request['name'].'.jpg';
        $track -> track = $coverfilename;
        Storage::disk('local')->put($coverfilename, File::get($file));
        $track->save();*/
        $trackfile = $request->file('track');
        $trackname = $track->artist.'- '.$track->title.'('.' '.$track->remixer.' '.')'.'.wav';
        $track -> track = $trackname;
            Storage::disk('local')->put($trackname, File::get($trackfile));
        $track->save();
        $user = Auth::user();
        $user->points += 5;
        $user->save();
        
        return redirect('/');
    }
    
    public function create(Request $request, Track $track, User $user)
    {
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
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        return view('parser')->with('track', $track);
    }
    
    public function TopTrack(Track $track, TopTrack $topTrack)
    {
        $beat = 'https://www.beatport.com/top-100';
        $html = new \Htmldom($beat);
        //DB::table('top_tracks')->delete();
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
            /*$track = Track::where('number','=',$number);
            $track -> 'top' = $top100;*/
        };
        /*$release=$html->find('li.interior-track-released span.value', 0)->plaintext;
        $bpm=$html->find('li.interior-track-bpm span.value', 0)->plaintext;
        $key=$html->find('li.interior-track-key span.value', 0)->plaintext;
        $genre=$html->find('li.interior-track-genre span.value', 0)->plaintext;
        $label=$html->find('li.interior-track-labels span.value', 0)->plaintext;
        $img=$html->find('img.interior-track-release-artwork', 0)->getAttribute('src');;
        $number=$html->find('button.playable-play',0)->getAttribute('data-track');
        $audio_link="https://geo-samples.beatport.com/lofi/$number.LOFI.mp3";*/
        
    }
    
    public function destroy($id)
    {
        $track = Track::findOrFail($id);
        $track->delete();
        return redirect('/');
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
            $pathToFile = storage_path('app/tracks/'.$trackname);
            $user->points -= 1;
            $user->save();
            return response()->download($pathToFile);
        }
        else {
            echo 'You have not enough points';
        }
        }
        else {
            return redirect('/login');
        }
    }
    
    public function ParseNewTrack(Request $request)
    {
        return view('parsetrack');
    }
    
    public function ShowNewTrack(Request $request)
    {
        $html = $request->input('html');
        return view('showtrack');
    }
}
