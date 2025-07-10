<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
            ]);
        }

        $categories = [
            [
                'name' => 'Music & Concerts',
                'description' => 'Musical events, concerts, and performances',
                'color' => '#8B5CF6',
                'icon' => 'fas fa-music',
                'created_by' => $user->id,
                'sort_order' => 1,
            ],
            [
                'name' => 'Technology',
                'description' => 'Tech conferences, workshops, and meetups',
                'color' => '#3B82F6',
                'icon' => 'fas fa-laptop',
                'created_by' => $user->id,
                'sort_order' => 2,
            ],
            [
                'name' => 'Food & Dining',
                'description' => 'Food festivals, dining events, and culinary experiences',
                'color' => '#EF4444',
                'icon' => 'fas fa-utensils',
                'created_by' => $user->id,
                'sort_order' => 3,
            ],
            [
                'name' => 'Sports & Fitness',
                'description' => 'Sports events, fitness classes, and competitions',
                'color' => '#10B981',
                'icon' => 'fas fa-dumbbell',
                'created_by' => $user->id,
                'sort_order' => 4,
            ],
            [
                'name' => 'Arts & Culture',
                'description' => 'Art exhibitions, cultural events, and creative workshops',
                'color' => '#F59E0B',
                'icon' => 'fas fa-palette',
                'created_by' => $user->id,
                'sort_order' => 5,
            ],
            [
                'name' => 'Business & Networking',
                'description' => 'Business events, networking sessions, and professional meetups',
                'color' => '#6366F1',
                'icon' => 'fas fa-briefcase',
                'created_by' => $user->id,
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}