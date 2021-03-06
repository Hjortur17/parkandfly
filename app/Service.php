<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

	public function bookings()
	{
		return $this->belongsToMany(Booking::class);
	}
}
