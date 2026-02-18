<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * Handle image upload with resizing and compression.
     * Falls back to simple upload if GD extension is not available.
     * 
     * @param UploadedFile $file
     * @param string $path Target directory in storage/app/public
     * @param int $width Max width
     * @param int $quality Compression quality (0-100)
     * @return string Relative image path
     */
    public static function uploadAndOptimize(UploadedFile $file, string $path, int $width = 1600, int $quality = 80): string
    {
        // Generate a unique filename
        $filename = $file->hashName();

        // Ensure directory exists
        Storage::disk('public')->makeDirectory($path);

        // Check if GD extension is available for image optimization
        if (extension_loaded('gd')) {
            try {
                $fullPath = storage_path('app/public/' . $path . '/' . $filename);
                
                // Use Intervention Image for optimization
                $image = \Intervention\Image\Laravel\Facades\Image::read($file);

                // Resize if larger than max width
                if ($image->width() > $width) {
                    $image->scale(width: $width);
                }

                // Save with compression
                $image->save($fullPath, quality: $quality);

                return $path . '/' . $filename;
            } catch (\Exception $e) {
                // Fall through to simple upload on any error
            }
        }

        // Fallback: Simple file upload without optimization
        $storedPath = $file->storeAs($path, $filename, 'public');
        
        return $storedPath;
    }
}
