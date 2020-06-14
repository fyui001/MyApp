<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeOnlyLoveYouTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('only_love_you', function (Blueprint $table) {
            $table->renameColumn('User', 'user');
            $table->renameColumn('Content', 'content');
            $table->renameColumn('Love', 'love');
            $table->renameColumn('Guild', 'guild');
            $table->renameColumn('create_at', 'created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('only_love_you', function (Blueprint $table) {
            //
        });
    }
}
