<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

        // Handle thumbnail upload
        $thumbnail = $request->file('thumbnail');
        $thumbnailPath = $thumbnail->storeAs('public/thumbnails', $templateName . '.' . $thumbnail->getClientOriginalExtension());

        // Save template in the database
        Template::create([
            'name' => $request->input('name'),
            'folder' => $templateName,
            'thumbnail' => str_replace('public/', '', $thumbnailPath), // Remove "public/" prefix for storage path
            'description' => $request->input('description', ''),
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template uploaded successfully!');
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
        $filePath = public_path('template-master/' . $templateFolder . '/index.php');

        // Check if the file exists
        if (File::exists($filePath)) {
            // Return the file to the browser
            return response()->file($filePath);
        }

        // If the file doesn't exist, return a 404 response
        abort(404);
    }
}
