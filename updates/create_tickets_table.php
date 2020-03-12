<?php

namespace AniketMagadum\Helpdesk\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('aniketmagadum_helpdesk_tickets', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('category_id')->unsigned();
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->morphs('createable');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aniketmagadum_helpdesk_tickets');
    }
}
