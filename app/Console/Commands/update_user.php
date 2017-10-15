<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Masterdata\employee;
use App\Model\Masterdata\emp_raw;
use App\User;

class update_user extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update User From Database';

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
      User::all()->each(function($values){
        employee::where(['code'=>$values->username,'syng'=>1])->get()->each(function($value){
          User::where('username',$value->code)->update([
            'password'=>bcrypt(base64_decode($value->password)),
            'email'=>$value->email_office,
            'name'=>$value->fname_en.'.'.strtoupper(substr($value->lname_en,0,1))
          ]);
          emp_raw::find($value->code)->update(['syng'=>0]);
        });

      });
    }
}
