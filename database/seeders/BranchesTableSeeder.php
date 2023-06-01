<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Database\Seeder;

class BranchesTableSeeder extends Seeder
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
            
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "MK",
            'uz' => ['title' => "Menejment va kasb ta'lim"], 
            'en' => ['title' => "Menejment va kasb ta'lim"],
        ];
        $branch = Branch::create($data);

        
        
        $dData = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'organization_id'=>1,
            'branch_id'=>$branch->id,
            'uz' => ['title' => "Menejment va kasb ta'lim"],
            'en' => ['title' => "Menejment va kasb ta'lim"],
        ];
        $department = Department::create($dData);

        $data = [
            'organization_id' => 1,
            
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "OO",
            'uz' => ['title' => 'Oziq ovqat mahsulotlari texnologiyasi'], 
            'en' => ['title' => 'Oziq ovqat mahsulotlari texnologiyasi'],
        ];
        $branch = Branch::create($data);
        
        $dData = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'organization_id'=>1,
            'branch_id'=>$branch->id,
            'uz' => ['title' => "Oziq ovqat mahsulotlari texnologiyasi"],
            'en' => ['title' => "Oziq ovqat mahsulotlari texnologiyasi"],
        ];
        $department = Department::create($dData);

        $data = [
            'organization_id' => 1,    
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "NM",
            'uz' => ['title' => 'Noorganik moddalar texnologiyasi'], 
            'en' => ['title' => 'Noorganik moddalar texnologiyasi'],
        ];
        $branch = Branch::create($data);
        
        $dData = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'organization_id'=>1,
            'branch_id'=>$branch->id,
            'uz' => ['title' => "Noorganik moddalar texnologiyasi"],
            'en' => ['title' => "Noorganik moddalar texnologiyasi"],
        ];
        $department = Department::create($dData);

        $data = [
            'organization_id' => 1,
            
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "VT",
            'uz' => ['title' => "Vinochilik texnologiyasi va sanoat uzumchilik"], 
            'en' => ['title' => "Vinochilik texnologiyasi va sanoat uzumchilik"],
        ];
        $branch = Branch::create($data);
        
        $dData = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'organization_id'=>1,
            'branch_id'=>$branch->id,
            'uz' => ['title' => "Vinochilik texnologiyasi va sanoat uzumchilik"],
            'en' => ['title' => "Vinochilik texnologiyasi va sanoat uzumchilik"],
        ];
        $department = Department::create($dData);

        $data = [
            'organization_id' => 1,
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "TY",
            'uz' => ['title' => "Talabalar yotoqxonasi"], 
            'en' => ['title' => "Talabalar yotoqxonasi"],
        ];
        $branch = Branch::create($data);
        
        $dData = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'organization_id'=>1,
            'branch_id'=>$branch->id,
            'uz' => ['title' => "Talabalar yotoqxonasi"],
            'en' => ['title' => "Talabalar yotoqxonasi"],
        ];
        $department = Department::create($dData);

        $data = [
            'organization_id' => 1,
            
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'code' => "YOBKT",
            'uz' => ['title' => "Yoqilg‘i va organik birikmalar kimyoviy texnologiyasi"], 
            'en' => ['title' => "Yoqilg‘i va organik birikmalar kimyoviy texnologiyasi"],
        ];
        $branch = Branch::create($data);
        
        $dData = [
            'isActive' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'organization_id'=>1,
            'branch_id'=>$branch->id,
            'uz' => ['title' => "Yoqilg‘i va organik birikmalar kimyoviy texnologiyasi"],
            'en' => ['title' => "Yoqilg‘i va organik birikmalar kimyoviy texnologiyasi"],
        ];
        $department = Department::create($dData);
        
    }
}
