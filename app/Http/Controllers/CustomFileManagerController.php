<?php

namespace App\Http\Controllers;

use Alexusmai\LaravelFileManager\FileManager;
use Illuminate\Http\Request;

class CustomFileManagerController extends Controller
{
    // Override method content to set default path on the first load
    public function content(FileManager $fileManager, Request $request)
    {
        if (session('path_direct') && $request->input('path') === null) {
            $request->merge(['path' => session('path_direct')]);
        } else {
            session(['path_direct' => null]);
        }

        return response()->json(
            $fileManager->content(
                $request->input('disk'),
                $request->input('path')
            )
        );
    }
}
