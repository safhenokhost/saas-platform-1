<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfileField;

class ProfileFieldSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [
            [
                'key' => 'full_name',
                'label' => 'نام و نام خانوادگی',
                'type' => 'text',
                'required' => true,
                'active' => true,
            ],
            [
                'key' => 'mobile',
                'label' => 'شماره موبایل',
                'type' => 'mobile',
                'required' => true,
                'active' => true,
            ],
            [
                'key' => 'postal_code',
                'label' => 'کد پستی',
                'type' => 'postal_code',
                'required' => true,
                'active' => true,
            ],
            [
                'key' => 'address',
                'label' => 'آدرس کامل',
                'type' => 'textarea',
                'required' => true,
                'active' => true,
            ],
            [
                'key' => 'location',
                'label' => 'موقعیت مکانی (نقشه)',
                'type' => 'map',
                'required' => false,
                'active' => true,
            ],
            [
                'key' => 'avatar',
                'label' => 'عکس پروفایل',
                'type' => 'image',
                'required' => false,
                'active' => true,
            ],
            [
                'key' => 'password',
                'label' => 'رمز عبور',
                'type' => 'password',
                'required' => true,
                'active' => true,
            ],
        ];

        foreach ($fields as $field) {
            ProfileField::updateOrCreate(
                ['key' => $field['key']],
                $field
            );
        }
    }
}
