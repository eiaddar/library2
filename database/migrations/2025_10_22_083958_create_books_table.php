<?php

use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('isbn', 13)->unique()->nullable();
            $table->text('description')->nullable();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->string('publisher')->nullable();
            $table->date('published_date')->nullable();
            $table->string('language', 50)->default('English');
            $table->integer('pages')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->integer('stock_quantity')->default(0);
            $table->integer('available_quantity')->default(0);
            $table->string('cover_image')->nullable();
            $table->enum('format', ['hardcover', 'paperback', 'ebook', 'audiobook'])->default('paperback');
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
