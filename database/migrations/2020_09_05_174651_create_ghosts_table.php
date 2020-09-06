<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGhostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ghosts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('ghost_id')->unique('UNQ_GHOST_ID')->comment('幽霊屋敷のユーザーID');
            $table->unsignedBigInteger('gold')->default(9000)->comment('サーバー内通貨(みつは)');
            $table->boolean('del_flg')->comment('削除フラグ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ghosts');
    }
}
