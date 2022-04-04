<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGenerateIDStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER id_staff BEFORE INSERT ON staffs FOR EACH ROW
        BEGIN
            INSERT INTO sequenc_tbls VALUES (NULL);
            SET NEW.staff_id = CONCAT("ST-", LPAD(LAST_INSERT_ID(), 8, "0"));
        END
        
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER "id_staff"');
    }
}