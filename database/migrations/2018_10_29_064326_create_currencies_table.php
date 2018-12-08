<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->enum('currency_type', ['Fiat', 'Coin','Token'])->comment("Fiat ,Coin ,Token");
            $table->string('symbol');
            $table->string('logo');
            $table->decimal('circulating_supply',28,8);
            $table->decimal('max_supply',28,8);
            $table->decimal('total_supply',28,8);
            $table->decimal('exchange_rate',20,4)->nullable();
            $table->boolean('mineable');
            $table->string('ranking');
            $table->boolean('status');
            $table->timestamps();
        });
        Schema::create('exchanges',function (Blueprint $table){
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('name');
            $table->boolean('status');
            $table->string('slug');
            $table->string('url');
            $table->string('fetch_url');
            $table->boolean('has_fee');
            $table->enum('fee_type',['No Fees','Percentage','Transaction Mining','Unknown'])->comment("Fee Types of Exchanges");
            $table->timestamps();


        });
        Schema::create('currency_codes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->unsignedInteger('cid')->comment("Currency Id");
            $table->unsignedInteger('eid')->comment("Exchange Id");
            $table->string('code');
        });

        Schema::table('currency_codes', function (Blueprint $table) {

            $table->foreign('cid')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('eid')->references('id')->on('exchanges')->onDelete('cascade');
        });

        Schema::create('currency_details',function (Blueprint $table){
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->unsignedInteger('cid')->comment("Currency Id");
            $table->enum('type', ['Website','Message Board','Source Code','Technical Documentation','Explorer','Tags','Forum','Announcement','Chat'])->comment("Website,Message,Source,Technical,Explorer,Tags,Forum,Announcement,Chat");
            $table->string('url');
            $table->string('text');


        });


        Schema::table('currency_details',function (Blueprint $table){
            $table->foreign('cid')->references('id')->on('currencies')->onDelete('cascade');
        });

//        Schema::create('images',function (Blueprint $table){
//            $table->engine = "InnoDB";
//            $table->increments('id');
//            $table->unsignedInteger('item_id')->comment("Currency Id");
//            $table->string('name');
//            $table->string('path');
//            $table->string('size');
//        });
//        Schema::table('images',function (Blueprint $table){
//            $table->foreign('item_id')->references('id')->on('currencies')->onDelete('cascade');
//        });







        Schema::create('ce_pairs',function (Blueprint $table){
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->unsignedInteger('c1')->comment("Currency Id Base Asset");
            $table->unsignedInteger('c2')->comment("Currency Id Quote Asset");
            $table->unsignedInteger('eid')->comment("Exchange Id");
            $table->unsignedInteger('cc1')->comment("Currency Code Id");
            $table->unsignedInteger('cc2')->comment("Currency Code Id");
            $table->enum('category',['Spot','Derivatives'])->comment("Trading Categories");

            $table->boolean('status');

            $table->unique(['c1','c2','eid','cc1','cc2']);



        });
        Schema::table('ce_pairs',function (Blueprint $table){
            $table->foreign('c1')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('c2')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('eid')->references('id')->on('exchanges')->onDelete('cascade');
            $table->foreign('cc1')->references('id')->on('currency_codes')->onDelete('cascade');
            $table->foreign('cc2')->references('id')->on('currency_codes')->onDelete('cascade');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('images');
        Schema::dropIfExists('currency_details');
        Schema::dropIfExists('ce_pairs');
        Schema::dropIfExists('exchanges');
        Schema::dropIfExists('currency_codes');
    }
}
