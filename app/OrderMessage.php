<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class OrderMessage extends Model
{
    protected $fillable = [
        'text',
        'owner_id',
        'order_id'
    ];
    public function owner(){
        return $this->belongsTo(User::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
