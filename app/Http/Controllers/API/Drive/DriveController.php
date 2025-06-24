<?php

namespace App\Http\Controllers\API\Drive;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DriveController extends Controller
{
    // DriveController.php
    public function publicDrive()
    {
        $drives = DB::table('drives')->where('status', 'public')->paginate(5);
        return response()->json(['data' => $drives]);
    }

    public function store(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
        $drive_data = $request->file("file");
        $drive_name = rand(0, 200) . rand(0, 200) . $drive_data->getClientOriginalName();
        $drive_type = $drive_data->getClientOriginalExtension();
        $location = public_path('/upload');
        $drive_data->move($location, $drive_name);
        $drive = DB::table('drives')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $drive_name,
            'file_type' => $drive_type,
            'user_id' => Auth::user()->id
        ]);

        $response = [
            'Message' => "Insert Successuflly",
            'Status' => '200',
            'data' => $drive
        ];
        return response($response, 200);
    }

    public function download($id)
    {
        $drive = DB::table('drives')->where('drives.id', '=', $id)->first();

        if (!$drive) {
            return response()->json(['error' => 'File not found in database.'], 404);
        }

        $fullpath = public_path('upload/') . $drive->file;
        return response()->download($fullpath);
    }

    public function change_status($id)
    {
        $drive = DB::table('drives')->where('id', $id)->first();
        $status = $drive->status;
        if ($status == 'private') {
            DB::table('drives')->where('id', $id)->update([
                'status' => 'public'
            ]);
        } else {
            DB::table('drives')->where('id', $id)->update([
                'status' => 'private'
            ]);
        }
        return response()->json(["Message" => "Status Changes Successuflly"], 200);
    }

    public function update(Request $request, $id)
    {
        $drives = DB::table('drives')->where('id', $id)->first();
        $drive_data = $request->file("file");
        if ($drive_data == null) {
            $drive_name = $drives->file;
            $drive_type = $drives->file_type;
        } else {
            $oldFile = $drives->file;
            $fullPath = public_path('upload/') . $oldFile;
            unlink($fullPath);
            $drive_name = rand(0, 200) . rand(0, 200) . $drive_data->getClientOriginalName();
            $drive_type = $drive_data->getClientOriginalExtension();
            $location = public_path('/upload');
            $drive_data->move($location, $drive_name);
        }
        DB::table('drives')->where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $drive_name,
            'file_type' => $drive_type,
            'user_id' => Auth::user()->id
        ]);

        return response()->json(["Message" => "File Updated Successuflly"]);
    }

    public function destroy($id)
    {
        $drives = DB::table('drives')->where('id', $id)->first();
        $oldFile = $drives->file;
        $fullPath = public_path('upload/') . $oldFile;
        unlink($fullPath);
        $drives = DB::table('drives')->where('id', $id)->delete();
        return response()->json(["Message" => "File Deleted Successuflly"], 200);
    }
}
