<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->id();
                $table->string("uuid", 100);
                $table->string("hostname", 100);
                $table->string("browser", 100)->nullable();
                $table->string("os", 100);
                $table->string("device", 100);
                $table->string("screen", 100);
                $table->string("language", 100);
                $table->char("country", 100);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
