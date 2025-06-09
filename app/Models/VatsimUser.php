<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VatsimUser extends Model
{
public function up()
{
    Schema::create('vatsim_users', function (Blueprint $table) {
        $table->id();
        $table->string('cid')->unique();
        $table->json('profile_data');
        $table->timestamps();
    });
}

}
