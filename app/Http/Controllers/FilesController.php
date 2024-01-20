<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FilesController extends Controller
{
    public function Upload(Request $request)
    {

        $validatedData = Validator::make([
            'file' => 'required|file|max:2048|mimes:jpeg,png,pdf',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                'message' => 'files',
                "error" => $validatedData->errors()
            ], 400);
        }

        $file = $request->file('file');
        $path = $file->store('uploads', 'public');
        // Additional logic to process the uploaded file
        return response()->json(['message' => 'File uploaded successfully', 'path' => $path]);
    }
}
