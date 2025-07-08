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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kandidat_id')->constrained('kandidats')->onDelete('cascade');
            $table->enum('jabatan_dipilih', ['pradana', 'wakil', 'adat']);
            $table->string('voter_identifier')->nullable(); // untuk tracking voter unik
            $table->ipAddress('ip_address')->nullable(); // optional: tracking IP
            $table->timestamps();
            
            // Index untuk optimasi query
            $table->index(['kandidat_id', 'jabatan_dipilih']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
