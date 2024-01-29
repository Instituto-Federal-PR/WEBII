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
        Schema::create('declaracoes', function (Blueprint $table) {
            $table->id();
            $table->string('hash');
            $table->date('data');
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('comprovante_id');
            $table->foreign('aluno_id')->references('id')->on('alunos');
            $table->foreign('comprovante_id')->references('id')->on('comprovantes');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declaracaos');
    }
};
