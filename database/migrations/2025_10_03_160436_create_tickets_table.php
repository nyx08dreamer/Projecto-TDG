<?php

namespace Coderflex\LaravelTicket\Database\Factories;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $tableName = config('laravel_ticket.table_names.tickets', 'tickets');

        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();
            $table->foreignId('user_id');
            $table->string('title');
            $table->string('message')->nullable();
            
            $table->unsignedSmallInteger('type_id')->nullable();
            $table->unsignedSmallInteger('priority_id')->required();
            
            $table->string('status')->default('open');
            $table->boolean('is_resolved')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');
            $table->foreign('priority_id')->references('id')->on('priorities');
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
