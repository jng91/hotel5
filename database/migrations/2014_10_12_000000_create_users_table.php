<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\User;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->boolean('admin')->default(false);;
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('hotel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->string('phone');
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('room', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('capacity');
            $table->timestamps();
        });

        Schema::create('hotel-room', function (Blueprint $table) {
            $table->bigInteger('id_hotel');
            $table->bigInteger('id_room');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });

        Schema::create('reservation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_hotel');
            $table->bigInteger('id_room');
            $table->bigInteger('id_user');
            $table->decimal('total_price', 8, 2);
            $table->date('checkin');
            $table->date('checkout');
            $table->string('comment')->nullable();
            $table->integer('num_people');
            $table->boolean('confirm')->default(0);
            $table->boolean('rejected')->default(0);
            $table->timestamps();
        });

        DB::table('hotel')->insert(
            array(
                'name' => 'Hotel Mercury',
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipiscing elit, senectus magna. Hendrerit integer fusce purus hac porttitor ac, pretium lacinia rutrum nam.',
                'phone' => '000000000',
                'address' => 'street Mercury',
            )
        );

        DB::table('hotel')->insert(
            array(
                'name' => 'Hotel Venus',
                'description' => 'Lorem ipsum dolor sit, amet consectetur adipiscing elit, senectus magna. Hendrerit integer fusce purus hac porttitor ac, pretium lacinia rutrum nam.',
                'phone' => '000000000',
                'address' => 'street Venus',
            )
        );

        DB::table('room')->insert(
            array(
                'name' => 'Individual Room',
                'capacity' => 1,
            )
        );

        DB::table('room')->insert(
            array(
                'name' => 'King Room',
                'capacity' => 2,
            )
        );

        DB::table('room')->insert(
            array(
                'name' => 'Queen Room',
                'capacity' => 3,
            )
        );

        DB::table('hotel-room')->insert(
            array(
                'id_hotel' => 1,
                'id_room' => 1,
                'price' => 50.00,
            )
        );

        DB::table('hotel-room')->insert(
            array(
                'id_hotel' => 1,
                'id_room' => 2,
                'price' => 60.00,
            )
        );

        DB::table('hotel-room')->insert(
            array(
                'id_hotel' => 1,
                'id_room' => 3,
                'price' => 70.00,
            )
        );

        DB::table('hotel-room')->insert(
            array(
                'id_hotel' => 2,
                'id_room' => 1,
                'price' => 50.00,
            )
        );

        DB::table('hotel-room')->insert(
            array(
                'id_hotel' => 2,
                'id_room' => 3,
                'price' => 70.00,
            )
        );

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345'),
            'phone' => '000000000',
            'date_of_birth' => '1991/10/25',
            'admin' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
