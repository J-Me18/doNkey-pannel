<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcelPincodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excel_pincodes', function (Blueprint $table) {
            $table->id();
            $table->string('circlename');
            $table->string('regionname');
            $table->string('district');
            $table->string('pincode');
            $table->string('statename');
            $table->string('tier');
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
        Schema::dropIfExists('excel_pincodes');
    }
}
