<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(offac::class);
      $this->call(location::class);
      $this->call(emailgroup::class);
      $this->call(employee_resign::class);
      $this->call(usersync::class);
      $this->call(company::class);
      $this->call(functionmaster::class);
      $this->call(status::class);
      $this->call(reason_emp::class);
      //$this->call(eform::class);
    }
}
