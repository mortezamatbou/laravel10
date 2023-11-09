<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName', 20);
            $table->string('lastName', 20);
            $table->unsignedInteger('age');
            $table->enum('field', ['IT', 'SW', 'HW']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('entity_tests');
    }
};
