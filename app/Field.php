<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{

    protected $guarded = [];

    public function subscribers()
    {
      return $this->belongsTo(Subscriber::class);
    }
}
