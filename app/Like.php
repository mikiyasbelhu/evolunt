<?php

namespace evolunt;


use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $table = 'likeable';

    protected $fillable = [
        'likeable_type',
        'user_id'
    ];
    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('evolunt\User','user_id');
    }
}
