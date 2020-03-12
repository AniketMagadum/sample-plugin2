<?php

namespace AniketMagadum\Helpdesk;

use AniketMagadum\Helpdesk\Models\Comment;
use Backend;
use Backend\Models\User as BackendUser;
use RainLab\User\Models\User;
use System\Classes\PluginBase;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

/**
 * Helpdesk Plugin Information File
 */
class Plugin extends PluginBase
{
    public $require = ['Rainlab.User'];
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'aniketmagadum.helpdesk::lang.plugin.name',
            'description' => 'aniketmagadum.helpdesk::lang.plugin.description',
            'author'      => 'AniketMagadum',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {
        app(EloquentFactory::class)->load(plugins_path('factories'));
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        User::extend(function ($model) {
            $model->morphOne = [
                'comment' =>  [
                    Comment::class, 'name' => 'userable'
                ],
            ];
        });

        BackendUser::extend(function ($model) {
            $model->morphOne = [
                'comment' =>  [
                    Comment::class, 'name' => 'userable'
                ],
            ];
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'AniketMagadum\Helpdesk\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'aniketmagadum.helpdesk.some_permission' => [
                'tab' => 'aniketmagadum.helpdesk::lang.plugin.name',
                'label' => 'aniketmagadum.helpdesk::lang.permissions.some_permission'
            ],
        ];
    }


    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'aniketmagadum.helpdesk::lang.settings.label',
                'description' => 'aniketmagadum.helpdesk::lang.settings.description',
                'category'    => 'aniketmagadum.helpdesk::lang.plugin.name',
                'icon'        => 'icon-cog',
                'class'       => 'AniketMagadum\Helpdesk\Models\Settings',
                'order'       => 500,
                'keywords'    => 'aniketmagadum.helpdesk::lang.settings.keywords',
                'permissions' => ['aniketmagadum.helpdesk.access_settings']
            ]
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'helpdesk' => [
                'label'       => 'aniketmagadum.helpdesk::lang.plugin.name',
                'url'         => Backend::url('aniketmagadum/helpdesk/tickets'),
                'icon'        => 'icon-ticket',
                'permissions' => ['aniketmagadum.helpdesk.*'],
                'order'       => 500,
                'sideMenu' => [
                    'tickets' => [
                        'label'       => 'aniketmagadum.helpdesk::lang.tickets.menu_label',
                        'icon'        => 'icon-ticket',
                        'url'         => Backend::url('aniketmagadum/helpdesk/tickets'),
                        'permissions' => ['acme.blog.access_tickets'],
                        'counter'     => 2,
                        'counterLabel' => 'Label describing a static menu counter',
                    ],
                    'categories' => [
                        'label'       => 'aniketmagadum.helpdesk::lang.categories.menu_label',
                        'icon'        => 'icon-sitemap',
                        'url'         => Backend::url('aniketmagadum/helpdesk/categories'),
                        'permissions' => ['acme.blog.access_categories'],
                    ],
                    'labels' => [
                        'label'       => 'aniketmagadum.helpdesk::lang.labels.menu_label',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('aniketmagadum/helpdesk/labels'),
                        'permissions' => ['acme.blog.access_labels'],
                    ],
                ]
            ],
        ];
    }
}
