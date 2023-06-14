<?php

use App\Models\Sponsorship;
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
        Schema::create('profile_info_sponsorship', function (Blueprint $table) {
            $table->unsignedBigInteger('profile_info_id');
            $table->unsignedBigInteger('sponsorship_id');
            
            //OLD
            $table->timestamp('start_date')->useCurrent();
            $table->datetime('end_date');   

            //TRY
            // $sponsorship = Sponsorship::find($name);
            // $created_at = $sponsorship->created_at;
            // $expires_at = $created_at->copy()->addHours($sponsorship->duration);
            //

            $table->foreign('profile_info_id')->references('id')->on('profile_infos')->onDelete('cascade');
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
        Schema::dropIfExists('profile_info_sponsorship');
    }
};
