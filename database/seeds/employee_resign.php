<?php

use Illuminate\Database\Seeder;
use App\Model\Masterdata\employee_resign as ern;
use Illuminate\Support\Facades\DB;

class employee_resign extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      ern::truncate();
        foreach (DB::connection('mysql')->table('employee_com')->where('status','A')
        ->select('*')->get() as $value) {
          ern::create(['id'=>$value->id,'code_dep'=>$value->code_dep,'replace'=>0]);
        }
    }
}
