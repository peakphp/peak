<?php

use Peak\Database\Laravel\PhinxMigration;
use Illuminate\Database\Schema\Blueprint;

class Example extends PhinxMigration
{
    public function up()
    {
        $this->db->getSchemaBuilder()->create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('accessKey')->nullable();
            $table->string('secretKey')->nullable();
            $table->string('resetKey')->nullable();
            $table->string('activationKey')->nullable();
            $table->text('bio')->nullable();
            $this->tsColumns($table);
            $table->timestamp('lastSeen')->nullable()->default(null);
        });
    }

    public function down()
    {
        $this->db->getSchemaBuilder()->drop('users');
    }
}
