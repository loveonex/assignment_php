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
        DB::table('products')->insert($this->productSeeder());
        DB::table('banners')->insert($this->bannerSeeder());
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

    public function productSeeder(){
        $arrCates = ['Iphone', 'Samsung', 'Oppo', 'Nokia', 'Xiaomi', 'Realmi'];
        $arrProducts = [];
        $arrImages = [
            'https://cdn.hoanghamobile.com/i/preview/Uploads/2021/09/15/image-removebg-preview-10.png',
            'https://cdn.hoanghamobile.com/i/preview/Uploads/2022/04/10/image-removebg-preview-4.png',
            'https://cdn.hoanghamobile.com/i/preview/Uploads/2021/12/02/image-removebg-preview-9.png',
            'https://cdn.hoanghamobile.com/i/preview/Uploads/2022/03/01/nokia-g21-3.png',
            'https://cdn.hoanghamobile.com/i/preview/Uploads/2021/03/16/image-removebg-preview-3.png',
            'https://cdn.hoanghamobile.com/i/preview/Uploads/2021/04/26/image-removebg-preview-11.png'
        ];
        for ($i=0; $i < 5; $i++) { 
            $arrProducts[] = [
                'name' => 'Điện thoại ' . $arrCates[$i],
                'cate_id' => $i + 1,
                'image' => $arrImages[$i],
                'price' => rand(10000000, 20000000),
                'description_short' => 'Điện thoại ' . $arrCates[$i],
                'description' => '',
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        return $arrProducts;
    }

    public function bannerSeeder(){
        $arrBanner = [];
        $arrImages = [
            'https://vi.pngtree.com/freebackground/cool-new-mobile-phone-promotion-purple-banner_1006678.html',
            'https://artcity.vn/thiet-ke-banner-quang-cao-dien-thoai/',
            'http://thuthuatphanmem.vn/nhung-banner-quang-cao-dep-nhat/'
        ];

        $count = count($arrImages);

        for ($i=0; $i < $count; $i++) { 
            $arrBanner[] = [
                'name' => 'banner ' . $i,
                'image' => $arrImages[$i],
                'url' => $arrImages[$i],
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        return $arrBanner;
    }

}
