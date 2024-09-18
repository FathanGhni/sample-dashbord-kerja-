<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fathans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longtext('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

};
