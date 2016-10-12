<?php namespace Vdomah\SimplexMenu\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateVdomahSimplexmenuMenuitem2 extends Migration
{
    public function up()
    {
        Schema::table('vdomah_simplexmenu_menuitem', function($table)
        {
            $table->string('page', 255);
            $table->dropColumn('page_id');
        });
    }
    
    public function down()
    {
        Schema::table('vdomah_simplexmenu_menuitem', function($table)
        {
            $table->dropColumn('page');
            $table->integer('page_id')->unsigned();
        });
    }
}
