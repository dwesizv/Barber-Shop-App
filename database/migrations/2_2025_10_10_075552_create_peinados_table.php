<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('peinado', function (Blueprint $table) {
            $table->id();
            $table->string('author', 60);
            $table->string('name', 100)->unique();
            $table->foreignId('idpelo'); //$table->string('hair', 110);
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('image', 100)->unique()->nullable();
            $table->foreignId('iduser');
            $table->timestamps();
            $table->unique(['author', 'price']);
            $table->foreign('idpelo')->references('id')->on('pelo');
            $table->foreign('iduser')->references('id')->on('users');
        });
    }

    public function down(): void {
        Schema::dropIfExists('peinado');
    }
};