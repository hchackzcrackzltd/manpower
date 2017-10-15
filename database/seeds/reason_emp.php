<?php

use Illuminate\Database\Seeder;
use App\Model\Masterdata\reason_emp as db;

class reason_emp extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        db::truncate();
        foreach (['New position within approved annual budget',
        'New position without approved annual budget',
        'Replacement','Transfer employee'] as  $value) {
          db::create([
            'name'=>$value
          ]);
        }
    }
}
