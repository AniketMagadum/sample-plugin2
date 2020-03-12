<?php

namespace AniketMagadum\Helpdesk\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateLabelTicketTable extends Migration
{
    public function up()
    {
        Schema::create('aniketmagadum_helpdesk_label_ticket', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('ticket_id')->unsigned();
            $table->integer('label_id')->unsigned();
            $table->primary(['ticket_id', 'label_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('aniketmagadum_helpdesk_label_ticket');
    }
}
