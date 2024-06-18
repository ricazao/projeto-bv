<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empreendimentos', function (Blueprint $table) {
            $table->id();
            $table->char('pid', 12)->unique();
            $table->string('codigo_externo')->nullable();
            $table->enum('empresa', ['bild', 'vitta']);
            $table->string('nome');
            $table->string('end_logradouro')->nullable();
            $table->string('end_numero')->nullable();
            $table->string('end_complemento')->nullable();
            $table->string('end_bairro')->nullable();
            $table->string('end_cidade')->nullable();
            $table->string('end_cep')->nullable();
            $table->char('end_uf', 2)->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('thumb')->nullable();
            $table->string('link')->nullable();
            $table->boolean('processado')->default(false);
            $table->dateTime('criado_em')->nullable();
            $table->integer('criado_por')->nullable();
            $table->dateTime('alterado_em')->nullable();
            $table->integer('alterado_por')->nullable();
            $table->dateTime('excluido_em')->nullable();
            $table->integer('excluido_por')->nullable();
        });
    }
};
