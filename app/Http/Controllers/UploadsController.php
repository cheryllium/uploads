<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Image;
use Spatie\DiscordAlerts\Facades\DiscordAlert;

class UploadsController extends Controller
{
    const MAX_SIZE = 150 * 1024 * 1024; // First number is MiB, value is in bytes
    
    /**
     * User dashboard; lists all uploads
     */
    public function dashboard(Request $request)
    {
        // Get list of all uploads
        $images = auth()->user()->images()->get();

        $data = [
            'uploads' => $images,
            'totalSize' => auth()->user()->totalImageSize() / (1024 * 1024),
            'sizeLimit' => self::MAX_SIZE / (1024 * 1024),
        ];
        
        // Load view
        return view('dashboard')->with($data); 
    }
    
    /**
     * Upload an image file. 
     */
    public function storeImage(Request $request)
    {
        // Get the image and title from the request
        $image = $request->file('image');
        $title = $request->get('title');

        // Get file size of image
        $filesize = $image->getSize(); // in bytes
        
        // If file size limit exceeded, block upload
        if (auth()->user()->totalImageSize() + $filesize > self::MAX_SIZE) {
            // Flash back to form with an error
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['image' => "This upload would cause your account to exceed the maximum total uploads size of " . (self::MAX_SIZE / (1024 * 1024)) . " MiB. You may need to delete some of your older posts to make room for new ones."]);
        }
        
        // Encrypt image and generate randomized filename
        $encryptedImage = Crypt::encrypt($image->getContent());
        $imageUUID = Str::uuid();

        // Save the encrypted image to the filesystem
        Storage::put($imageUUID, $encryptedImage);

        // Save an Image model linking the post and user
        $image = new Image;
        $image->id = $imageUUID;
        $image->title = $title; 
        $image->path = $imageUUID;
        $image->size = $filesize; 
        $image->user()->associate(auth()->user());
        $image->save();

        // Alert the discord channel that a new file has been uploaded
        $username = auth()->user()->username;
        $url = route('image.view', ['uuid' => $imageUUID]); 
        DiscordAlert::message("${username} uploaded an image titled **${title}**. Click here to view: {$url}");
        
        // Redirect to uploaded image page
        return redirect()->route('image.view', ['uuid' => $imageUUID]); 
    }

    /**
     * Display an image file.
     */
    public function viewImage($uuid)
    {
        $image = Image::where('id', $uuid)->first();
        $filePath = $image->path;

        if (Storage::exists($filePath)) {
            $fileContents = Storage::get($filePath);
            $decrypted = Crypt::decrypt($fileContents);
            $encoded = base64_encode($decrypted);

            $data = [
                'id' => $image->id, 
                'title' => $image->title,
                'encoded' => $encoded,
                'username' => $image->user->username,
                'show_delete' => $image->user->id == auth()->user()->id,
            ];
            
            return view('image.view')->with($data); 
        }

        abort(404); 
    }

    /**
     * Delete an uploaded image. 
     */
    public function deleteImage($uuid)
    {
        // Look up the image resource
        $image = Image::where('id', $uuid)->first();

        // Make sure you own the image
        if (auth()->user()->id != $image->user->id) {
            abort(401); 
        }

        // Delete the file from storage
        $filePath = $image->path; 
        Storage::delete($filePath); 
        
        // Delete the image resource
        $image->delete();

        // Go back to dashboard
        return redirect()->route('dashboard'); 
    }
}
