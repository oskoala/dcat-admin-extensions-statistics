<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('page_views')) {
            Schema::create('page_views', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger("session_id");
                $table->string("url", 500);
                $table->string("referrer", 500)->nullable();
                $table->timestamps();

                $table->foreign("session_id")->on("sessions")->references('id')->cascadeOnDelete();
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
        Schema::dropIfExists('page_views');
    }
}
