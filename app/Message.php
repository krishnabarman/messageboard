<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','content'];

    /**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
protected $guarded = ['cover_image','user_id'];

    

    public function user(){

        return $this->belongsTo('App\User');

    }
}
