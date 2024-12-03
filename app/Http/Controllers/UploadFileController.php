<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadFileController extends Controller
{
    public function showUploadForm(Request $request)
    {
        return view('file.upload');
    }

    public function upload(Request $request)
    {
//        try {
//            Storage::disk('s3')->put('heroes', $request->file('file'));
//            dump('Success');
//        } catch (\Exception $e) {
//            dump($e->getMessage());
//        }

        dd(Storage::disk('s3')->temporaryUrl(
            'heroes/kcsWddwU2K6VrXoa9T46K4hR6apvc9DAwxB6RzZk.pdf',
            now()->addMinutes(1))
        );
    }
}
