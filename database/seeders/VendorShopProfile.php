<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorShopProfile extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $user = User::where('email', 'vendor@gmail.com')->first();
        $vendor = new Vendor();
        $vendor->banner = 'images/vendors/banner_665847aad92a0_vendor_3.jpg';
        $vendor->shop_name = 'Vendor Shop';
        $vendor->phone = '0987123456';
        $vendor->email = 'vendor@gmail.com';
        $vendor->address = 'Ho Chi Minh City';
        $vendor->description = 'Shop Description';
        $vendor->user_id = $user->id;
        $vendor->status = 1;
        $vendor->save();
    }
}
