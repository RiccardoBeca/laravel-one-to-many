<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            'PHP',
            'Laravel',
            'JavaScript',
            'HTML',
            'CSS',
            'VueJs'
        ];

        
        
        foreach ($data as $name) {
            
            $new_category = new Category();
            $new_category->name = $name;
            $new_category->save();

        };
    }
}
