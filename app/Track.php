<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = ['id', 'title','wrong' ,'user_id', 'top_track_id', 'number', 'artist', 'genre', 'bpm', 'key', 'cover', 'release', 'preview', 'label', 'remixer', 'track', 'link'];
    
    public function by(User $user) {
            $this->user_id = $user->id;
        }
    
    public function user() {
            return $this->belongsTo(User::class);
        }
        
    public function TopTrack() {
        return $this->belongsTo(TopTrack::class);
    }
}
