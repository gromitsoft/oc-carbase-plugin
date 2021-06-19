<?php namespace Gromit\Carbase;

use Backend\Classes\Controller;
use Gromit\Carbase\Components\CarbaseComponent;
use Gromit\Carbase\Console\Seed;
use Gromit\CarBase\Widgets\CarSelector;
use System\Classes\PluginBase;

/**
 * carbase Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'carbase',
            'description' => 'No  description provided yet...',
            'author'      => 'gromit',
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
        $this->registerConsoleCommand('carbase:seed', Seed::class);
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        Controller::extend(function (Controller $controller) {
            $carSelector = new CarSelector($controller);
            $carSelector->alias = 'carSelector';
            $carSelector->bindToController();
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            CarbaseComponent::class => 'Carbase',
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
            'gromit.carbase.some_permission' => [
                'tab' => 'carbase',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'carbase' => [
                'label'       => 'carbase',
                'url'         => Backend::url('gromit/carbase/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['gromit.carbase.*'],
                'order'       => 500,
            ],
        ];
    }

}
