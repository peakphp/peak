<?php

use \App\Models\Migration;

class Example extends Migration
{
    /**
     * Up
     */
    public function up()
    {
        $this->db->schema()->create('widgets', function($table){
            $table->increments('id');
            $table->integer('serial_number');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Down
     */
    public function down()
    {
        $this->db->schema()->drop('widgets');
    }
}
