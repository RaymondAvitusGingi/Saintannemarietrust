<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Contact Details
            ['key' => 'contact_email', 'value' => 'stannemarieacademy@gmail.com', 'category' => 'contact', 'label' => 'Contact Email', 'type' => 'email'],
            ['key' => 'contact_phone', 'value' => '+255 686 586 426 / +255 654 995 711', 'category' => 'contact', 'label' => 'Main Phone Number', 'type' => 'tel'],
            ['key' => 'contact_address', 'value' => "Mbezi kwa Musuguri Area,\nP.O.BOX 31373,\nDar es Salaam, Tanzania", 'category' => 'contact', 'label' => 'Physical Address', 'type' => 'textarea'],
            ['key' => 'facebook_link', 'value' => 'https://facebook.com/stannemarie', 'category' => 'contact', 'label' => 'Facebook URL', 'type' => 'text'],
            ['key' => 'instagram_link', 'value' => 'https://www.instagram.com/st.annemarieacademy', 'category' => 'contact', 'label' => 'Instagram URL', 'type' => 'text'],
            ['key' => 'youtube_link', 'value' => 'https://youtube.com/@stannemarie', 'category' => 'contact', 'label' => 'YouTube Channel URL', 'type' => 'text'],

            // Academics Page Details
            ['key' => 'academic_curriculum_text', 'value' => 'At St. Anne Marie Academy, we follow the Tanzania National Curriculum, enhanced by modern teaching methodologies and international best practices.', 'category' => 'academics', 'label' => 'Curriculum Overview Text', 'type' => 'textarea'],
            ['key' => 'nursery_level_description', 'value' => 'Building strong foundations with play-based learning and early literacy at Rweikiza and St. Anne Marie campuses.', 'category' => 'academics', 'label' => 'Nursery Level Description', 'type' => 'textarea'],
            ['key' => 'primary_level_description', 'value' => "Our Standard 1-7 curriculum focuses on core competencies, achieving Grade 'A' school averages in national PSLE exams.", 'category' => 'academics', 'label' => 'Primary Level Description', 'type' => 'textarea'],
            ['key' => 'secondary_level_description', 'value' => 'Form 1-4 education emphasizing science, arts, and business subjects with exceptional NECTA performance.', 'category' => 'academics', 'label' => 'Secondary (O-Level) Description', 'type' => 'textarea'],
            ['key' => 'advanced_level_description', 'value' => 'Form 5-6 advanced studies across multiple combinations, preparing students for university and professional success.', 'category' => 'academics', 'label' => 'Advanced Level (A-Level) Description', 'type' => 'textarea'],
            ['key' => 'academic_facilities_text', 'value' => 'Our campuses are equipped with state-of-the-art facilities to support academic excellence and student well-being.', 'category' => 'academics', 'label' => 'Academic Facilities Overview', 'type' => 'textarea'],

            // About & Home Page
            ['key' => 'school_vision', 'value' => 'Superb Education', 'category' => 'general', 'label' => 'School Vision', 'type' => 'text'],
            ['key' => 'school_mission', 'value' => 'To be a model school providing high quality education service founded on commitment, integrity and professionalism.', 'category' => 'general', 'label' => 'School Mission', 'type' => 'textarea'],
            ['key' => 'school_footer_about', 'value' => 'St. Anne Marie Academy Secondary School is dedicated to providing quality education grounded in academic excellence, discipline, and moral values.', 'category' => 'general', 'label' => 'Footer About Text', 'type' => 'textarea'],
            ['key' => 'home_hero_tagline', 'value' => 'Empowering students with knowledge, character, and skills for a successful future across our four campuses.', 'category' => 'general', 'label' => 'Home Hero Tagline', 'type' => 'textarea'],

            // Director Info
            ['key' => 'director_name', 'value' => 'Dr. Jasson Rweikiza', 'category' => 'general', 'label' => "Director's Name", 'type' => 'text'],
            ['key' => 'director_title', 'value' => 'Director', 'category' => 'general', 'label' => "Director's Title", 'type' => 'text'],
            ['key' => 'director_quote', 'value' => 'Our investment in education is an investment in the future of Tanzania. We are committed to providing world-class facilities and a supportive environment where every child can excel, regardless of their background.', 'category' => 'general', 'label' => "Director's Quote", 'type' => 'textarea'],
            ['key' => 'director_description', 'value' => 'Under the visionary leadership of Dr. Jasson Rweikiza, St. Anne Marie Academy has grown into a prestigious group of schools. His dedication to educational standards and infrastructure has been recognized by the government as a significant contribution to the national education sector.', 'category' => 'general', 'label' => "Director's Description", 'type' => 'textarea'],
            ['key' => 'director_image', 'value' => '/images/staff/director_new.jpg', 'category' => 'general', 'label' => "Director's Image Path", 'type' => 'text'],

            // SEO & Meta Tags
            ['key' => 'meta_title', 'value' => 'St. Anne Marie Academy Schools - Towards Excellence', 'category' => 'seo', 'label' => 'Meta Title (SEO)', 'type' => 'text'],
            ['key' => 'meta_description', 'value' => 'Providing high quality education from Nursery to Advanced Level with consistent top NECTA performance in Tanzania.', 'category' => 'seo', 'label' => 'Meta Description', 'type' => 'textarea'],
            ['key' => 'meta_keywords', 'value' => 'education, tanzania, school, secondary school, high school, necta, excellence', 'category' => 'seo', 'label' => 'Meta Keywords (Comma separated)', 'type' => 'text'],
            ['key' => 'og_image', 'value' => '/images/school/logo_st_anne_official.jpg', 'category' => 'seo', 'label' => 'Social Share Image (OG)', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
