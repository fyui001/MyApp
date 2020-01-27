<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoumnShikoListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shiko_list', function (Blueprint $table) {
            $table->integer('voice_actor_flg')->default(0)->after('shiko_list');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shiko_list', function (Blueprint $table) {
            //
        });
    }
}
