<?php namespace Vdomah\SimplexMenu\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateVdomahSimplexmenuMenuitem extends Migration
{
    public function up()
    {
        Schema::table('vdomah_simplexmenu_menuitem', function($table)
        {
            $table->integer('page_id')->unsigned();
            $table->increments('id')->unsigned(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('vdomah_simplexmenu_menuitem', function($table)
        {
            $table->dropColumn('page_id');
            $table->increments('id')->unsigned()->change();
        });
    }
}
