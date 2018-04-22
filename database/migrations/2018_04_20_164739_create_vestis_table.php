<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVestisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vestis', function (Blueprint $table) {
            $table->increments('id');
			$table->string('link');
			$table->string('slika');
			$table->text('naslov');
			$table->text('text');
			$table->string('datum');
			$table->string('izvor');
			$table->string('privilegija');
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
        Schema::dropIfExists('vestis');
    }
}
