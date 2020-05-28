<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
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


/*

 create or replace table notifications_cars(
                    id bigint(20) unsigned primary key auto_increment not null,
                    user_id bigint(20) unsigned not null,
     				post_id bigint(20) unsigned not null,
     				comment_id bigint(20) unsigned not null,
     				to_user_id bigint(20) unsigned not null, 
                    created_at timestamp,
                    updated_at timestamp,
                    foreign key(user_id) references users(id) ON DELETE CASCADE,
     				foreign key(post_id) references posts(id) ON DELETE CASCADE,
     				foreign key(comment_id) references comments_car_posts(id) ON DELETE CASCADE,
     				foreign key(to_user_id) references users(id) ON DELETE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

*/