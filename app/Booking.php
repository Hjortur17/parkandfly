<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
	protected $guarded = [];
	
	protected $table = 'booking';

	public function services()
	{
		return $this->belongsToMany(Service::class);
	}
}
