<?php
// database/migrations/xxxx_add_revision_token_to_pendaftarans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->string('revision_token')->nullable()->unique();
            $table->timestamp('revision_token_expires_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn(['revision_token', 'revision_token_expires_at']);
        });
    }
};