<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('booking', function (Blueprint $table) {
    		$table->bigIncrements('id');

    		$table->string('carNumber');
    		$table->string('carSize');
    		$table->string('carMake');
    		$table->string('carType');
    		$table->string('carColor');

    		$table->string('socialId');
    		$table->string('name');
    		$table->string('email');
    		$table->string('phone');

    		$table->string('dropOffDate');
    		$table->string('dropOffTime');
    		$table->string('pickUpDate');
    		$table->string('pickUpTime');

    		$table->string('flightNumber');
    		$table->string('flightTime')->nullable();

    		$table->string('numberOfDays');
    		$table->smallInteger('priceForDays');

    		$table->mediumInteger('paidPrice');

    		$table->string('korta_authcode')->nullable();

            $table->integer('step')->nullable();

            $table->dateTime('reservation_date')->nullable();
            $table->dateTime('confirmation_date')->nullable();
            $table->dateTime('token_expaire_date')->nullable();

            $table->string('booking_ref', 13)->nullable();
            $table->string('token_korta', 13)->nullable();

    		$table->timestamps();
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('booking');
    }
}
