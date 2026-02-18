<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class GalleryImageSeeder extends Seeder
{
    public function run(): void
    {
        $galleryData = [
            'st-anne-marie' => [
                ['path' => '/images/school/graduation.jpg', 'caption' => 'Graduation Ceremony'],
                ['path' => '/images/school/red_carpet_graduation.jpg', 'caption' => 'Red Carpet Event'],
                ['path' => '/images/school/student_celebration.jpg', 'caption' => 'Student Celebration'],
                ['path' => '/images/school/graduation_suits.jpg', 'caption' => 'Academic Excellence'],
                ['path' => '/images/school/st_anne_admin_front.jpg', 'caption' => 'Administration Building'],
                ['path' => '/images/school/st_anne_students_01.jpg', 'caption' => 'Our Students'],
                ['path' => '/images/school/outdoor_group.jpg', 'caption' => 'Outdoor Learning'],
                ['path' => '/images/school/library.jpg', 'caption' => 'Modern Library'],
                ['path' => '/images/school/st_anne_building_02.jpg', 'caption' => 'School Facilities'],
                ['path' => '/images/school/st_anne_buses_01.jpg', 'caption' => 'School Transport'],
                ['path' => '/images/school/trip_ruaha.jpg', 'caption' => 'Educational Tours'],
                ['path' => '/images/school/class_auditorium.jpg', 'caption' => 'Learning Environment'],
            ],
            'brilliant' => [
                ['path' => '/images/school/brilliant_entrance.jpg', 'caption' => 'Brilliant Secondary Entrance'],
                ['path' => '/images/school/brilliant_campus_01.jpg', 'caption' => 'Brilliant Campus'],
                ['path' => '/images/school/brilliant_gallery_03.jpg', 'caption' => 'Campus Life'],
                ['path' => '/images/school/brilliant_gallery_04.jpg', 'caption' => 'Student Activities'],
                ['path' => '/images/school/brilliant_gallery_06.jpg', 'caption' => 'School Community'],
            ],
            'sunshine' => [
                ['path' => '/images/school/sunshine_students_building.jpg', 'caption' => 'Sunshine Secondary Campus'],
                ['path' => '/images/school/sunshine_girls_green.jpg', 'caption' => 'Sunshine Students'],
            ],
            'rweikiza' => [
                ['path' => '/images/rweikiza/rweikiza_students_01.jpg', 'caption' => 'Rweikiza Nursery Scholars'],
                ['path' => '/images/school/rweikiza_primary_front.jpg', 'caption' => 'Rweikiza Primary Entrance'],
                ['path' => '/images/school/rweikiza_profile.jpg', 'caption' => 'Play Time'],
                ['path' => '/images/school/rweikiza_gallery_01.jpg', 'caption' => 'Learning Activities'],
                ['path' => '/images/school/rweikiza_gallery_02.jpg', 'caption' => 'School Transport'],
                ['path' => '/images/school/rweikiza_gallery_03.jpg', 'caption' => 'Academic Excursion'],
            ],
        ];

        foreach ($galleryData as $campusId => $images) {
            foreach ($images as $index => $imageData) {
                GalleryImage::updateOrCreate(
                    ['image_path' => $imageData['path']],
                    [
                        'campus_id' => $campusId,
                        'caption' => $imageData['caption'],
                        'order' => $index + 1,
                    ]
                );
            }
        }
    }
}
