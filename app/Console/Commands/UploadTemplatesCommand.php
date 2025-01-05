<?php

namespace App\Console\Commands;

use ZipArchive;
use App\Models\Template;
use RecursiveIteratorIterator;
use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use Illuminate\Support\Facades\Storage;

class UploadTemplatesCommand extends Command
{
    protected $signature = 'templates:upload {zipPath : Path to the ZIP file}';
    protected $description = 'Upload and process multiple templates from a ZIP file';

    public function handle()
    {
        $zipPath = $this->argument('zipPath');

        // Ensure the ZIP file exists
        if (!file_exists($zipPath)) {
            $this->error("The specified ZIP file does not exist: $zipPath");
            return;
        }

        $zip = new \ZipArchive;

        if ($zip->open($zipPath) === TRUE) {
            $extractBasePath = public_path('templates-master');
            $entries = [];

            // Collect folder names from ZIP entries
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileName = $zip->getNameIndex($i);
                $folderName = strtok($fileName, '/'); // Get the folder name
                if ($folderName && strpos($fileName, '/') !== false) {
                    $entries[$folderName] = true; // Ensure unique folder names
                }
            }

            // Sort folders in ascending order
            $folders = array_keys($entries);
            sort($folders);

            foreach ($folders as $folderName) {
                $this->info("Processing folder: $folderName");

                $templatePath = $extractBasePath . DIRECTORY_SEPARATOR . $folderName;

                if (!file_exists($templatePath)) {
                    mkdir($templatePath, 0777, true);
                }

                // Extract only the files for this folder
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $fileName = $zip->getNameIndex($i);
                    if (strpos($fileName, "$folderName/") === 0) {
                        $zip->extractTo($extractBasePath, $fileName);
                    }
                }

                // Update paths in PHP files recursively
                $this->updatePathsRecursively($templatePath, $folderName);

                // Thumbnail and database handling logic remains unchanged
                $thumbnailInZip = "$folderName/$folderName.png";
                $thumbnailName = $this->normalizeThumbnailName($folderName);

                $thumbnailsPath = public_path("thumbnails"); // Updated path to public/thumbnails
                if (!file_exists($thumbnailsPath)) {
                    mkdir($thumbnailsPath, 0777, true);
                }

                $homeBannerPath = $templatePath . "/images/home-banner.jpg";
                if (file_exists($homeBannerPath)) {
                    $datetime = now()->format('Ymd_His'); // Generate current datetime
                    $Thumbnail_image = "{$thumbnailName}_{$datetime}.jpg";
                    $newThumbnailPath = "{$thumbnailsPath}/{$thumbnailName}_{$datetime}.jpg"; // Use datetime in thumbnail name

                    copy($homeBannerPath, $newThumbnailPath); // Use home-banner.jpg as the thumbnail
                    $this->info("Thumbnail saved to: $newThumbnailPath");
                } else {
                    $this->warn("home-banner.jpg not found for: $folderName");
                }

                // Save to Database
                Template::updateOrCreate(
                    ['folder' => $folderName],
                    [
                        'name' => $folderName,
                        'folder' => $folderName,
                        'thumbnail' => "thumbnails/{$Thumbnail_image}",
                        'description' => '', // Optional
                    ]
                );

                $this->info("Saved $folderName to the database.");
            }

            $zip->close();
            $this->info('All templates processed successfully.');
        } else {
            $this->error('Failed to open the ZIP file.');
        }
    }

    /**
     * Recursively update paths in PHP files, including navigation links.
     */
    private function updatePathsRecursively(string $directoryPath, string $folderName)
    {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directoryPath, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $filePath = $file->getPathname();
                $content = file_get_contents($filePath);

                // Replace CSS, JS, and Image paths
                $content = preg_replace(
                    [
                        '/href="css\/(.*?)"/i', // CSS paths
                        '/src="js\/(.*?)"/i',  // JS paths
                        '/src="images\/(.*?)"/i' // Image paths
                    ],
                    [
                        'href="' . asset("templates-master/$folderName/css/$1") . '"',
                        'src="' . asset("templates-master/$folderName/js/$1") . '"',
                        'src="' . asset("templates-master/$folderName/images/$1") . '"'
                    ],
                    $content
                );

                // Replace navigation links
                $content = preg_replace(
                    [
                        '/href="index.php"/i',
                        '/href="about-us.php"/i',
                        '/href="services.php"/i',
                        '/href="blog.php"/i',
                        '/href="contact-us.php"/i'
                    ],
                    [
                        'href="' . asset("templates-master/$folderName/index.php") . '"',
                        'href="' . asset("templates-master/$folderName/about-us.php") . '"',
                        'href="' . asset("templates-master/$folderName/services.php") . '"',
                        'href="' . asset("templates-master/$folderName/blog.php") . '"',
                        'href="' . asset("templates-master/$folderName/contact-us.php") . '"'
                    ],
                    $content
                );

                // Save updated content back to the file
                file_put_contents($filePath, $content);
                $this->info("Updated paths in file: $filePath");
            }
        }
    }


    /**
     * Normalize the thumbnail name to match the desired format.
     * Example: "002 Zuk Animal Farming" => "002-Zuk Animal Farming"
     *
     * @param string $folderName
     * @return string
     */
    private function normalizeThumbnailName(string $folderName): string
    {
        $folderName = preg_replace('/^(\d+)\s/', '$1-', $folderName); // Add a hyphen after the first digit(s) and space
        return $folderName;
    }
}
