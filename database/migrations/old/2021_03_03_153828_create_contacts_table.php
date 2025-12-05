<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            // $table->text('map')->comment('Location on map');
            $table->string('location');
            $table->string('email');
            $table->string('call')->comment('mobile or phone number');
        });

        DB::table('contacts')->insert(
            array(
                'location' => 'Zypressnweg 3 - 53340 Meckenheim',
                'email' => 'info@lababidi-bau.de' ,
                'call'=>'491711172776'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
