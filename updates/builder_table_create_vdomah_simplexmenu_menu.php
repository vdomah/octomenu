<?php namespace Vdomah\SimplexMenu\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateVdomahSimplexmenuMenu extends Migration
{
    public function up()
    {
        Schema::create('vdomah_simplexmenu_menu', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255);
            $table->string('code', 255);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('vdomah_simplexmenu_menu');
    }
}
