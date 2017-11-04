<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomTrack extends Model
{
    protected $fillable = ['id', 'downloads', 'title', 'user_id', 'artist', 'genre', 'genre_alias', 'bpm', 'key', 'cover', 'release', 'preview', 'label', 'track', 'link'];
    
    public function by(User $user) {
            $this->user_id = $user->id;
        }
}
