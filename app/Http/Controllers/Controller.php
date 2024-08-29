<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $pagination;

    public function __construct()
    {
        $this->pagination = config('app.pagination');
    }
}
