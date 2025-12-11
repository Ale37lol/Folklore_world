<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('deity_legend', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('deity_id');
            $table->unsignedBigInteger('legend_id');
            $table->string('role_in_legend')->nullable();
            $table->timestamps();
            
            $table->foreign('deity_id')->references('id')->on('deities')->onDelete('cascade');
            $table->foreign('legend_id')->references('id')->on('legends')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('deity_legend');
    }
};