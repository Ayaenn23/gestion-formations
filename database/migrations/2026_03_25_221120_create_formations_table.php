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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('titre_fr');
            $table->string('titre_en');
            $table->string('slug_fr')->unique();
            $table->string('slug_en')->unique();
            $table->string('description_courte_fr')->nullable();
            $table->string('description_courte_en')->nullable();
            $table->text('description_complete_fr')->nullable();
            $table->text('description_complete_en')->nullable();
            $table->string('image')->nullable();
            $table->decimal('prix', 10, 2)->nullable();
            $table->string('duree')->nullable();
            $table->string('niveau')->nullable();
            $table->string('statut')->default('brouillon');
            $table->date('date_publication')->nullable();
            $table->string('seo_title_fr')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->string('seo_description_fr')->nullable();
            $table->string('seo_description_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
