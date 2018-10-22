<?php

namespace App\Http\Controllers;

use App\Image;

class ImageController extends ResourceController
{
    protected $resource = 'image';

    public function __construct(Image $record) {
        parent::__construct($record);
    }
}
