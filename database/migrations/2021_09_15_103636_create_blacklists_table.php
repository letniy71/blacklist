<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlacklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blacklists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('publisher_id')->nullable()->unsigned();
            $table->bigInteger('site_id')->nullable()->unsigned();
            $table->bigInteger('advertiser_id')->nullable()->unsigned();

            $table->foreign('publisher_id')->references('id')->on('publishers')->onUpdate('cascade')->onDelete('set null');

            $table->foreign('site_id')->references('id')->on('sites')->onUpdate('cascade')->onDelete('set null');

             $table->foreign('advertiser_id')->references('id')->on('advertisers')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blacklists');
    }
}
