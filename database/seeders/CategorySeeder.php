<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [];

        $categories = [
            'Assistance',
            'Eloquent',
            'Envoyer',
            'Feedback',
            'Forge',
            'General',
            'Guides',
            'JavaScript',
            'Laravel',
            'Livewire',
            'Lumen',
            'Mix',
            'Nova',
            'Requests',
            'Servers',
            'Spark',
            'Testing',
            'Tips',
            'Vapor',
            'Vue'
        ];

        foreach ($categories as $category)
            array_push($data, ['name' => $category, 'slug' => strtolower($category)]);

        Category::insert($data);
    }
}
