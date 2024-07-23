<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.products');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate and store the product
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => 'required',
            'file' => ['required', File::types(['text/plain'])->min('1kb'), 'extensions:txt'],
            'image' => ['required', File::types(['png', 'jpeg', 'jpg'])->min('10kb')->max('1024kb')], // Validate that an uploaded file is exactly 400 kilobytes...
        ]);

        $allInputs = $request->all();

        dd($allInputs);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
