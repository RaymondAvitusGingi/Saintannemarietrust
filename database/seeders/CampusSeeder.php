<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Seeder;

class CampusSeeder extends Seeder
{
    public function run(): void
    {
        $campuses = [
            [
                'slug' => 'st-anne-marie',
                'name' => 'St. Anne Marie Academy',
                'email' => 'stannemarieacademy@gmail.com',
                'instagram' => 'https://www.instagram.com/st.annemarieacademy',
                'level' => 'Nursery to Form 6',
                'motto' => 'Towards Excellence',
                'description' => 'St Anne Marie Academy is a private co-educational boarding and day school in Mbezi Kimara. We offer a comprehensive educational journey from Nursery and Primary levels to Secondary and Advanced Level (High School), covering Arts, Science, and Business streams.',
                'image' => '/images/school/campus_main.jpg',
                'logo' => '/images/school/logo_st_anne_official.jpg',
                'ranking' => 'Consistent Top NECTA Performance (District, Region & National)',
                'location' => 'Mbezi kimara kwa msuguri, Dar es Salaam',
                'address' => 'P.O.BOX 31373',
                'acreage' => '75 Acres',
                'registration' => 'St. Anne Marie Academy',
                'phone' => '+255 686 586 426 / +255 654 995 711',
                'mission' => 'To be a model school providing high quality education service founded on commitment, integrity and professionalism.',
                'vision' => 'Superb Education',
                'headmaster' => 'Headmaster Office - St. Anne Marie',
                'combinations' => 'Arts, Science, Business, and Information Computer Studies (ICS). Combinations: PCM, PCB, PGM, CBN, CBG, HGK, HGL, HKL, HGF, HGE, EGM, KLF, HLF, BuLF, FLE, EBuAc, MEBu, BuEL',
                'history' => 'Located on 75 acres of serene environment, the Academy provides library facilities, science laboratories, and qualified teachers aimed at supporting student success.',
                'environment' => 'A supportive and friendly learning environment emphasizing academic achievement and discipline.',
                'rules' => [
                    'Punctuality is mandatory; students must report by 7:30 AM.',
                    'English and Swahili are used for instruction.',
                    'Smartness is mandatory; short haircuts for all.',
                    'Mobile phones are strictly prohibited.',
                    'Medical insurance is compulsory for all students.'
                ],
                'routine' => [
                    ['time' => '7:30 AM', 'activity' => 'Assembly'],
                    ['time' => '8:00 AM', 'activity' => 'Morning Lessons'],
                    ['time' => '1:00 PM', 'activity' => 'Lunch Break'],
                    ['time' => '4:00 PM', 'activity' => 'Sports & Recreation']
                ],
                'order' => 1
            ],
            [
                'slug' => 'brilliant',
                'name' => 'Brilliant Secondary School',
                'email' => 'brilliantsecondary21@gmail.com',
                'instagram' => 'https://www.instagram.com/brilliantsecondaryschool',
                'level' => 'Form 1 to Form 4',
                'motto' => 'Arise and Shine',
                'description' => 'A premier secondary school for boys and girls emphasizing science and commerce streams with modern laboratories.',
                'image' => '/images/school/brilliant_maroon_skirts.jpg',
                'logo' => '/images/school/logo_brilliant_new.png',
                'ranking' => 'Top 10 National Ranking in 2024 NECTA Result',
                'location' => 'Mbezi kimara kwa msuguri, Dar es Salaam',
                'address' => 'P.O.BOX 31373',
                'acreage' => 'Shared Complex',
                'registration' => 'Brilliant Secondary School',
                'phone' => '0784 411 113',
                'order' => 2
            ],
            [
                'slug' => 'sunshine',
                'name' => 'Sunshine Secondary School',
                'email' => 'sunshinepwani@gmail.com',
                'instagram' => 'https://www.instagram.com/sunshine.secondary.school',
                'level' => 'Form 1 to Form 4',
                'motto' => 'Let Your Light Shine',
                'description' => 'Sunshine Secondary School is located in Kibaha, providing a quiet and conducive environment for focused secondary education.',
                'image' => '/images/school/sunshine_student_group_large.jpg',
                'logo' => '/images/school/logo_sunshine_new.jpg',
                'ranking' => 'Ranked #1 in Kibaha MC (Mock 2025)',
                'location' => 'Kibaha picha ya ndege, Pwani',
                'address' => 'Kibaha District',
                'acreage' => 'Serene Enclave',
                'registration' => 'Sunshine Secondary School',
                'phone' => '0626 411 113',
                'order' => 3
            ],
            [
                'slug' => 'rweikiza',
                'name' => 'Rweikiza Nursery & Primary School',
                'email' => 'rweikizaenglishmedium1652@gmail.com',
                'instagram' => 'https://www.instagram.com/rweikiza_english_medium_school',
                'level' => 'Nursery and Primary only',
                'motto' => 'Foundation for Success',
                'description' => 'Dedicated to building a strong educational foundation for young learners with modern play areas and safe environment.',
                'image' => '/images/school/rweikiza_profile.jpg',
                'logo' => '/images/school/logo_rweikiza_new.jpg',
                'ranking' => '95% Standard 7 Division A Average',
                'location' => 'Kyetema bukoba, Bukoba',
                'address' => 'P.O.BOX 31373',
                'acreage' => 'Dedicated Complex',
                'registration' => 'Rweikiza Nursery & Primary School',
                'phone' => '0716 411 113',
                'order' => 4
            ],
        ];

        foreach ($campuses as $campus) {
            Campus::updateOrCreate(['slug' => $campus['slug']], $campus);
        }
    }
}
