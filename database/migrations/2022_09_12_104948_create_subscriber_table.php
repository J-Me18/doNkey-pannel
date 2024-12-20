<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriber', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('subscriptionDate');
            $table->string('email');
            $table->string('mobile');
            $table->string('pincode');
            $table->string('aadharNo');
            $table->string('aadharImage');
            $table->string('pancardImage');
            $table->string('customerdocument');
            $table->string('account_type');
            $table->string('blockedstatus')->comment('1-unblocked,0-blocked');
            $table->string('image');
            $table->string('created_by');

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
        Schema::dropIfExists('subscriber');
    }
}