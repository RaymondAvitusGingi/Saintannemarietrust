<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class ProductionMigrationController extends Controller
{
    /**
     * Secret key for migration
     */
    private $secretKey = 'saint_anne_marie_migrate_2026';

    /**
     * Migrate data from local SQLite to MySQL
     */
    public function migrate($key)
    {
        if ($key !== $this->secretKey) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            // 1. Run migrations first
            Artisan::call('migrate', ['--force' => true]);
            $output = Artisan::output();

            return response()->json([
                'success' => true,
                'message' => 'Migrations completed',
                'output' => $output
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Seed specific data (Campuses, etc.)
     */
    public function seedData($key)
    {
        if ($key !== $this->secretKey) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            // Run specific seeders
            Artisan::call('db:seed', [
                '--class' => 'CampusSeeder',
                '--force' => true
            ]);
            
            Artisan::call('db:seed', [
                '--class' => 'SiteSettingSeeder',
                '--force' => true
            ]);

            // Update Brilliant Gallery Images
            DB::table('gallery_images')->where('campus_id', 'brilliant')->delete();
            DB::table('gallery_images')->insert([
                [
                    'campus_id' => 'brilliant',
                    'image_path' => '/images/school/brilliant_maroon_skirts.jpg',
                    'caption' => 'Our Students',
                    'order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'campus_id' => 'brilliant',
                    'image_path' => '/images/school/brilliant_green_group.jpg',
                    'caption' => 'Campus Life',
                    'order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'campus_id' => 'brilliant',
                    'image_path' => '/images/school/brilliant_staff_white.jpg',
                    'caption' => 'Academic Team',
                    'order' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'campus_id' => 'brilliant',
                    'image_path' => '/images/school/brilliant_football_red.jpg',
                    'caption' => 'Sports & Games',
                    'order' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'campus_id' => 'brilliant',
                    'image_path' => '/images/school/brilliant_group_01.jpg',
                    'caption' => 'Brilliant Students',
                    'order' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'campus_id' => 'brilliant',
                    'image_path' => '/images/school/brilliant_entrance.jpg',
                    'caption' => 'Welcome to Brilliant',
                    'order' => 7,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'campus_id' => 'brilliant',
                    'image_path' => '/images/school/brilliant_building_academic.jpg',
                    'caption' => 'Academic Block',
                    'order' => 8,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'campus_id' => 'brilliant',
                    'image_path' => '/images/school/brilliant_staff_traditional.jpg',
                    'caption' => 'Our Staff',
                    'order' => 9,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            // Update Sunshine Gallery Images
            DB::table('gallery_images')->where('campus_id', 'sunshine')->delete();
            DB::table('gallery_images')->insert([
                [
                    'campus_id' => 'sunshine',
                    'image_path' => '/images/school/sunshine_student_group_large.jpg',
                    'caption' => 'Our Students',
                    'order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'campus_id' => 'sunshine',
                    'image_path' => '/images/school/sunshine_trip_bus.jpg',
                    'caption' => 'School Trip',
                    'order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'campus_id' => 'sunshine',
                    'image_path' => '/images/school/sunshine_students_building.jpg',
                    'caption' => 'Campus Life',
                    'order' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'campus_id' => 'sunshine',
                    'image_path' => '/images/school/sunshine_classroom_girls.jpg',
                    'caption' => 'Learning Environment',
                    'order' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Seeding completed'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
