<?php

use Illuminate\Database\Seeder;
use App\Model\Masterdata\company as cmdb;

class company extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      cmdb::truncate();
        foreach (['DoDayDream','NamuLife'] as $value) {
          cmdb::create([
            'name'=>$value
          ]);
        }
    }
}
