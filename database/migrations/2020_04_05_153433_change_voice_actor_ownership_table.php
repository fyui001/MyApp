<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeVoiceActorOwnershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voice_actor_ownership', function (Blueprint $table) {
            $table->renameColumn('UserName', 'user');
            $table->renameColumn('Content', 'content');
            $table->renameColumn('ClaimOwnership', 'claim_ownership');
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
        Schema::table('voice_actor_ownership', function (Blueprint $table) {
            //
        });
    }
}
