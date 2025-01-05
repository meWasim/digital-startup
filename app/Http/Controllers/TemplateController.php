<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Models\TemplateSection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class TemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
    }

    /**
     * Display a listing of the templates.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::all();
        return view('templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new template.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('templates.create');
    }

    /**
     * Store a newly created template in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     // Validate incoming request
    //     $request->validate([
    //         'template' => 'required|file|mimes:zip|max:10240', // ZIP file, max size 10MB
    //         'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Thumbnail image
    //         'name' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //     ]);

    //     // Handle the ZIP file upload
    //     $zipFile = $request->file('template');
    //     $templateName = pathinfo($zipFile->getClientOriginalName(), PATHINFO_FILENAME);
    //     $zipFilePath = $zipFile->storeAs('templates', $zipFile->getClientOriginalName(), 'public');

    //     // Extract the ZIP file contents
    //     $zip = new \ZipArchive;
    //     $extractPath = public_path('templates-master/' . $templateName);

    //     if (!file_exists($extractPath)) {
    //         mkdir($extractPath, 0777, true);
    //     }

    //     if ($zip->open(storage_path('app/public/' . $zipFilePath)) === TRUE) {
    //         $zip->extractTo($extractPath);
    //         $zip->close();
    //         // Delete the ZIP file after successful extraction
    //         unlink(storage_path('app/public/' . $zipFilePath));
    //     } else {
    //         return back()->with('error', 'Failed to extract the ZIP file');
    //     }

    //     // Handle thumbnail upload
    //     $thumbnail = $request->file('thumbnail');
    //     $thumbnailPath = $thumbnail->storeAs('public/thumbnails', $templateName . '.' . $thumbnail->getClientOriginalExtension());

    //     // Save template in the database
    //     Template::create([
    //         'name' => $request->input('name'),
    //         'folder' => $templateName,
    //         'thumbnail' => str_replace('public/', '', $thumbnailPath), // Remove "public/" prefix for storage path
    //         'description' => $request->input('description', ''),
    //     ]);

    //     return redirect()->route('admin.templates.index')->with('success', 'Template uploaded successfully!');
    // }
    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'template' => 'required|file|mimes:zip|max:10240', // ZIP file, max size 10MB
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Thumbnail image
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Handle the ZIP file upload
        $zipFile = $request->file('template');
        $templateName = pathinfo($zipFile->getClientOriginalName(), PATHINFO_FILENAME);
        $zipFilePath = $zipFile->storeAs('templates', $zipFile->getClientOriginalName(), 'public');

        // Extract the ZIP file contents
        $zip = new \ZipArchive;
        $extractPath = public_path('templates-master/' . $templateName);

        if (!file_exists($extractPath)) {
            mkdir($extractPath, 0777, true);
        }

        if ($zip->open(storage_path('app/public/' . $zipFilePath)) === TRUE) {
            $zip->extractTo($extractPath);
            $zip->close();
            // Delete the ZIP file after successful extraction
            unlink(storage_path('app/public/' . $zipFilePath));
        } else {
            return back()->with('error', 'Failed to extract the ZIP file');
        }

        // Update asset paths (JS, CSS, and images) in extracted files
        $this->updatePathsRecursively($extractPath, $templateName);

        // Handle thumbnail upload and saving at the specific location
        $thumbnail = $request->file('thumbnail');
        $datetime = now()->format('Ymd_His'); // Generate current datetime
        $thumbnailFileName = $templateName . '_' . $datetime . '.' . $thumbnail->getClientOriginalExtension();

        // Specify custom directory for thumbnails
        $thumbnailPath = 'thumbnails/' . $thumbnailFileName;

        // Move the thumbnail to the custom directory
        $thumbnail->move(public_path('thumbnails'), $thumbnailFileName);

        // Save template in the database
        Template::create([
            'name' => $request->input('name'),
            'folder' => $templateName,
            'thumbnail' => $thumbnailPath, // Save relative path to public
            'description' => $request->input('description', ''),
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template uploaded and processed successfully!');
    }

    /**
     * Update asset paths (JS, CSS, and images) recursively in a directory.
     */
    private function updatePathsRecursively(string $directoryPath, string $folderName)
    {
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directoryPath, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($files as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $filePath = $file->getPathname();
                $content = file_get_contents($filePath);

                // Replace asset paths for CSS, JS, and images
                $updatedContent = preg_replace(
                    [
                        '/href="css\/(.*?)"/i', // Update CSS paths
                        '/src="js\/(.*?)"/i',   // Update JS paths
                        '/src="images\/(.*?)"/i', // Update image paths
                    ],
                    [
                        'href="' . asset("templates-master/$folderName/css/$1") . '"',
                        'src="' . asset("templates-master/$folderName/js/$1") . '"',
                        'src="' . asset("templates-master/$folderName/images/$1") . '"',
                    ],
                    $content
                );

                // Save the updated content back to the file
                file_put_contents($filePath, $updatedContent);
            }
        }
    }

    /**
     * Display the specified template.
     *
     * @param \App\Models\Template $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        return view('templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified template.
     *
     * @param \App\Models\Template $template
     * @return \Illuminate\Http\Response
     */
    public function edit(Template $template)
    {
        return view('templates.edit', compact('template'));
    }

    /**
     * Update the specified template in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Template $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Template $template)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Update the template details
        $template->name = $request->input('name');
        $template->description = $request->input('description', '');

        // Check if the user uploaded a new ZIP file
        if ($request->hasFile('template')) {
            // Delete the old template folder and ZIP file
            $this->deleteTemplateFiles($template);

            // Handle the new ZIP file upload
            $zipFile = $request->file('template');
            $templateName = pathinfo($zipFile->getClientOriginalName(), PATHINFO_FILENAME);
            $zipFilePath = $zipFile->storeAs('templates', $zipFile->getClientOriginalName(), 'public');

            // Extract the ZIP file contents
            $zip = new \ZipArchive;
            $extractPath = public_path('templates-master/' . $templateName);

            if (!file_exists($extractPath)) {
                mkdir($extractPath, 0777, true);
            }

            if ($zip->open(storage_path('app/public/' . $zipFilePath)) === TRUE) {
                $zip->extractTo($extractPath);
                $zip->close();
                // Delete the ZIP file after successful extraction
                unlink(storage_path('app/public/' . $zipFilePath));
            } else {
                return back()->with('error', 'Failed to extract the new ZIP file');
            }

            // Update the folder name
            $template->folder = $templateName;
        }

        // Check if the user uploaded a new thumbnail
        if ($request->hasFile('thumbnail')) {
            // Delete the old thumbnail
            $this->deleteThumbnail($template);

            // Handle the new thumbnail upload
            $thumbnail = $request->file('thumbnail');
            $thumbnailPath = $thumbnail->storeAs('public/thumbnails', $template->folder . '.' . $thumbnail->getClientOriginalExtension());
            $template->thumbnail = str_replace('public/', '', $thumbnailPath); // Remove "public/" prefix
        }

        // Save the updated template in the database
        $template->save();

        return redirect()->route('admin.templates.index')->with('success', 'Template updated successfully!');
    }

    /**
     * Remove the specified template from storage.
     *
     * @param \App\Models\Template $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        // Delete the template folder and its contents
        $this->deleteTemplateFiles($template);

        // Delete the thumbnail file
        $this->deleteThumbnail($template);

        // Delete the template from the database
        $template->delete();

        return redirect()->route('admin.templates.index')->with('success', 'Template deleted successfully!');
    }

    /**
     * Helper function to delete the template folder and its contents.
     *
     * @param \App\Models\Template $template
     * @return void
     */
    private function deleteTemplateFiles($template)
    {
        $templateFolderPath = public_path('templates-master/' . $template->folder);
        if (is_dir($templateFolderPath)) {
            $this->deleteFolder($templateFolderPath);
        }

        // Delete the original ZIP file
        $zipFilePath = storage_path('app/public/templates/' . $template->folder . '.zip');
        if (file_exists($zipFilePath)) {
            unlink($zipFilePath);
        }
    }

    /**
     * Helper function to delete the thumbnail.
     *
     * @param \App\Models\Template $template
     * @return void
     */
    private function deleteThumbnail($template)
    {
        $thumbnailPath = public_path('storage/' . $template->thumbnail);
        if (file_exists($thumbnailPath)) {
            unlink($thumbnailPath);
        }
    }

    /**
     * Helper function to delete a folder and its contents.
     *
     * @param string $folderPath
     * @return void
     */
    private function deleteFolder($folderPath)
    {
        if (!is_dir($folderPath)) {
            return;
        }

        $files = array_diff(scandir($folderPath), ['.', '..']);
        foreach ($files as $file) {
            $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;
            is_dir($filePath) ? $this->deleteFolder($filePath) : unlink($filePath);
        }
        rmdir($folderPath);
    }
    public function preview($templateFolder)
    {
        // Construct the path to the template's index.php file
        $filePath = public_path('templates-master/' . $templateFolder . '/index.php');
        if (!file_exists($filePath)) {
            // Return the file to the browser
            return abort(404,'Template not found');
        }
        ob_start();
        include $filePath;
        $output = ob_get_clean();
        return response($output);
        $output = ob_get_clean();
    }



    public function edit_template($templateId)
{
    $template = Template::findOrFail($templateId);

    // Retrieve existing template sections
    $templateSections = TemplateSection::where('template_id', $templateId)
                                        ->pluck('content', 'section_name')
                                        ->toArray();

    return view('templates.edit_user', compact('template', 'templateSections'));
}


// public function update_user(Request $request, $templateId)
// {
//     $template = Template::findOrFail($templateId);

//     // Validate the form data
//     $request->validate([
//         'content' => 'array',
//         'content.*' => 'string|max:1000', // Validate content text
//         'image' => 'array|nullable',
//         'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image type and size
//     ]);

//     // Loop through each section and save the content and image
//     foreach ($request->input('content') as $sectionName => $content) {
//         // Check if the template already has a section for this name
//         $section = TemplateSection::firstOrCreate(
//             ['template_id' => $template->id, 'section_name' => $sectionName],
//             ['content' => $content]
//         );

//         // If there is an image for this section, upload it
//         if ($request->hasFile('image.' . $sectionName)) {
//             $image = $request->file('image.' . $sectionName);
//             $path = $image->store('section_images', 'public');

//             // Update the section with the new image
//             $section->update(['image' => $path]);
//         } else {
//             // If no image was uploaded, just update the content
//             $section->update(['content' => $content]);
//         }
//     }

//     return redirect()->route('template.edit_user', $templateId)->with('success', 'Sections updated successfully!');

// }

public function update_user(Request $request, Template $template)
{
    $user = Auth::user();  // Get the authenticated user

    // Handle image uploads and store the file path in the database
    foreach ($request->input('sections', []) as $section => $content) {
        // Check if there is an image upload for this section
        if ($request->hasFile($section.'_image')) {
            // Validate the image (you can add your own validation rules)
            $image = $request->file($section.'_image');
            $imagePath = $image->store('template_images', 'public');  // Save to public disk in the 'template_images' folder

            // Ensure content is a string and not an array
            $content = is_array($content) ? implode(' ', $content) : $content;  // Convert array to string if needed

            // Store the image path along with any content
            TemplateSection::updateOrCreate(
                [
                    'user_id' => $user->id,    // Ensure 'user_id' is included
                    'template_id' => $template->id,
                    'section_name' => $section
                ],
                [
                    'content' => $content,
                    'image' => $imagePath // Save image path
                ]
            );
        } else {
            // If no image is uploaded, just save the text content
            // Ensure content is a string
            $content = is_array($content) ? implode(' ', $content) : $content;  // Convert array to string if needed

            // Store only content
            TemplateSection::updateOrCreate(
                [
                    'user_id' => $user->id,    // Ensure 'user_id' is included
                    'template_id' => $template->id,
                    'section_name' => $section
                ],
                [
                    'content' => $content // Save only content if no image
                ]
            );
        }
    }

    // Redirect to the preview page after saving the customizations
    return redirect()->route('user.template.preview', $user->subdomain);
}





public function showUserTemplate($subdomain, $templateId)
{
    $user = User::where('subdomain', $subdomain)->firstOrFail();
    $customizations = TemplateSection::where('user_id', $user->id)
                                           ->where('template_id', $templateId)
                                           ->get();

    // Load the template HTML file (index.php, about-us.php, etc.)
    $template = Template::findOrFail($templateId);
    $templatePath = public_path('templates-master/' . $template->folder_name);

    // Read the content of the template file
    $fileContent = File::get($templatePath .'include'. '/about-us.php');

    // Replace placeholders with the user's custom content
    foreach ($customizations as $customization) {
        $fileContent = str_replace("{{ " . $customization->section_name . " }}", $customization->content, $fileContent);
    }

    return response($fileContent);
}
}
