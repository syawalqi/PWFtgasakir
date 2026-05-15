<?php

namespace Database\Seeders;

use App\Models\ComplaintCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Infrastruktur', 'Kebersihan', 'Keamanan', 'Pelayanan', 'Lainnya'];

        foreach ($categories as $name) {
            ComplaintCategory::create(['name' => $name]);
        }
    }
}
