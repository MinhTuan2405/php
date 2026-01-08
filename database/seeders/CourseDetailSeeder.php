<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseDetail;
use Illuminate\Database\Seeder;

class CourseDetailSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        if ($courses->isEmpty()) {
            $this->call(CourseSeeder::class);
            $courses = Course::all();
        }

        $courseDetails = [
            // Programming courses
            [
                'name' => 'PHP cơ bản - Tổng quan và cài đặt',
                'course_id' => $courses->where('name', 'Lập trình PHP cơ bản')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=OK_JCtrrv-c',
                'description' => 'Giới thiệu PHP, cài đặt môi trường và chạy chương trình đầu tiên',
            ],
            [
                'name' => 'PHP - Làm việc với form và cơ sở dữ liệu',
                'course_id' => $courses->where('name', 'Lập trình PHP cơ bản')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=OK_JCtrrv-c',
                'description' => 'Xử lý form, kết nối MySQL và thao tác CRUD bằng PHP',
            ],
            [
                'name' => 'JavaScript ES6 - Cơ bản đến nâng cao',
                'course_id' => $courses->where('name', 'Lập trình JavaScript (ES6)')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=PkZNo7MFNFg',
                'description' => 'Các tính năng ES6, hàm, promise và async/await',
            ],
            [
                'name' => 'Python cho người mới bắt đầu - Tổng quan',
                'course_id' => $courses->where('name', 'Python cho người mới bắt đầu')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=_uQrJ0TkZlc',
                'description' => 'Cài đặt Python, cú pháp cơ bản và ví dụ thực hành',
            ],
            [
                'name' => 'Laravel - Khởi tạo dự án và routing',
                'course_id' => $courses->where('name', 'Lập trình Laravel - Xây dựng ứng dụng')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=ImtZ5yENzgE',
                'description' => 'Tạo dự án Laravel, routing, controller và view cơ bản',
            ],
            // Toán 10: 3 CourseDetail
            [
                'name' => 'Giới thiệu Toán 10',
                'course_id' => $courses->where('name', 'Toán 10')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Học các khái niệm cơ bản của Toán lớp 10',
            ],
            [
                'name' => 'Đại số Toán 10',
                'course_id' => $courses->where('name', 'Toán 10')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Tìm hiểu về phương trình và bất phương trình',
            ],
            [
                'name' => 'Hình học Toán 10',
                'course_id' => $courses->where('name', 'Toán 10')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Học về vector và hình học không gian',
            ],
            // Vật Lý 11: 2 CourseDetail
            [
                'name' => 'Cơ học Vật Lý 11',
                'course_id' => $courses->where('name', 'Vật Lý 11')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Tìm hiểu các định luật cơ học cơ bản',
            ],
            [
                'name' => 'Điện học Vật Lý 11',
                'course_id' => $courses->where('name', 'Vật Lý 11')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Học về dòng điện và từ trường',
            ],
            // Hóa Học 12: 3 CourseDetail
            [
                'name' => 'Hóa học hữu cơ 12',
                'course_id' => $courses->where('name', 'Hóa Học 12')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Học các hợp chất hữu cơ và phản ứng hóa học',
            ],
            [
                'name' => 'Hóa học vô cơ 12',
                'course_id' => $courses->where('name', 'Hóa Học 12')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Tìm hiểu về các nguyên tố và hợp chất vô cơ',
            ],
            [
                'name' => 'Phản ứng hóa học 12',
                'course_id' => $courses->where('name', 'Hóa Học 12')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Học về tốc độ phản ứng và cân bằng hóa học',
            ],
            // Ngữ Văn 10: 2 CourseDetail
            [
                'name' => 'Phân tích văn học 10',
                'course_id' => $courses->where('name', 'Ngữ Văn 10')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Hiểu sâu về các tác phẩm văn học Việt Nam',
            ],
            [
                'name' => 'Ngữ pháp Văn 10',
                'course_id' => $courses->where('name', 'Ngữ Văn 10')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Học về cấu trúc câu và ngữ pháp tiếng Việt',
            ],
            // Tiếng Anh 11: 3 CourseDetail
            [
                'name' => 'Ngữ pháp Tiếng Anh 11',
                'course_id' => $courses->where('name', 'Tiếng Anh 11')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Nắm vững ngữ pháp và cấu trúc câu',
            ],
            [
                'name' => 'Từ vựng Tiếng Anh 11',
                'course_id' => $courses->where('name', 'Tiếng Anh 11')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Học từ vựng theo chủ đề',
            ],
            [
                'name' => 'Kỹ năng nghe Tiếng Anh 11',
                'course_id' => $courses->where('name', 'Tiếng Anh 11')->first()->id,
                'content' => 'https://www.youtube.com/watch?v=9IUwO66wi34',
                'description' => 'Luyện nghe và phản xạ tiếng Anh',
            ],
        ];

        foreach ($courseDetails as $detail) {
            CourseDetail::create($detail);
        }
    }
}
