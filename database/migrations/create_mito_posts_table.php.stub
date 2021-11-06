<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mito_posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('slug')->nullable()->unique();
            $table->text('markdown')->nullable();
            $table->string('status')->default('draft');
            $table->string('custom_excerpt')->nullable();
            $table->json('meta')->nullable();
            $table->dateTime('published_at')->nullable();

            $table->nullableTimestamps();
        });
    }
};
