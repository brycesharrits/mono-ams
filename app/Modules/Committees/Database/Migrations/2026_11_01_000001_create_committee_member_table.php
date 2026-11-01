<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('committee_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('committee_id')->constrained('committees')->cascadeOnDelete();
            $table->foreignId('member_id')->constrained('members')->cascadeOnDelete();
            $table->string('role')->default('member');
            $table->date('joined_at')->nullable();
            $table->timestamps();

            $table->unique(['committee_id', 'member_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('committee_member');
    }
};
