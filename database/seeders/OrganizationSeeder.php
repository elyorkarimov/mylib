<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => 'Toshkent kimyo texnologiya instituti'],
            'en' => ['title' => 'Tashkent Institute of Chemical Technology'],
        ];
        $organization = Organization::create($data);
 

    }
}
