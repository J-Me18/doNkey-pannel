<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('profile');
            $table->string('emp_id')->unique();
            $table->string('email')->unique();
            $table->string('official_mail');
            $table->string('mobile');
            $table->string('official_mobile');
            $table->string('gender');
            $table->string('other');
            $table->string('education');
            $table->string('blood_group');
            $table->string('address');
            $table->string('current_address');
            $table->string('aadhar');
            $table->string('pan');
            $table->string('joining_date');
            $table->string('payment');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
