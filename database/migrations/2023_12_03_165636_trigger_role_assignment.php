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
        CREATE TRIGGER log_insert_role_assignment
        AFTER INSERT ON role_assignments
        FOR EACH ROW
        BEGIN
        INSERT INTO log_role_assignments(ID_Role_Assignment, Role_ID, Siswa_ID, NUPTK_Guru, Pegawai_ID, Kepsek_ID, Action, Username, Waktu)
        VALUES (new.ID_Role_Assignment, new.Role_ID, new.Siswa_ID, new.NUPTK_Guru, new.Pegawai_ID, new.Kepsek_ID, "Insert", "CURRENT_USER()", NOW());
        END
        ');

        DB::unprepared('
        CREATE TRIGGER log_update_role_assignment
        AFTER update ON role_assignments
        FOR EACH ROW
        BEGIN
        INSERT INTO log_role_assignments(ID_Role_Assignment, Role_ID, Siswa_ID, NUPTK_Guru, Pegawai_ID, Kepsek_ID, Action, Username, Waktu)
        VALUES (new.ID_Role_Assignment, new.Role_ID, new.Siswa_ID, new.NUPTK_Guru, new.Pegawai_ID, new.Kepsek_ID, "update", "CURRENT_USER()", NOW());
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER log_insert_role_assignment');
        DB::unprepared('DROP TRIGGER log_update_role_assignment');
    }
};
