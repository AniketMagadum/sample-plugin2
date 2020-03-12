<?php

namespace AniketMagadum\Helpdesk\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('aniketmagadum_helpdesk_comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('ticket_id')->unsigned();
            $table->text('comment');
            $table->morphs('userable');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aniketmagadum_helpdesk_comments');
    }
}
