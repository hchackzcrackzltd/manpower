<?php

use Illuminate\Database\Seeder;
use App\Model\Masterdata\offac as ofdb;

class offac extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      ofdb::truncate();
      foreach (['stationary','furniture','name card'] as $value) {
        ofdb::create([
          'itemdesc'=>$value
        ]);
      }
    }
}
