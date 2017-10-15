<?php

use Illuminate\Database\Seeder;
use App\Model\Masterdata\location as lodb;

class location extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      lodb::truncate();
        foreach (['ho','rjn'] as $value) {
          lodb::create([
            'location'=>$value
          ]);
        }
    }
}
