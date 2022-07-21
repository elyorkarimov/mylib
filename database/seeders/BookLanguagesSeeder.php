<?php

namespace Database\Seeders;

use App\Models\BookLanguage;
use Illuminate\Database\Seeder;

class BookLanguagesSeeder extends Seeder
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
            'uz' => ['title' => "O‘zbekcha"],
            'en' => ['title' => "Uzbek"],
        ];
        BookLanguage::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Ruscha"],
            'en' => ['title' => "Russian"],
        ];
        BookLanguage::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Inglizcha"],
            'en' => ['title' => "English"],
        ];
        BookLanguage::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Nemischa"],
            'en' => ['title' => "German"],
        ];
        BookLanguage::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "O‘zbekcha&Ruscha&Inglizcha"],
            'en' => ['title' => "Uzbek&Russian&English"],
        ];
        BookLanguage::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "O‘zbekcha&Ruscha"],
            'en' => ['title' => "Uzbek&Russian"],
        ];
        BookLanguage::create($data);
    }
}
