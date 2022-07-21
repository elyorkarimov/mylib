<?php

namespace Database\Seeders;

use App\Models\BooksType;
use Illuminate\Database\Seeder;

class BookTypesSeeder extends Seeder
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
            'uz' => ['title' => 'Darslik'],
            'en' => ['title' => 'Textbook'],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "O‘quv qo‘llanma"],
            'en' => ['title' => 'Study guide'],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Siyosiy adabiyot"],
            'en' => ['title' => 'Political books'],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Ilmiy adabiyot"],
            'en' => ['title' => "Scientific books"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Monografiya"],
            'en' => ['title' => "Monograph"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "To‘plam"],
            'en' => ['title' => "Collections"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Badiiy adabiyot"],
            'en' => ['title' => "Fiction books"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Lug‘at"],
            'en' => ['title' => "Dictionary"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Ma'lumotnoma"],
            'en' => ['title' => "Reference"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Broshura"],
            'en' => ['title' => "Brochure"],
        ];
        BooksType::create($data);
        $data = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'uz' => ['title' => "Metodik qo‘llanma"],
            'en' => ['title' => "Methodical manual"],
        ];
        BooksType::create($data);
    }
}
