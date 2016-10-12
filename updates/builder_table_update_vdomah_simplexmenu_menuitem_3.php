<?php namespace Vdomah\SimplexMenu\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateVdomahSimplexmenuMenuitem3 extends Migration
{
    public function up()
    {
        Schema::table('vdomah_simplexmenu_menuitem', function($table)
        {
            $table->integer('parent_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('vdomah_simplexmenu_menuitem', function($table)
        {
            $table->dropColumn('parent_id');
        });
    }
}
