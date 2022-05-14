<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('allowed_domains', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
        });
    }

    public function down() {
        Schema::dropIfExists('allowed_domains');
    }
};
