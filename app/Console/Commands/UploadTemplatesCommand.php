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

        if (!file_exists($zipPath)) {
            return $this->error("The specified ZIP file does not exist: $zipPath");
        }

        $zip = new ZipArchive;
        if ($zip->open($zipPath) !== TRUE) {
            return $this->error('Failed to open the ZIP file.');
        }

        $extractBasePath = public_path('templates-master');
        $entries = [];

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $fileName = $zip->getNameIndex($i);
            $folderName = strtok($fileName, '/');
            if ($folderName && strpos($fileName, '/') !== false) {
                $entries[$folderName] = true;
            }
        }

        $folders = array_keys($entries);
        sort($folders);

        foreach ($folders as $folderName) {
            $this->processFolder($zip, $extractBasePath, $folderName);
        }

        $zip->close();
        $this->info('All templates processed successfully.');
    }

    private function processFolder(ZipArchive $zip, string $extractBasePath, string $folderName)
    {
        $this->info("Processing folder: $folderName");
        $templatePath = "$extractBasePath/$folderName";

        if (!file_exists($templatePath)) {
            mkdir($templatePath, 0777, true);
        }

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $fileName = $zip->getNameIndex($i);
            if (strpos($fileName, "$folderName/") === 0) {
                $zip->extractTo($extractBasePath, $fileName);
            }
        }

        $this->updatePathsRecursively($templatePath, $folderName);
        $this->handleThumbnail($folderName, $templatePath);
    }

    private function updatePathsRecursively(string $directoryPath, string $folderName)
    {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($directoryPath, RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $filePath = $file->getPathname();
                $content = file_get_contents($filePath);

                // Replace paths for CSS, JS, Images, and internal page links
                $patterns = [
                    '/href="css\/(.*?)"/i',  // CSS files
                    '/src="js\/(.*?)"/i',   // JS files
                    '/src="images\/(.*?)"/i', // Image files
                    '/href="(index|about-us|services|blog|contact-us)\.php"/i' // Internal page links
                ];

                $replacements = [
                    'href="<?php echo asset(\'templates-master/' . $folderName . '/css/$1\'); ?>"',
                    'src="<?php echo asset(\'templates-master/' . $folderName . '/js/$1\'); ?>"',
                    'src="<?php echo asset(\'templates-master/' . $folderName . '/images/$1\'); ?>"',
                    'href="<?php echo asset(\'templates-master/' . $folderName . '/$1.php\'); ?>"'
                ];

                $updatedContent = preg_replace($patterns, $replacements, $content);
                file_put_contents($filePath, $updatedContent);
                $this->info("Updated asset paths in file: $filePath");
            }
        }
    }

    private function handleThumbnail(string $folderName, string $templatePath)
    {
        $thumbnailsPath = public_path('thumbnails');
        if (!file_exists($thumbnailsPath)) {
            mkdir($thumbnailsPath, 0777, true);
        }

        $homeBannerPath = "$templatePath/images/home-banner.jpg";
        if (file_exists($homeBannerPath)) {
            $datetime = now()->format('Ymd_His');
            $thumbnailName = $this->normalizeThumbnailName($folderName);
            $thumbnailFilename = "{$thumbnailName}_{$datetime}.jpg";
            $newThumbnailPath = "$thumbnailsPath/$thumbnailFilename";

            copy($homeBannerPath, $newThumbnailPath);
            $this->info("Thumbnail saved to: $newThumbnailPath");
        } else {
            $this->warn("home-banner.jpg not found for: $folderName");
        }

        Template::updateOrCreate(
            ['folder' => $folderName],
            [
                'name' => $folderName,
                'folder' => $folderName,
                'thumbnail' => isset($thumbnailFilename) ? "thumbnails/$thumbnailFilename" : null,
                'description' => '',
            ]
        );
        $this->info("Saved $folderName to the database.");
    }

    private function normalizeThumbnailName(string $folderName): string
    {
        return preg_replace('/^(\d+)\s/', '$1-', $folderName);
    }
}
