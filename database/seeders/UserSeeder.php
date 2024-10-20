<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Janluy Leonardo Moreno Coronado	    1022348425	  janluy_moreno@cun.edu.co
    $userJanluy = new User();
    $userJanluy->name = "Janluy Leonardo Moreno Coronado";
    $userJanluy->email = "janluy_moreno@cun.edu.co";
    $userJanluy->email_verified_at = now();
    $userJanluy->password = '$2y$10$tuwBCH5h5lSZ5stdny/81u/F0cRlow.gPud.zip8giLI7JRpTEjZK'; // password
    $userJanluy->remember_token = Str::random(10);
    $userJanluy->save();
  }
}
