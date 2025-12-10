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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->comment('Autor de la publicación');

            // Contenido principal
            $table->string('title')->unique();
            $table->string('slug')->unique()->comment('Versión URL amigable del título');
            $table->longText('content');
            $table->text('excerpt')->nullable()->comment('Extracto o resumen del post');

            // Metadatos y control de publicación
            $table->enum('status', ['Draft', 'Published', 'Archived'])->default('Draft');
            $table->timestamp('published_at')->nullable()->comment('Fecha y hora de publicación');
            
            // Auditoría y tiempos
            $table->timestamps();
            
            // Índice para mejorar la búsqueda por estado y fecha
            $table->index(['status', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
