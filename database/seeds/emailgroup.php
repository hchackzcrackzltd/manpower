<?php

use Illuminate\Database\Seeder;
use App\Model\Masterdata\mail_group;

class emailgroup extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      mail_group::truncate();
      foreach (['HR','MIS','Account','Administrator'] as $value) {
        mail_group::create([
          'email'=>'example@example.com',
          'name'=>$value
        ]);
      }
    }
}
