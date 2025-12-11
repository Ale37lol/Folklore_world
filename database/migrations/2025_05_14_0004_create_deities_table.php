<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('role')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('culture_id');
            $table->unsignedBigInteger('myth_class_id');
            $table->timestamps();
            
            $table->foreign('culture_id')->references('id')->on('cultures');
            $table->foreign('myth_class_id')->references('id')->on('myth_classes');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deities');
    }
};