<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert($this->roleSeeder());
        DB::table('users')->insert($this->userSeeder());
        DB::table('categories')->insert($this->cateSeeder());
    }

    public function userSeeder(){
        $fullname = [];
        $arr = [];
        $ho = ['Nguyễn', 'Phạm', 'Hồ', 'Chu', 'Lê'];
        $ten_dem = ['Văn', 'Trọng', 'Khắc', 'Minh', 'Bảo'];
        $ten = ['Hà', 'Nam', 'Long', 'Việt', 'Hùng'];
        for ($i=0; $i < 10; $i++) {
            $a = rand(0,4);
            $b = rand(0,4);
            $c = rand(0,4);
            $name = $ho[$a] . ' ' .$ten_dem[$b] . ' ' . $ten[$c];
            $fullname[] = $name;
        }

        for ($j=0; $j < 10; $j++) {
            $arr[] = [
                'name' => $fullname[$j],
                'email' => 'abcxyz'.$j.'@gmail.com',
                'password' => Hash::make('123456'),
                'role_id' => rand(1,2),
                'status' => 1
            ];
        }
        return $arr;
    }

    public function roleSeeder(){
        $arrRoles = [
            [
                'name' => 'admin',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'customer',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];
        return $arrRoles;
    }

    public function cateSeeder(){
        $arrCates = ['Iphone', 'Samsung', 'Oppo', 'Nokia', 'Xiaomi', 'Realmi'];
        $count = count($arrCates);
        $arrCatesSeed = [];
        for ($i = 0; $i < $count; $i++){
            $arrCatesSeed[] = [
                'name' => $arrCates[$i],
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        return $arrCatesSeed;
    }

}
