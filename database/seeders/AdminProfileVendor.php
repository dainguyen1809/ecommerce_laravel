<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminProfileVendor extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {

        $user = User::where('email', 'admin@gmail.com')->first();
        $vendor = new Vendor();
        $vendor->banner = 'images/vendors/banner_665847aad92a0_vendor_3.jpg';
        $vendor->phone = '0987123456';
        $vendor->email = 'admin@gmail.com';
        $vendor->address = 'Ho Chi Minh City';
        $vendor->description = 'Vendor Description';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
