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
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedSmallInteger('type_id')->nullable();
            $table->unsignedSmallInteger('priority_id')->required();
            $table->unsignedBigInteger('requester_user_id')->required();
            $table->unsignedBigInteger('assigened_user_id')->nullable();
            $table->string('name')->required();

            // id del complamentario para la descripcion
            $table->boolean('flag_status')->default(true); // True - abierto / False - cerrado

            $table->timestamps();
            $table->unsignedBigInteger('created_by')->index();
            $table->unsignedBigInteger('updated_by')->index();

            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');
            $table->foreign('priority_id')->references('id')->on('priorities');
            $table->foreign('requester_user_id')->references('id')->on('users');
            $table->foreign('assigened_user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
