<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legends', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('culture_id');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
            
            $table->foreign('culture_id')->references('id')->on('cultures');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legends');
    }
};