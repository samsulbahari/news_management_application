<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('reference_users_role', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->timestamps();
        });

        DB::table('reference_users_role')->insert([
            ['name' => 'Developer', 'public' => true],
            ['name' => 'Journalist', 'public' => true],
            ['name' => 'Admin', 'public' => false],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reference_users_role');
    }
};
