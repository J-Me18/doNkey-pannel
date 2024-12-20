<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');

            $table->string('email');
            $table->string('mobile');
            $table->string('pincode');
            $table->string('aadharNo');
            $table->string('aadharFrontImage');
            $table->string('aadharBackImage');
            $table->string('drivingLicence');
            $table->string('vehicleNo');
            $table->string('vehicleModelNo');
            $table->string('rcbook');
            $table->string('insurance');
            $table->string('licenceexpiry');
            $table->string('customerdocument');
            $table->string('bike');
            $table->integer('status');
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
        Schema::dropIfExists('driver');
    }
}