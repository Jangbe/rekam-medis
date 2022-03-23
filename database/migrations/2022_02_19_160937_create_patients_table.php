<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->char('no_rm', 6);
            $table->string('name', 100);
            $table->date('birth');
            $table->string('mother_name');
            $table->string('father_name');
            $table->string('provincy', 50);
            $table->string('regency', 50);
            $table->string('district', 50);
            $table->string('village', 50);
            $table->text('address');
            $table->string('phone', 15);
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
        Schema::dropIfExists('patients');
    }
}
