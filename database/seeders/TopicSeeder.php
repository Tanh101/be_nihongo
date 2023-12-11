<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = [
            [
                'name' => 'Gia đình (かぞく):',
                'description' => 'Cách xưng hô và mối quan hệ giữa các thành viên trong gia đình',
            ],
            [
                'name' => 'Cảm xúc và cảm giác (きもち)',
                'description' => 'Các từ vựng về cảm xúc và cảm giác',
            ],
            [
                'name' => 'Thời tiết (てんき)',
                'description' => 'Các từ vựng về thời tiết và các hiện tượng tự nhiên',
            ],
            [
                'name' => 'Địa điểm (ばしょ)',
                'description' => 'Các từ vựng liên quan đến địa điểm, thành phố, quốc gia',
            ],
            [
                'name' => 'Sở thích và giải trí (しゅみ)',
                'description' => 'Thể thao, âm nhạc, điện ảnh, sách và các sở thích khác',
            ],
            [
                'name' => 'Du lịch (りょこう)',
                'description' => 'Đặt phòng khách sạn, đặc sản địa phương và trải nghiệm du lịch',
            ],
            [
                'name' => 'Giáo dục (きょういく)',
                'description' => 'Trường học, môn học, giáo viên và hệ thống giáo dục',
            ],
            [
                'name' => 'Sức khỏe (けんこう)',
                'description' => 'Bệnh tật, thể dục, dinh dưỡng và cuộc sống lành mạnh',
            ],
            [
                'name' => 'Ẩm thực (たべもの)',
                'description' => 'Món ăn, nhà hàng, nấu ăn và đặc sản',
            ],
            [
                'name' => 'Khoa học và công nghệ (かがく と てち)',
                'description' => 'Khám phá khoa học, thiết bị công nghệ và ảnh hưởng của công nghệ',
            ],
        ];

        foreach ($topics as $topic) {
            Topic::create($topic);
        }
    }
}
