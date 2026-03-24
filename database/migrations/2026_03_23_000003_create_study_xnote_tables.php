<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Ensure categories table matches
        Schema::dropIfExists('categories');
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type'); // grade or semester
            $table->timestamps();
        });

        // Ensure notes table matches exact schema
        Schema::dropIfExists('notes');
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->longText('content'); // stores text content or image_path
            $table->string('type'); // text or image
            $table->unsignedBigInteger('view_count')->default(0);
            $table->timestamps();
        });

        // Pivot table for viewed_notes
        Schema::dropIfExists('note_user');
        Schema::create('note_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('note_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamp('viewed_at')->useCurrent();
            $table->timestamps();
        });

        // Add username to users table
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->nullable()->after('name');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('note_user');
        Schema::dropIfExists('notes');
        Schema::dropIfExists('categories');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
