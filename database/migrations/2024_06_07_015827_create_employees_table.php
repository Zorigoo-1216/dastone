<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Миграцийг ажиллуулах функц
     *
     * @return void
     */
    public function up()
    {
        // employees хүснэгтийг үүсгэх
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // Анхны түлхүүр (primary key) багана
            $table->string('last_name'); // Эцэг/эхийн нэр
            $table->string('first_name'); // Өөрийн нэр
            $table->string('reg_number')->unique(); // Регистрийн дугаар (давтагдашгүй)
            $table->string('position'); // Албан тушаал
            $table->string('email')->unique(); // И-мэйл (давтагдашгүй)
            $table->string('phone_number'); // Гар утасны дугаар
            $table->string('gender'); // Хүйс
            $table->date('birth_date'); // Төрсөн өдөр
            $table->date('start_date'); // Ажилд орсон өдөр
            $table->string('home_number')->nullable(); // Гэрийн утасны дугаар (null байж болно)
            $table->string('work_number')->nullable(); // Ажлын утасны дугаар (null байж болно)
            $table->string('photo')->nullable(); // Зураг (null байж болно)
            $table->string('state'); // Төлөв
            $table->timestamps(); // created_at, updated_at баганууд
        });
    }

    /**
     * Миграцийг буцаах функц
     *
     * @return void
     */
    public function down()
    {
        // employees хүснэгтийг устгах
        Schema::dropIfExists('employees');
    }
}
