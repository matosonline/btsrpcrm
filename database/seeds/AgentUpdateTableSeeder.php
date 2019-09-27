<?php

use Illuminate\Database\Seeder;

class AgentUpdateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $new_users = DB::connection('mysql')->table('users_update')->get();
       foreach($new_users as $val){
           $name = explode(' ', $val->name)[1];
//           echo"<pre>";print_R(explode(' ', $val->name)[1]);exit;
           $abc = DB::connection('mysql')->table('users')
                ->where('last_name','LIKE',"%$name%")
                ->update([
                        'email' => $val->email,
                        'phone_number' => $val->phone,
                ]);
       }
    }
}
