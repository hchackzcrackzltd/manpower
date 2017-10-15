<?php

use Illuminate\Database\Seeder;
use App\Model\Masterdata\employee;
use App\User;

class usersync extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=employee::find('DDD00102');
        User::create([
          'username'=>$data->code,
          'email'=>$data->email_office,
          'name'=>$data->fname_en.'.'.substr($data->lname_en,0,1),
          'is_admin'=>1,
          'password'=>bcrypt(base64_decode($data->password))
        ]);
    }
}
