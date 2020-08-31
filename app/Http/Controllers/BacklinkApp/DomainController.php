<?php

namespace App\Http\Controllers\BacklinkApp;

use App\Category;
use App\Subcategory;
use App\Domain;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class DomainController extends Controller
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
        $categories = Category::get();
        $subcategories = Subcategory::get();

        return view('pages.backlinkapp.create_domain')->with('categories', $categories)->with('subcategories', $subcategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'title' => 'required|max:60',
            'url' => 'required|max:255',
            'shortdescription' => 'required|max:150',
        ]);

        $domain = new Domain();
        $domain->title = $request->title;
        $domain->email = $request->email;
        $domain->url = $request->url;
        $domain->category_id = $request->category_id;
        $domain->subcategory_id = $request->subcategory_id;
        $domain->short_description = $request->shortdescription;
        $domain->description = $request->description;

        $filenameToStore = "noimage.jpeg";
        //Handle file upload
        if ($request->hasFile('img')) {
            //get filename with extension
            $filenameWithExt = $request->file('img')->getClientOriginalName();

            //get file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get file extension
            $fileExt = $request->file('img')->getClientOriginalExtension();

            //file name to store in database
            $filenameToStore = $filename . '_' . time() . $fileExt;
            //upload image in storage
            $image = $request->file('img');
            // Storage::disk('public/backlinkapp/domain_images')->put($filenameToStore, File::get);
            $filepath = $request->file('img')->storeAs('public/backlinkapp/domain_images', $filenameToStore);
        }
        $domain->img = $filenameToStore;
        $domain->save();
        return redirect('/domain/create')->with('success', 'Message has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $domain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domain $domain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain)
    {
        //
    }
}
