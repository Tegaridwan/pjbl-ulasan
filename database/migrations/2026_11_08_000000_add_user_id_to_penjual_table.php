<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penjual', function (Blueprint $table) {
            $table->foreignId('Id_User')
                ->nullable()
                ->unique()
                ->constrained('users')
                ->nullOnDelete();
        });

        DB::statement('
            UPDATE penjual
            SET Id_User = Id_Penjual
            WHERE Id_Penjual IN (SELECT id FROM users)
        ');
    }

    public function down(): void
    {
        Schema::table('penjual', function (Blueprint $table) {
            $table->dropForeign(['Id_User']);
            $table->dropUnique(['Id_User']);
            $table->dropColumn('Id_User');
        });
    }
};
