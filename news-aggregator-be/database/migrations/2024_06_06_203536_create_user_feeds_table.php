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
        Schema::create('user_feeds', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('content')->nullable();
            $table->text('content_html')->nullable();
            $table->string('image_url')->nullable();
            $table->string('author')->nullable();
            $table->string('news_url')->nullable();
            $table->string('source');
            $table->string('category')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'user_feeds_user_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_feeds');
    }
};