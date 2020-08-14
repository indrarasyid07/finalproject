<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVotesAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votes_answers', function (Blueprint $table) {
            $table->renameColumn('vote','upvote');
            $table->integer('downvote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('votes_answers', function (Blueprint $table) {
            $table->renameColumn('upvote','vote');
            $table->dropColumn('downvote');
        });
    }
}
