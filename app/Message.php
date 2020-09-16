<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Message extends Model
{
   use Sluggable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content','slug'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['cover_image', 'user_id'];

    public function user()
    {

        return $this->belongsTo('App\User');
    }

    public function sluggable() {
       return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }
     /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
}
