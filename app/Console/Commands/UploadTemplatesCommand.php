<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Template;
use ZipArchive;

class UploadTemplatesCommand extends Command
{
    protected $signature = 'templates:upload {zipPath : Path to the ZIP file}';
    protected $description = 'Upload and process multiple templates from a ZIP file';

    public function handle()
    {
        $zipPath = $this->argument('zipPath');
//    ..check 
        // Ensure the ZIP file exists
        if (!file_exists($zipPath)) {
            $this->error("The specified ZIP file does not exist: $zipPath");
            return;
        }

        $zip = new ZipArchive;

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

                // Handle Thumbnail
                $thumbnailInZip = "$folderName/$folderName.png";
                $thumbnailName = $this->normalizeThumbnailName($folderName);

                if ($zip->locateName($thumbnailInZip) !== false) {
                    $newThumbnailPath = public_path("storage/thumbnails/{$thumbnailName}.png");
                    if (!file_exists(dirname($newThumbnailPath))) {
                        mkdir(dirname($newThumbnailPath), 0777, true);
                    }
                    copy($extractBasePath . DIRECTORY_SEPARATOR . $thumbnailInZip, $newThumbnailPath);
                    $this->info("Thumbnail saved to: $newThumbnailPath");
                } else {
                    $this->warn("Thumbnail not found for: $folderName");
                }

                // Save to Database
                Template::updateOrCreate(
                    ['folder' => $folderName],
                    [
                        'name' => $folderName,
                        'folder' => $folderName,
                        'thumbnail' => "thumbnails/{$thumbnailName}.png",
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
