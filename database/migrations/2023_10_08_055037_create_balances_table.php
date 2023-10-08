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
        Schema::create('balances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->integer('amount');
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->timestamps();

            $table->index("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('balances', function(Blueprint $table){
            $table->dropForeign(["user_id"]);
            $table->dropIndex(["user_id"]);
            $table->dropColumn("user_id");
        });

        Schema::dropIfExists('balances');
    }
};
