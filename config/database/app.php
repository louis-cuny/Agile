<?php

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

Manager::schema()->create('appeloffre', function (Blueprint $table) {
    $table->increments('id');
    $table->unsignedInteger('user_id');
    $table->string('intitule')->unique();
    $table->string('commanditaire');
    $table->string('adresse')->nullable();
    $table->string('ville')->nullable();
    $table->string('email')->nullable();
    $table->string('tel')->nullable();
    $table->string('mission')->nullable();
    $table->integer('budget')->nullable();
    $table->string('datelimitecandidature')->nullable();
    $table->foreign('user_id')->references('id')->on('user');
    $table->timestamps();
});
