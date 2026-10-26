
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');

            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            $table->string('operation');
            $table->decimal('price', 12, 2);
            $table->string('currency');

            $table->text('short_description');
            $table->text('description');
            $table->string('image');

            $table->string('contact_name');
            $table->string('contact_phone');
            $table->string('contact_email');

            $table->string('status');
            $table->date('published_at');
            $table->json('attributes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
