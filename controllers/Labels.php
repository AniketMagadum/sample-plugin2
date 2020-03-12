<?php namespace AniketMagadum\Helpdesk\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;
use AniketMagadum\Helpdesk\Models\Label;

/**
 * Labels Back-end Controller
 */
class Labels extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('AniketMagadum.Helpdesk', 'helpdesk', 'labels');
    }

    /**
     * Deleted checked labels.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $labelId) {
                if (!$label = Label::find($labelId)) continue;
                $label->delete();
            }

            Flash::success(Lang::get('aniketmagadum.helpdesk::lang.labels.delete_selected_success'));
        }
        else {
            Flash::error(Lang::get('aniketmagadum.helpdesk::lang.labels.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
