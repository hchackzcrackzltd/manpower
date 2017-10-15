<?php

use Illuminate\Database\Seeder;
use App\Model\Masterdata\status as db;

class status extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        db::truncate();
        foreach ([
          'NP'=>'Draft','NJ'=>'Pending',
          'CN'=>'Cancle','AJ'=>'Assigned',
          'JC'=>'Evaluate','SC'=>'Success',
          ] as $key=>$value) {
          db::create([
            'id'=>$key,
            'name'=>$value
          ]);
        }
    }
}
