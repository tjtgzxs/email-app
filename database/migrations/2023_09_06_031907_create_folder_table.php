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
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('email_id')->nullable();
            $table->string('folder')->nullable();
            $table->string('from')->nullable();
            $table->string('analyze')->nullable();
            $table->string('continue')->nullable();
            $table->string('to')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('email_id')->references('id')->on('emails')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folder');
    }
};
