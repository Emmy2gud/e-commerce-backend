<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\json;

class ProfileController extends Controller
{
       public function show(User $user)
    {
 return response()->json(['user'=>$user], 200);



    }



    public function update(Request $request,User $user)
    {
  $user=auth()->user();

      $validated= $request->validate([
            'profile_photo_path' => 'nullable|image',
            'cover_photo_path'=> 'nullable|image',
            'name' => 'required|string|max:255',
            'about' => 'nullable|string|max:500',
            'Location'=>'nullable|string|max:255',
             'social_media_links' => 'nullable|string'

        ]);

        if (request('profile_photo_path')) {
           if ($user->profile_photo_path) {
            Storage::delete('public/' . $user->profile_photo_path);
        }

        $imagePath = $request->file('profile_photo_path')->store('profiles', 'public');
        $validated['profile_photo_path'] = $imagePath;
        }


        $socialArray = [];
        if (!empty($validated['social_media_links'])) {
            $socialArray = array_map('trim', explode(',', $validated['social_media_links']));
            $socialArray = array_filter($socialArray);

              $validated['social_media_links'] = json_encode($socialArray);
        }
        $user->update($validated);

return response()->json(['message' => 'Profile updated successfully!', 'user'=> $user], 201);

    }
}
