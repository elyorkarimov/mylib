<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
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
            'uz' => ['title' => 'Bakalavr'], 
            'en' => ['title' => 'Bachelor'],
        ];
        UserType::create($data); 
        $data2 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => 'Magistr'], 
            'en' => ['title' => 'Master'],
        ];
        UserType::create($data2); 
        $data3 = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "O'qituvchi professor"], 
            'en' => ['title' => 'Teachers & Professors'],
        ];
        UserType::create($data3);
    }
}
