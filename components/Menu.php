<?php namespace Vdomah\SimplexMenu\Components;

use Vdomah\SimplexMenu\Models\Menu as MenuModel;
use Cms\Classes\ComponentBase;
use DB;
use Cms\Classes\Page;

class Menu extends ComponentBase
{

    public $menu = [];

    /**
     * Component Registration
     *
     * @return  array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'Menu',
            'description' => 'Displays a menu.'
        ];
    }

    /**
     * Component Properties
     *
     * @return  array
     */
    public function defineProperties()
    {
        return [
            'menu' => [
                'title'       => 'vdomah.simplexmenu::lang.settings.menu',
                'description' => 'vdomah.simplexmenu::lang.settings.menu_description',
                'type'        => 'dropdown',
            ],
            'postPage' => [
                'title'       => 'vdomah.simplexmenu::lang.settings.postPage',
                'description' => 'vdomah.simplexmenu::lang.settings.postPage_description',
                'type'        => 'dropdown',
            ],
            'eventPage' => [
                'title'       => 'vdomah.simplexmenu::lang.settings.eventPage',
                'description' => 'vdomah.simplexmenu::lang.settings.eventPage_description',
                'type'        => 'dropdown',
            ],
        ];
    }

    public function getMenuOptions()
    {
        return MenuModel::lists('name', 'code');
    }

    public function getPostPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getEventPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * Query and return blog products
     *
     * @return  Illuminate\Database\Eloquent\Collection
     */
    public function onRun()
    {
        $menu = MenuModel::with('items')
            ->where('code', $this->property('menu'))
            ->first();
//        if ($this->property('postPage'))
//        dd($this->property('postPage'));
        $menu->items->each(function($item) {
            $item->setUrl($this->property('postPage'), $this->controller);
            //if ($this->property('menu') == 'front-links')
            //dd($this->property('postPage'));
            //return $item;//->url =
        });

        $this->menu = $this->page['menu'] = $menu;
    }
}
