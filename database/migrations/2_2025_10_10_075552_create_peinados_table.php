<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peinado', function (Blueprint $table) {
            $table->id();
            $table->string('author', 60);
            $table->string('name', 100)->unique();
            //$table->string('hair', 110);
            $table->foreignId('idpelo');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('image', 100)->unique()->nullable();
            $table->timestamps();
            $table->unique(['author', 'price']);
            $table->foreign('idpelo')->references('id')->on('pelo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peinado');
    }
};
