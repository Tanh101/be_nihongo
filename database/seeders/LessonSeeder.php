<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lessons = [
            [
                "topic_id" => 1,
                "title" => "Anh Chị Em",
                "description" => "Cách xưng hô giữa các thành viên trong gia đình",
            ],
            [
                "topic_id" => 1,
                "title" => "Ông bà, Cô chú",
                "description" => "Cách xưng hô giữa các thành viên trong gia đình",
            ],
            [
                'topic_id' => 1,
                'title' => 'Con cái và cháu',
                'description' => 'Cách xưng hô với con cháu',
            ],
            [
                "topic_id" => 2,
                'title' => 'Từ vựng về cảm xúc',
                'description' => 'Học các từ vựng về cảm xúc con người',
            ],
            [
                "topic_id" => 2,
                'title' => 'Từ vựng về cảm giác',
                'description' => 'Các từ vựng về cảm giác',
            ],
            [
                "topic_id" => 3,
                'title' => 'Các Từ Vựng về Thời Tiết',
                'description' => 'Học các từ vựng liên quan đến các điều kiện thời tiết khác nhau.',
            ],
            [
                "topic_id" => 3,
                'title' => 'Miêu Tả Thời Tiết',
                'description' => 'Thực hành miêu tả về thời tiết trong tiếng Nhật.',
            ],
            [
                "topic_id" => 3,
                'title' => 'Hiện Tượng Tự Nhiên',
                'description' => 'Tìm hiểu về từ vựng và mô tả về các hiện tượng tự nhiên như mưa, tuyết, sấm.',
            ],
            [
                "topic_id" => 4,
                'title' => 'Thành phố và Quốc gia',
                'description' => 'Học từ vựng về các thành phố và quốc gia trên thế giới.',
            ],
            [
                "topic_id" => 4,
                'title' => 'Mô tả Địa Điểm',
                'description' => 'Thực hành miêu tả về địa điểm và cảnh đẹp.',
            ],
            [
                "topic_id" => 4,
                'title' => 'Thảo luận về Du lịch',
                'description' => 'Thảo luận về những địa điểm du lịch và trải nghiệm.',
            ],
            [
                "topic_id" => 5,
                'title' => 'Sở Thích Cá Nhân',
                'description' => 'Nói về sở thích cá nhân và hoạt động giải trí yêu thích.',
            ],
            [
                "topic_id" => 5,
                'title' => 'Âm Nhạc và Điện Ảnh',
                'description' => 'Tìm hiểu từ vựng liên quan đến âm nhạc và điện ảnh.',
            ],
            [
                "topic_id" => 5,
                'title' => 'Thực Hành Sở Thích',
                'description' => 'Thực hành bằng cách thảo luận về sở thích và kỹ năng cá nhân.',
            ],
            [
                "topic_id" => 6,
                'title' => 'Sở Thích Cá Nhân',
                'description' => 'Nói về sở thích cá nhân và hoạt động giải trí yêu thích.',
            ],
            [
                "topic_id" => 6,
                'title' => 'Âm Nhạc và Điện Ảnh',
                'description' => 'Tìm hiểu từ vựng liên quan đến âm nhạc và điện ảnh.',
            ],
            [
                'topic_id' => 6,
                'title' => 'Thực Hành Sở Thích',
                'description' => 'Thực hành bằng cách thảo luận về sở thích và kỹ năng cá nhân.',
            ],
            [
                'topic_id' => 7,
                'title' => 'Hệ Thống Giáo Dục',
                'description' => 'Tìm hiểu về hệ thống giáo dục tại Nhật Bản và các mức độ học.',
            ],
            [
                'topic_id' => 7,
                'title' => 'Mô tả Môn Học',
                'description' => 'Học từ vựng liên quan đến các môn học và mô tả chúng.',
            ],
            [
                'topic_id' => 8,
                'title' => 'Bệnh Tật và Triệu Chứng',
                'description' => 'Học từ vựng về các bệnh tật phổ biến và triệu chứng.',
            ],
            [
                'topic_id' => 8,
                'title' => 'Thể Dục và Hoạt Động Fisical',
                'description' => 'Thảo luận về lợi ích của thể dục và hoạt động vận động.',
            ],
            [
                'topic_id' => 8,
                'title' => 'Dinh Dưỡng Sức Khỏe',
                'description' => 'Tìm hiểu về dinh dưỡng và cách duy trì cuộc sống lành mạnh.',
            ],
            [
                'topic_id' => 9,
                'title' => 'Món Ăn Phổ Biến',
                'description' => 'Học từ vựng về các món ăn phổ biến trong ẩm thực Nhật Bản.',
            ],
            [
                'topic_id' => 9,
                'title' => 'Nhà Hàng và Đặt Bàn',
                'description' => 'Thực hành các từ vựng liên quan đến nhà hàng và cách đặt bàn.',
            ],
            [
                'topic_id' => 9,
                'title' => 'Nấu Ăn Cơ Bản',
                'description' => 'Học từ vựng và cụm từ liên quan đến nấu ăn và các kỹ thuật cơ bản.',
            ],


        ];
        foreach ($lessons as $lesson) {
            Lesson::create($lesson);
        }
    }
}
