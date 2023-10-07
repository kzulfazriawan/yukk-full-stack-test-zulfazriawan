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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('title');
            $table->integer('amount');
            $table->boolean('is_income')->default(1);
            $table->text('remarks');
            $table->uuid('service_id');
            $table->enum('status', ['open', 'paid', 'expired', 'cancel']);
            $table->timestamp('expiry');
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->timestamps();
            
            $table->index("service_id");
            $table->foreign("service_id")->references("id")->on("services")->onDelete("cascade");

            $table->index("user_id");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function(Blueprint $table){
            $table->dropForeign(["user_id"]);
            $table->dropIndex(["user_id"]);
            $table->dropColumn("user_id");
        });

        Schema::table('transactions', function(Blueprint $table){
            $table->dropForeign(["service_id"]);
            $table->dropIndex(["service_id"]);
            $table->dropColumn("service_id");
        });

        Schema::dropIfExists('transactions');
    }
};
