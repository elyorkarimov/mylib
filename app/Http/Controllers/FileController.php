<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{

    public function remvoeFile($language, Request $request)
    {
        $user = Auth::user();

        $name =  $request->get('name');
        // $kursatkichFile = KursatgichFile::where('itm_id', '=', $user->itm_id)->where('total_file', '=', $name)->delete();

        return $name;
    }

    public function store($language, Request $request)
    {
        $user = Auth::user();
        if ($request->file('file')) {
            $image_name = $user->itm_id . '_' . Auth::id() . '_' . uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();
            $filePath = $request->file('file')->storeAs('itm/files', $image_name, 'public');
            $image_name = 'itm/files'.$image_name;
        }
        return response()->json(['success' => $image_name]);
    }
}