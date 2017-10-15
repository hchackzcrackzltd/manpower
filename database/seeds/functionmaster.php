<?php

use Illuminate\Database\Seeder;
use App\Model\Masterdata\functionmaster as func;

class functionmaster extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      func::truncate();
      foreach (['Manpower','Resign','Manpower (New position without approved annual budget)'] as $value) {
        func::create([
          'name'=>$value
        ]);
      }
    }
}
