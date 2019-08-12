<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	public function bookings()
	{
		return $this->belongsToMany(Booking::class);
	}
}
