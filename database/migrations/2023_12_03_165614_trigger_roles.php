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
        INSERT INTO log_roles(ID_Roles, Email, Password, nama_role, Action, Username, Waktu)
        VALUES (new.ID_Roles, new.Email, new.Password, new.nama_role, "Insert", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER disable_update_roles
        BEFORE update ON roles
        FOR EACH ROW
        BEGIN
        IF (OLD.ID_Roles <> NEW.ID_Roles) THEN
        SIGNAL SQLSTATE "45000"
        SET MESSAGE_TEXT = "Tidak dapat mengubah role";
        END IF;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_roles');
        DB::unprepared('DROP TRIGGER disable_update_roles');
    }
};
