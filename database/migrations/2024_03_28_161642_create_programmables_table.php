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
        Schema::create('programmables', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('program_id')
                ->constrained('programs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->uuidMorphs('programmable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmables');
    }
};
