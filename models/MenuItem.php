<?php namespace Vdomah\SimplexMenu\Models;

use Model;
use Cms\Classes\Page;

/**
 * Model
 */
class MenuItem extends Model
{
    use \October\Rain\Database\Traits\Validation;

    const MODE_PAGE = 0;
    const MODE_LINK = 1;
    const MODE_POST = 2;
    const MODE_EVENT = 3;
    const MODE_HTML = 4;

    /*
     * Validation
     */
    public $rules = [
    ];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vdomah_simplexmenu_menuitem';

    public $implement = ['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['name'];

    public $belongsTo = [
        'menu' => [
            'Vdomah\SimplexMenu\Models\Menu',
        ],
        'parent' => [
            'Vdomah\SimplexMenu\Models\MenuItem',
        ],
        'post' => [
            'RainLab\Blog\Models\Post',
        ],
        'event' => [
            'Vdomah\Events\Models\Event',
        ],
    ];

    public $hasMany = [
        'items' => [
            'Vdomah\SimplexMenu\Models\MenuItem',
            'order' => 'showorder',
            'key' => 'parent_id',
        ],
    ];

    public $attachOne = [
        'image' => 'System\Models\File',
    ];

    public function getPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getParentOptions()
    {
        $options = self::orderBy('showorder')->lists('name', 'id');

        $options[0] = '- No parent -';

        ksort($options);

        return $options;
    }

    public function getModeOptions()
    {
        return [
            self::MODE_PAGE => 'Page',
            self::MODE_LINK => 'Link',
            self::MODE_POST => 'Blog post',
            self::MODE_EVENT => 'Event',
            self::MODE_HTML => 'HTML',
        ];
    }

    public function getShoworderOptions()
    {
        $out = [];

        for ($i=-20; $i<=20; $i++) {
            $out[$i] = $i;
        }

        return $out;
    }

    public function setUrl($pageName, $controller)
    {
        $params = [];

        switch ($this->mode) {
            case MenuItem::MODE_PAGE:
                $this->url = $controller->pageUrl($pageName);
                break;
            case MenuItem::MODE_LINK:
                $this->url = $this->link;
                break;
            case MenuItem::MODE_POST:
                $params = [
                    'id' => $this->post->id,
                    'slug' => $this->post->slug,
                ];
                $this->url = $controller->pageUrl($pageName, $params);
            break;
            case MenuItem::MODE_EVENT:
                $params = [
                    'id' => $this->event->id,
                    'slug' => $this->event->slug,
                ];
                $this->url = $controller->pageUrl($pageName, $params);
                break;
        }

        return $this->url;
    }

    public function getIsHtmlAttribute()
    {
        return $this->mode == self::MODE_HTML ? true : false;
    }
}