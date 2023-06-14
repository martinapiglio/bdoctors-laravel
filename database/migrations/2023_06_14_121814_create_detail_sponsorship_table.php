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
        Schema::create('detail_sponsorship', function (Blueprint $table) {
            $table->unsignedBigInteger('detail_id');
            $table->unsignedBigInteger('sponsorship_id');
            
            //OLD
            $table->timestamp('start_date')->useCurrent();
            $table->datetime('end_date');   

            //TRY
            // $sponsorship = Sponsorship::find($name);
            // $created_at = $sponsorship->created_at;
            // $expires_at = $created_at->copy()->addHours($sponsorship->duration);
            //

            $table->foreign('detail_id')->references('id')->on('details')->onDelete('cascade');
            $table->foreign('sponsorship_id')->references('id')->on('sponsorships')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_sponsorship');
    }
};
