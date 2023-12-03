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
        DB::unprepared('
        CREATE TRIGGER log_insert_roles
        AFTER INSERT ON roles
        FOR EACH ROW
        BEGIN
        INSERT INTO log_roles(ID_Roles, Email, Password, Nama_Role, Action, Username, Waktu)
        VALUES (new.ID_Roles, new.Email, new.Password, new.Nama_Role, "Insert", CURRENT_USER(), NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_roles');
    }
};
