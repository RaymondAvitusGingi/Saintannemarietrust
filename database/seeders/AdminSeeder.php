<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        User::updateOrCreate(
            ['email' => 'saintannemarietrustadmin123@gmail.com'],
            [
                'name' => 'Administrator',
                'email' => 'saintannemarietrustadmin123@gmail.com',
                'password' => Hash::make('Admin789'),
                'is_admin' => true,
            ]
        );

        // Seed initial news articles from the existing data
        $newsItems = [
            [
                'title' => "Grand Graduation Ceremony 2025",
                'slug' => 'graduation-2025',
                'summary' => "Congratulations to our Class of 2025! Students walked the red carpet in their graduation gowns, celebrating years of hard work, discipline, and academic success.",
                'content' => "The St. Anne Marie Academy proudly celebrated the graduation of our 2025 Class in a memorable ceremony attended by parents, staff, and distinguished guests.\n\nOur graduates achieved outstanding results, reflecting years of dedication and the school's commitment to excellence. The ceremony featured inspiring speeches, the presentation of certificates, and special awards for academic and leadership milestones.\n\nWe are immensely proud of our graduates' achievements and wish them continued success in their future endeavors. They carry with them the values of integrity and professionalism that define St. Anne Marie Academy.",
                'image' => "/images/news/graduation_2025.jpg",
                'category' => 'Academic',
                'location' => 'Main Campus Grounds',
                'author' => 'Admin',
                'published_at' => now()->subDays(30),
                'is_published' => true,
            ],
            [
                'title' => "Sunshine Secondary Ranked #1 in Kibaha Region!",
                'slug' => 'sunshine-ranking-2025',
                'summary' => "Incredible achievement! Sunshine Secondary School has been ranked 1st out of 44 schools in the Kibaha Town Council (TC) for the district-level mock exams.",
                'content' => "We are thrilled to celebrate the success of Sunshine Secondary School! In the latest regional mock examinations, our students and staff achieved an outstanding feat:\n\n- Ranked 1st out of 44 schools in Kibaha Town Council.\n- Over 200 students achieved Division One in Form 2.\n- Form 4 results showing 271 students with Division One and only 6 with Division Two.\n- A clean sweep of results across Form 2 and Form 4 cohorts.\n\nApplications for 'Pre-Form One' and 'Form One' for 2026 are now open! Join the school of excellence.",
                'image' => "/images/school/sunshine_results_2021_2024.jpg",
                'category' => 'Recognition',
                'location' => 'Kibaha',
                'author' => 'Admin',
                'published_at' => now()->subDays(60),
                'is_published' => true,
            ],
            [
                'title' => "Outstanding 2025 PSLE Results: Grade 'A' Average!",
                'slug' => 'psle-results-2025',
                'summary' => "We are proud to announce our exceptional performance in the 2025 PSLE exams, achieving a Grade 'A' school average with 148 students scoring 'A's.",
                'content' => "St. Anne Marie Pre and Primary School has once again demonstrated its academic prowess in the 2025 Primary School Leaving Examination (PSLE) Results.\n\nWith a total of 162 candidates, our school achieved a remarkable Grade 'A' average. The breakdown of results is truly impressive:\n- 148 students achieved Grade 'A'\n- 13 students achieved Grade 'B'\n- 1 student achieved Grade 'C'\n\nThis success is a testament to the dedication of our students, the hard work of our teaching staff, and the unwavering support of our parent community. We continue to live up to our motto: 'Towards Excellence'.",
                'image' => "/images/news/psle_results_2025.jpg",
                'category' => 'Academic',
                'location' => 'All Campuses',
                'author' => 'Admin',
                'published_at' => now()->subDays(10),
                'is_published' => true,
            ],
            [
                'title' => "Study Tour: Ruaha National Park",
                'slug' => 'ruaha-tour-2024',
                'summary' => "Our students embarked on an educational tour to Ruaha National Park, witnessing majestic wildlife firsthand in an unforgettable learning experience.",
                'content' => "Our students embarked on an educational tour to Ruaha National Park. Witnessing the majestic giraffes and diverse wildlife firsthand was an unforgettable experience that brought their geography and biology lessons to life.\n\nThe tour provided students with deep insights into Tanzania's rich biodiversity and the importance of conservation. From observing animal behavior to understanding the ecosystem of the Great Ruaha River, it was a day filled with discovery and awe.",
                'image' => "/images/news/ruaha_2024.jpg",
                'category' => 'Excursion',
                'location' => 'Ruaha National Park',
                'author' => 'Admin',
                'published_at' => now()->subDays(120),
                'is_published' => true,
            ],
        ];

        foreach ($newsItems as $item) {
            News::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }

        $this->command->info('Admin user and sample news created successfully!');
        $this->command->info('Admin credentials: saintannemarietrustadmin123@gmail.com / Admin789');
    }
}
