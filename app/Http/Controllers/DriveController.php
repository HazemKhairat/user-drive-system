<?php

namespace App\Http\Controllers;

use App\Models\Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DriveController extends Controller

{
    public function publicDrive(){
        $drives = DB::table('drives')->where('status', 'public')->paginate(5);
        return view('Drives.public', compact('drives'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $drives = DB::table('drives')->where('user_id', $user_id)->paginate(5);
        return view('Drives.index', compact('drives'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Drives.create');
    }


    public function change_status($id){
        $drive = DB::table('drives')->where('id', $id)->first();
        $status = $drive->status;
        if($status == 'private'){
            DB::table('drives')->where('id', $id)->update([
                'status' => 'public'
            ]);
        }
        else{
            DB::table('drives')->where('id', $id)->update([
                'status' => 'private'
            ]);
        }
        return redirect()->back()->with("done", "Status Changed Successuflly");
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $drive_data = $request->file("file");
        $drive_name = rand(0, 200) . rand(0, 200) . $drive_data->getClientOriginalName();
        $drive_type = $drive_data->getClientOriginalExtension();
        $location = public_path('/upload');
        $drive_data->move($location, $drive_name);
        DB::table('drives')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'file' => $drive_name,
            'file_type' => $drive_type,
            'user_id' => Auth::user()->id
        ]);
        return redirect()->back()->with("done", "Insert Successuflly");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $driveData = DB::table('drives')
            ->join('users', 'drives.user_id', '=', 'users.id')
            ->select('drives.id as drive_id', 'drives.title', 'drives.description', 'drives.file', 'drives.file_type', 'drives.created_at', 'users.name')
            ->where('drives.id', $id)->first();
        return view('Drives.show', compact('driveData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $drives = DB::table('drives')->where('id', $id)->first();
        return view('Drives.edit', compact('drives'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $drives = DB::table('drives')->where('id', $id)->first();
        $drive_data = $request->file("file");
        if ($drive_data == null) {
            $drive_name =  $drives->file;
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

        return redirect()->back()->with("done", "File Updated Successuflly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $drives = DB::table('drives')->where('id', $id)->first();
        $oldFile = $drives->file;
        $fullPath = public_path('upload/') . $oldFile;
        unlink($fullPath);
        $drives = DB::table('drives')->where('id', $id)->delete();
        return redirect()->back()->with("done", "File Deleted Successuflly");
    }

    public function download($id)
    {
        $drive = DB::table('drives')->where('drives.id', '=', $id)->first();
        $fullpath = public_path('upload/') . $drive->file;
        return response()->download($fullpath);
    }
}
