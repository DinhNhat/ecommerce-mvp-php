<?php

namespace App\Http\Services;

use App\Contracts\UploadMediaInterface;

class UploadImageService implements UploadMediaInterface
{
    public function store($request)
    {
        if ($request->hasFile('image')) {
            try {
                $name = $request->file('image')->getClientOriginalName();

                $path_full = 'images/' . date('Y/m/d');
                $request->file('image')->storeAs('public/' . $path_full, $name);

                return '/storage/' . $path_full . '/' . $name;
            } catch (\Exception $e) {
                return false;
            }
        }
    }
}