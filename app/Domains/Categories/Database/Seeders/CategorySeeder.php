<?php

namespace MVG\Domains\Categories\Database\Seeders;

use Illuminate\Database\Seeder;
use MVG\Domains\Categories\Models\Category;

/**
 * Class CategorySeeder
 *
 */
class CategorySeeder extends Seeder
{

    public function run()
    {
        factory(Category::class)->times(10)->create();
    }
}