<?php

namespace App\Contracts;

interface UploadMediaInterface
{
    public function store($request);
}