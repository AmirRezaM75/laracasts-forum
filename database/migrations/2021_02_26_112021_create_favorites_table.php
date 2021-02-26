<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{

    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->morphs('favoritable');
            /*
            $table->unsignedInteger('favorited_id');
            $table->string('favorited_type');
            */
            $table->timestamps();

            $table->unique(['user_id', 'favoritable_id', 'favoritable_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}
