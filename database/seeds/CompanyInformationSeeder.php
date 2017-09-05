<?php

use Illuminate\Database\Seeder;

class CompanyInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('CompanyInformation')->insert([
            'name' => 'Face-IT',
            'city' => 'Zaporizhzhya',
            'country' => 'Ukraine'
        ]);
    }
}
