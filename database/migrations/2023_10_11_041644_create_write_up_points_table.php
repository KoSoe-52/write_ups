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
        Schema::create('write_up_points', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("write_up_id")->unsigned();
            $table->integer("point")->default(0);
            $table->foreign("write_up_id")->references("id")->on("write_ups");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('write_up_points');
    }
};
