<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->id();
            $table->string("code_tiket");
            $table->string("depart");
            $table->string("destination");
            $table->string("prix");
            $table->string("duree");
            $table->string("date_emission");
            $table->string("date_expiration");
            $table->tinyInteger("status");
            $table->bigInteger("user_id_ticket");
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
        Schema::dropIfExists('tikets');
    }
};
