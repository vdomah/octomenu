<?php namespace Vdomah\SimplexMenu\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateVdomahSimplexmenuMenuitem extends Migration
{
    public function up()
    {
        Schema::create('vdomah_simplexmenu_menuitem', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255);
            $table->string('page', 255);
            $table->integer('showorder');
            $table->integer('menu_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('is_image');
            $table->string('link', 255);
            $table->integer('mode');
            $table->integer('post_id')->unsigned()->nullable();
            $table->integer('event_id')->unsigned()->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('vdomah_simplexmenu_menuitem');
    }
}
