<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_spec', function (Blueprint $table) {
            $table->unsignedBigInteger('detail_id');
            $table->unsignedBigInteger('spec_id');

            $table->foreign('detail_id')->references('id')->on('details')->onDelete('cascade');
            $table->foreign('spec_id')->references('id')->on('specs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_spec');
    }
};
