<?php

namespace evolunt;


use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifiable';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'friend_id',
        'notifiable_type',
        'notifiable_id'

    ];

    public function user()
    {
        return $this->belongsTo('evolunt\User', 'user_id');
    }



}
