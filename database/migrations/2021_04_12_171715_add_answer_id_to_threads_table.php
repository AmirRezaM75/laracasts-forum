<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnswerIdToThreadsTable extends Migration
{
    public function up()
    {
        Schema::table('threads', function (Blueprint $table) {
            $table->foreignId('answer_id')
                ->nullable()
                ->constrained('replies', 'id')
                ->nullOnDelete()
                ->after('category_id');
        });
    }


    public function down()
    {
        Schema::table('threads', function (Blueprint $table) {
            $table->dropColumn('answer_id');
        });
    }
}
