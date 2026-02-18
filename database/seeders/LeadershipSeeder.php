<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;
use App\Models\Campus;

class LeadershipSeeder extends Seeder
{
    public function run()
    {
        $leadership = [
            [
                'campus_id' => 1,
                'name' => 'Dr. Jasson Rweikiza',
                'title' => 'Director',
                'category' => 'leadership',
                'image' => '/images/staff/director_new.jpg',
                'bio' => 'Dr. Jasson Rweikiza is the visionary director of St. Anne Marie Academy Schools, dedicated to providing quality education in Tanzania.',
                'order' => 1,
            ],
            [
                'campus_id' => 1,
                'name' => 'Headmaster - St. Anne Marie Academy',
                'title' => 'Headmaster',
                'category' => 'leadership',
                'image' => '/images/staff/headmaster_st_anne_marie_new.jpg',
                'bio' => 'Leading St. Anne Marie Academy with a focus on academic excellence and moral integrity.',
                'order' => 2,
            ],
            [
                'campus_id' => 2,
                'name' => 'Headmaster - Brilliant Secondary',
                'title' => 'Headmaster',
                'category' => 'leadership',
                'image' => '/images/staff/headmaster_brilliant_new.jpg',
                'bio' => 'Committed to nurturing the next generation of leaders at Brilliant Secondary School.',
                'order' => 1,
            ],
            [
                'campus_id' => 3,
                'name' => 'Headmaster - Sunshine Secondary',
                'title' => 'Headmaster',
                'category' => 'leadership',
                'image' => '/images/staff/headmaster_sunshine_new.jpg',
                'bio' => 'Fostering a culture of innovation and excellence at Sunshine Secondary School.',
                'order' => 1,
            ],
            [
                'campus_id' => 4,
                'name' => 'Headmaster - Rweikiza Primary',
                'title' => 'Headmaster',
                'category' => 'leadership',
                'image' => '/images/staff/headmaster_rweikiza_new.jpg',
                'bio' => 'Building a strong foundation for young learners at Rweikiza Nursery & Primary School.',
                'order' => 1,
            ],
        ];

        foreach ($leadership as $data) {
            Staff::updateOrCreate(
                ['name' => $data['name'], 'campus_id' => $data['campus_id']],
                $data
            );
        }
    }
}
