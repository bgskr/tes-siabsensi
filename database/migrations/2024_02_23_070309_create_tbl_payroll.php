<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPayroll extends Migration
{
    /**
     * Run the migrations.
     *
     * 'tidak_masuk',
     *   'telat',
     *   'pph',
     *   'total_potongan',
     *   'final_salary'
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_payroll', function (Blueprint $table) {
            $table->id();
            $table->string('nip_pegawai')->unique()->default('');
            $table->integer('tidak_masuk')->default(0)->nullable();
            $table->integer('telat')->default(0)->nullable();
            $table->integer('pph')->default(0);
            $table->integer('total_potongan')->default(0);
            $table->integer('total_salary')->default(0);
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
        Schema::dropIfExists('tbl_payroll');
    }
}
