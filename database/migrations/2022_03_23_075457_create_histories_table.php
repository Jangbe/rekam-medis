<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('med_rec_id');
            $table->string('name');
            $table->string('no_rm');
            $table->string('birth');
            $table->string('parent');
            $table->timestamps();
        });
        DB::unprepared("CREATE TRIGGER history_medrecs AFTER INSERT ON `medical_records` FOR EACH ROW
            BEGIN
                INSERT INTO `histories` (`med_rec_id`, `name` ,`no_rm`, `birth`, `parent`, `created_at`, `updated_at`) VALUES (
                    NEW.id,
                    (SELECT (name) FROM patient where id=NEW.patient_id),
                    (SELECT (no_rm) FROM patient where id=NEW.patient_id),
                    (SELECT (birth) FROM patient where id=NEW.patient_id),
                    (SELECT CONCAT(mother_name, ` / `, father_name) FROM patient where id=NEW.patient_id),
                    NEW.created_at, NEW.updated_at
                );
            END"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
        DB::unprepared('DROP TRIGGER history_medrecs');
    }
};
