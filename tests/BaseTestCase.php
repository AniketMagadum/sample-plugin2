<?php

namespace AniketMagadum\Helpdesk\Tests;

use Rainlab\User\Facades\Auth;
use BackendAuth;
use System\Classes\PluginManager;
use PluginTestCase;

class BaseTestCase extends PluginTestCase
{
    public function setUp()
    {
        parent::setUp();

        // Get the plugin manager
        $pluginManager = PluginManager::instance();

        // Register the plugins to make features like file configuration available
        $pluginManager->registerAll(true);

        // Boot all the plugins to test with dependencies of this plugin
        $pluginManager->bootAll(true);

        //Logout Backend and Frontend User
        BackendAuth::logout();
        Auth::logout();
    }

    public function tearDown()
    {
        parent::tearDown();
        // Get the plugin manager
        $pluginManager = PluginManager::instance();
        // Ensure that plugins are registered again for the next test
        $pluginManager->unregisterAll();
    }
}
