<?php

namespace App\Console;

use Faker\Factory as Faker;
use App\Models\Company;
use App\Models\Office;
use App\Models\Employee;
use Illuminate\Console\Command;

class PopulateDatabaseCommand extends Command
{
    protected $signature = 'db:populate';
    protected $description = 'Populate the database with random data';

    public function handle()
    {
        $faker = Faker::create();

        for ($i = 0; $i < rand(2, 4); $i++) {
            $company = Company::create([
                'name' => $faker->company,
                'address' => $faker->address,
            ]);

            for ($j = 0; $j < rand(2, 3); $j++) {
                $office = Office::create([
                    'company_id' => $company->id,
                    'location' => $faker->city,
                ]);

                for ($k = 0; $k < rand(8, 12); $k++) {
                    Employee::create([
                        'office_id' => $office->id,
                        'name' => $faker->name,
                        'email' => $faker->email,
                        'position' => $faker->jobTitle,
                    ]);
                }
            }
        }

        $this->info('Database populated with random data successfully.');
    }
}