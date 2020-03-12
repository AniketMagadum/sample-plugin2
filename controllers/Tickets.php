<?php

namespace AniketMagadum\Helpdesk\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;
use AniketMagadum\Helpdesk\Models\Ticket;

/**
 * Tickets Back-end Controller
 */
class Tickets extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.RelationController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('AniketMagadum.Helpdesk', 'helpdesk', 'tickets');
    }

    /**
     * Deleted checked tickets.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $ticketId) {
                if (!$ticket = Ticket::find($ticketId)) continue;
                $ticket->delete();
            }

            Flash::success(Lang::get('aniketmagadum.helpdesk::lang.tickets.delete_selected_success'));
        } else {
            Flash::error(Lang::get('aniketmagadum.helpdesk::lang.tickets.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
