<?php namespace Vdomah\SimplexMenu;

use System\Classes\PluginBase;
use Vdomah\SimplexMenu\Models\MenuItem;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Vdomah\SimplexMenu\Components\Menu' => 'simplexMenu',
        ];
    }

    public function registerSettings()
    {
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'menuitem_url' => [$this, 'menuitemUrl'],
            ]
        ];
    }

    public function menuitemUrl($item)
    {
        $out = '';

        switch ($item->mode) {
            case MenuItem::MODE_PAGE:
                //dd($item);
                break;
            case MenuItem::MODE_LINK:
                break;
            case MenuItem::MODE_POST:
                //dd($item);
                //$out =
                break;
            case MenuItem::MODE_EVENT:
                break;
        }

        return $out;
    }
}
