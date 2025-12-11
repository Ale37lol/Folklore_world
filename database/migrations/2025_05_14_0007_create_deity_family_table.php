<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('deity_families', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('child_id');
            $table->string('relationship_type');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('deities')->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('deities')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('deity_families');
    }
};