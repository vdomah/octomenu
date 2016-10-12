<?php namespace Vdomah\SimplexMenu\Models;

use Model;

/**
 * Model
 */
class Menu extends Model
{
    use \October\Rain\Database\Traits\Validation;

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
    public $table = 'vdomah_simplexmenu_menu';

    public $implement = ['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = ['name'];

    public $hasMany = [
        'items' => [
            'Vdomah\SimplexMenu\Models\MenuItem',
            'order' => 'showorder',
            'conditions' => 'parent_id = 0 OR parent_id is null'
        ],
    ];
}