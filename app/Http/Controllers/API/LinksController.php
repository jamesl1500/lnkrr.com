<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LinksModel;
use Illuminate\Http\Request;

// Auth
use Illuminate\Support\Facades\Auth;

class LinksController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // This is where people can add a new link

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pic = base64_encode(file_get_contents(public_path('imgs/no_image_selected.png')));

        // This is where people can add a new link
        $link = new LinksModel();

        $link->user_id = $request->user()->id;
        $link->name = $request->link_name;
        $link->url = $request->link_url;
        $link->description = $request->link_description ?? '';


        // See if there is an image
        if ($request->hasFile('link_image')) {
            $link->image = base64_encode(file_get_contents($request->file('link_image')->getRealPath()));
        }else{
            $link->image = $pic;
        }

        $link->save();

        return response()->json([
            'message' => 'Link created successfully',
            'link' => $link
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LinksModel  $linksModel
     * @return \Illuminate\Http\Response
     */
    public function show(LinksModel $linksModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LinksModel  $linksModel
     * @return \Illuminate\Http\Response
     */
    public function edit(LinksModel $linksModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LinksModel  $linksModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LinksModel $linksModel)
    {
        // This is where people can edit a link and save to database
        $link = LinksModel::find($request->link_id);

        // Make sure it belongs to the user
        if ($link->user_id != Auth::user()->id) {
            return response()->json([
                'message' => 'This link does not belong to you'
            ], 403);
        }

        $link->name = $request->link_name;
        $link->url = $request->link_url;

        // See if there is an image
        if ($request->hasFile('link_image')) {
            $link->image = base64_encode(file_get_contents($request->file('link_image')->getRealPath()));
        }

        $link->save();

        return response()->json([
            'message' => 'Link updated successfully',
            'link' => $link
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LinksModel  $linksModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // This is where people can delete a link
        $link = LinksModel::find($id);

        // Make sure it belongs to the user
        if ($link->user_id != Auth::user()->id) {
            return response()->json([
                'message' => 'This link does not belong to you'
            ], 403);
        }

        $link->delete();

        return response()->json([
            'message' => 'Link deleted successfully'
        ], 200);
    }
}
