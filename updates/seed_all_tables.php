<?php

namespace AniketMagadum\Helpdesk\Updates;

use AniketMagadum\Helpdesk\Models\Category;
use AniketMagadum\Helpdesk\Models\Label;
use AniketMagadum\Helpdesk\Models\Ticket;
use Seeder;

class SeedAllTables extends Seeder
{
    public function run()
    {
        $category = Category::create([
            'name' => 'Uncategorized',
            'description' => 'Default category for tickets'
        ]);
        $label = Label::create([
            'name' => 'High Priority',
            'color' => '#d9350f'
        ]);

        $label = Label::create([
            'name' => 'Low Priority',
            'color' => '#f1c40f'
        ]);

        $ticket = Ticket::create([
            'title' => 'Sample Ticket',
            'description' => 'You may delete this ticket',
            'category_id' => $category->id
        ]);

        $ticket->labels()->add($label);
    }
}
