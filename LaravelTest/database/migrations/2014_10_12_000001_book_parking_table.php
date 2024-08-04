<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up():void {
        Schema::create('bookparking', function(Blueprint $table){
            $table->id();
            $table->string('uuuid')->unique()->foreign();
            $table->string('carplate');
            $table->dateTime('Start Time');
            $table->dateTime('End Time')->nullable();
            $table->timestamps();

        });
    }

    public function down():void{
        Schema::dropIfExists('bookparking');
    }
};