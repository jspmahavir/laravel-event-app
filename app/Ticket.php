<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];
    protected $table = 'tickets';

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

