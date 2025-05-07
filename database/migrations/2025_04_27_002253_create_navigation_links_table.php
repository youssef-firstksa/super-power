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
        Schema::create('navigation_links', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('page_type')->default('content'); // content, cms_page
            // It is showing in case of type "cms_page" to select from the cms pages
            $table->string('cms_page')->nullable();
            // It is fill out in case of type "cms_page" after select the cms_page
            $table->string('controller')->nullable();
            // It is fill out in case of type "cms_page" after select the cms_page
            $table->string('action')->nullable();
            $table->integer('order')->default(0);
            $table->foreignId('parent_id')->nullable()->constrained('navigation_links')->nullOnDelete()->cascadeOnUpdate();
            $table->string('status')->default('active');
            $table->timestamps();
        });

        Schema::create('navigation_link_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('navigation_link_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('locale')->index();
            $table->string('label');
            $table->unique(['navigation_link_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigation_link_translations');
        Schema::dropIfExists('navigation_links');
    }
};
