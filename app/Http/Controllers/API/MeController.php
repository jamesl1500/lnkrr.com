<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Me;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Me  $me
     * @return \Illuminate\Http\Response
     */
    public function show(Me $me)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Me  $me
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Me $me)
    {
        // Get logged in user
        $user = Auth::user();

        // Validate request


        // Check if file is present
        if(request()->hasfile('profile_pic')){
            // Save file as blob
            $file1 = request()->file('profile_pic')->getRealPath();
            $profile_pic = base64_encode(file_get_contents($file1));
        }

        if(request()->hasfile('banner_pic')){
            // Save file as blob
            $file2 = request()->file('banner_pic')->getRealPath();
            $banner_pic = base64_encode(file_get_contents($file2));
        }

        // Update users table with new data
        try{
            // Save logged in users info
            $user->profile_pic = $profile_pic ?? Auth::user()->profile_pic;
            $user->background_pic = $banner_pic ?? Auth::user()->background_pic;
            $user->url = $request->profile_username;
            $user->name = $request->profile_name;
            $user->bio = $request->profile_bio;
            $user->bio_links = serialize($request->profile_links);
            $user->save();

            // Make sure request was successful
            return response()->json([
                'message' => 'Successfully updated user',
                'user' => $request->user(),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating user',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Me  $me
     * @return \Illuminate\Http\Response
     */
    public function destroy(Me $me)
    {
        //
    }
}
