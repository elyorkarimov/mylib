<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'organization_id' => 1,
            'branch_id' => 1,
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "MK",
            'uz' => ['title' => "Menejment va kasb ta'lim"], 
            'en' => ['title' => "Menejment va kasb ta'lim"],
        ];
        Faculty::create($data);
        $data = [
            'organization_id' => 1,
            'branch_id' => 1,
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "OO",
            'uz' => ['title' => 'Oziq ovqat mahsulotlari texnologiyasi'], 
            'en' => ['title' => 'Oziq ovqat mahsulotlari texnologiyasi'],
        ];
        Faculty::create($data); 
        $data = [
            'organization_id' => 1,
            'branch_id' => 1,
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "NM",
            'uz' => ['title' => 'Noorganik moddalar texnologiyasi'], 
            'en' => ['title' => 'Noorganik moddalar texnologiyasi'],
        ];
        Faculty::create($data); 
        $data = [
            'organization_id' => 1,
            'branch_id' => 1,
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "VT",
            'uz' => ['title' => "Vinochilik texnologiyasi va sanoat uzumchilik"], 
            'en' => ['title' => "Vinochilik texnologiyasi va sanoat uzumchilik"],
        ];
        Faculty::create($data);
        $data = [
            'organization_id' => 1,
            'branch_id' => 1,
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "TY",
            'uz' => ['title' => "Talabalar yotoqxonasi"], 
            'en' => ['title' => "Talabalar yotoqxonasi"],
        ];
        Faculty::create($data);
        $data = [
            'organization_id' => 1,
            'branch_id' => 1,
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "YOBKT",
            'uz' => ['title' => "Yoqilg‘i va organik birikmalar kimyoviy texnologiyasi"], 
            'en' => ['title' => "Yoqilg‘i va organik birikmalar kimyoviy texnologiyasi"],
        ];
        Faculty::create($data);
    }
}
