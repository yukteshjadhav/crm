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
        Schema::create('lead_profile_changes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lead_id')->index();
            $table->unsignedBigInteger('lead_from')->index();
            $table->unsignedBigInteger('lead_f_status_id')->index()->nullable();
            $table->unsignedBigInteger('lead_to')->index();
            $table->unsignedBigInteger('lead_t_status_id')->index()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('cascade');
            $table->foreign('lead_from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lead_f_status_id')->references('id')->on('lead_statuses')->onDelete('cascade');
            $table->foreign('lead_to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lead_t_status_id')->references('id')->on('lead_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_profile_changes');
    }
};
