<?php

namespace App\Http\Services;

use App\Contracts\UploadMediaInterface;

class UploadFileService implements UploadMediaInterface
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName();

                $path_full = 'files/' . date('Y/m/d');
                $request->file('file')->storeAs('public/' . $path_full, $name);

                return '/storage/' . $path_full . '/' . $name;
            } catch (\Exception $e) {
                return false;
            }
        }
    }
}