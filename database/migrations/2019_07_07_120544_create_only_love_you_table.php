<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnlyLoveYouTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('only_love_you', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('User', '255');
            $table->string('Content', '128');
            $table->string('Love', '128');
            $table->date('create_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('only_love_you');
    }
}
