<?php

namespace AniketMagadum\Helpdesk\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateLabelsTable extends Migration
{
    public function up()
    {
        Schema::create('aniketmagadum_helpdesk_labels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('color');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aniketmagadum_helpdesk_labels');
    }
}
