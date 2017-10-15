<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Masterdata\employee;
use App\Model\Masterdata\employee_resign;
use App\Model\Masterdata\emp_raw;

class update_resign extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resign:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update User Resign From Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        employee::where('fistsignin',1)->get()->each(function($value)
        {
          employee_resign::create([
            'id'=>$value->code,
            'code_dep'=>$value->code_dep,
            'replace'=>0
          ]);
          emp_raw::find($value->code)->update(['fistsignin'=>0]);
        });
    }
}
