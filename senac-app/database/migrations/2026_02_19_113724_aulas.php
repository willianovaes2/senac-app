<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aulas', function (Blueprint $table) {
            $table->id();

            $table->date('dia');
            $table->string('status');


            $table->foreignId('curso_id')
                ->constrained('curso')
                ->onDelete('cascade');

            $table->foreignId('uc_id')
                ->constrained('uc')
                ->onDelete('cascade');

            $table->foreignId('docente_responsavel_id')
                ->nullable()
                ->constrained('docente')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('aulas', function (Blueprint $table) {
            $table->dropForeign(['docente_responsavel_id']);
            $table->dropColumn('docente_responsavel_id');
        });
    }
};