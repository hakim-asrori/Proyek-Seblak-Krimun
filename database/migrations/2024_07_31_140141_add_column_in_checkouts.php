<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropColumn(['name', 'phone', 'address', 'level']);
            $table->foreignIdFor(User::class)->after('id');
            $table->enum('service', [1, 2])->after('user_id');
            $table->tinyInteger('status')->after('service');
            $table->string('reference')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->string('level');
            $table->dropColumn(['service', 'status', 'user_id', 'reference']);
        });
    }
};
