<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // -----------------------------
        // 1. Add admin user
        // -----------------------------
        User::firstOrCreate(
            ['email' => 'dyper777@gmail.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('password123'),
            ]
        );

        // -----------------------------
        // 2. Software Products
        // -----------------------------
        $products = [
            [
                'name' => 'Windows 11 Pro',
                'price' => 199.00,
                'description' => 'Windows 11 Pro is a premium operating system designed for professionals...',
                'image' => 'assets/img/winddow11.jpg',
            ],
            [
                'name' => 'Microsoft Office (Microsoft 365)',
                'price' => 149.00,
                'description' => 'Microsoft 365 is a suite of productivity tools including Word, Excel, and PowerPoint.',
                'image' => 'assets/img/microsoftoffice.jpg',
            ],
            [
                'name' => 'Adobe Acrobat Pro DC',
                'price' => 19.99,
                'description' => 'Adobe Acrobat Pro DC offers tools for editing, signing, and managing PDF documents.',
                'image' => 'assets/img/adobeacrobatprodc.jpg',
            ],
            [
                'name' => 'Antivirus Software',
                'price' => 29.99,
                'description' => 'Antivirus software prevents, detects, and removes malware and online threats.',
                'image' => 'assets/img/antivirus.jpg',
            ],
            [
                'name' => 'MikroTik',
                'price' => 45.00,
                'description' => 'MikroTik offers routers, switches, and wireless systems for networks.',
                'image' => 'assets/img/microtik.jpg',
            ],
            [
                'name' => 'Linux',
                'price' => 15.00,
                'description' => 'Linux is a popular open-source operating system used worldwide.',
                'image' => 'assets/img/linik.jpg',
            ],
            [
                'name' => 'AutoCAD',
                'price' => 1430.00,
                'description' => 'AutoCAD is advanced 2D and 3D CAD software used for drafting and modeling.',
                'image' => 'assets/img/autodesk.jpg',
            ],
            [
                'name' => 'Maxon Cinema 4D',
                'price' => 719.88,
                'description' => 'Cinema 4D is 3D modeling, animation, and rendering software widely used in motion graphics.',
                'image' => 'assets/img/maxoncinema.jpg',
            ],
            [
                'name' => 'Adobe Illustrator',
                'price' => 20.99,
                'description' => 'Adobe Illustrator is the industry-leading vector graphics design tool.',
                'image' => 'assets/img/adobeillustrator.jpg',
            ],
            [
                'name' => 'Adobe Animate',
                'price' => 35.00,
                'description' => 'Adobe Animate is a 2D animation software for interactive and animated content.',
                'image' => 'assets/img/adobeanimate.jpg',
            ],
        ];

        // -----------------------------
        // 3. Insert products
        // -----------------------------
        foreach ($products as $item) {
            Product::create($item);
        }

        echo "Seeder completed successfully.\n";
    }
}
