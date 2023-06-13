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
        Schema::table('profile_infos', function (Blueprint $table) {

            $table->unsignedBigInteger('user_id')->nullable()->after('id')->unique();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profile_infos', function (Blueprint $table) {
            
            $table->dropForeign('profile_infos_user_id_foreign');

            $table->dropColumn('user_id');
        });
    }
};
