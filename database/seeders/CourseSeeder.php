<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        $courses = [
            // Programming courses
            [
                'name' => 'Lập trình PHP cơ bản',
                'category_id' => ($categories->where('name', 'Lập trình')->first()->id ?? null),
                'grade' => 'N/A',
                'price' => 400000,
                'is_deleted' => false,
            ],
            [
                'name' => 'Lập trình JavaScript (ES6)',
                'category_id' => ($categories->where('name', 'Lập trình')->first()->id ?? null),
                'grade' => 'N/A',
                'price' => 450000,
                'is_deleted' => false,
            ],
            [
                'name' => 'Python cho người mới bắt đầu',
                'category_id' => ($categories->where('name', 'Lập trình')->first()->id ?? null),
                'grade' => 'N/A',
                'price' => 350000,
                'is_deleted' => false,
            ],
            [
                'name' => 'Lập trình Laravel - Xây dựng ứng dụng',
                'category_id' => ($categories->where('name', 'Lập trình')->first()->id ?? null),
                'grade' => 'N/A',
                'price' => 600000,
                'is_deleted' => false,
            ],
            [
                'name' => 'Toán 10',
                'category_id' => $categories->where('name', 'Toán')->first()->id,
                'grade' => '10',
                'price' => 300000,
                'is_deleted' => false,
            ],
            [
                'name' => 'Vật Lý 11',
                'category_id' => $categories->where('name', 'Lý')->first()->id,
                'grade' => '11',
                'price' => 500000,
                'is_deleted' => false,
            ],
            [
                'name' => 'Hóa Học 12',
                'category_id' => $categories->where('name', 'Hóa')->first()->id,
                'grade' => '12',
                'price' => 250000,
                'is_deleted' => false,
            ],
            [
                'name' => 'Ngữ Văn 10',
                'category_id' => $categories->where('name', 'Văn')->first()->id,
                'grade' => '10',
                'price' => 190000,
                'is_deleted' => false,
            ],
            [
                'name' => 'Tiếng Anh 11',
                'category_id' => $categories->where('name', 'Anh')->first()->id,
                'grade' => '11',
                'price' => 280000,
                'is_deleted' => false,
            ],
            
        ];
        
        $laptrinh = $categories->where('name', 'Lập trình')->first();
        if (!$laptrinh) {
            $laptrinh = Category::create(['name' => 'Lập trình']);
            $categories = Category::all();
        }

        foreach ($courses as &$c) {
            if (in_array($c['name'], ['Lập trình PHP cơ bản', 'Lập trình JavaScript (ES6)', 'Python cho người mới bắt đầu', 'Lập trình Laravel - Xây dựng ứng dụng'])) {
                $c['category_id'] = $laptrinh->id;
            }
        }
        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
