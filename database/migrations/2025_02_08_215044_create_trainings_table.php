<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_trainings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->integer('umur');
            $table->string('insiden');
            $table->string('lokasi');
            $table->string('frekuensi');
            $table->string('insiden_kejadian');
            $table->string('pelaku');
            $table->string('jenis_kelamin_pelaku');
            $table->string('dampak');
            $table->string('hasil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_trainings');
    }
};
