<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVotesQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votes_questions', function (Blueprint $table) {
            $table->integer('body')->change();
            $table->renameColumn('body', 'upvote');
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
        Schema::table('votes_questions', function (Blueprint $table) {
            $table->longText('upvote')->change();
            $table->renameColumn('upvote', 'body');
            $table->dropColumn('downvote');
        });
    }
}
