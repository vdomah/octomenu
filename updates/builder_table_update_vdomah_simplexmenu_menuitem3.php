<?php namespace Vdomah\SimplexMenu\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateVdomahSimplexmenuMenuitem3 extends Migration
{
    public function up()
    {
        Schema::table('vdomah_simplexmenu_menuitem', function($table)
        {
            $table->renameColumn('parent_id', 'menu_id');
        });
    }
    
    public function down()
    {
        Schema::table('vdomah_simplexmenu_menuitem', function($table)
        {
            $table->renameColumn('menu_id', 'parent_id');
        });
    }
}