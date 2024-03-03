<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PublicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $publications = Publication::all();
            $data = [
                'status' => 200,
                'publications' => $publications
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $errorData = [
                'status' => 500,
                'error' => 'Internal Server Error',
                'message' => $e->getMessage()
            ];
            return response()->json($errorData, 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'description' => 'required|string|max:200',
        'file' => 'required|mimes:jpg,png,jpeg,mp4,mov,avi|max:20480',
        'user_id' => 'required'
    ]);

    if ($validator->fails()) {
        $data = [
            'status' => 422,
            'message' => $validator->messages()
        ];
        return response()->json($data, 422);
    } else {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads', $filename); // Stocke le fichier dans le dossier "uploads" du stockage Laravel
        }

        $publication = new Publication();
        $publication->description = $request->description;
        $publication->file = $filename;
        $publication->user_id = $request->user_id;
        $publication->save();

        $data = [
            'status' => 200,
            'message' => 'Data created with success'
        ];
        return response()->json($data, 200);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $publication = Publication::find($id);
            $data = [
                'status' => 200,
                'publications' => $publication
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $errorData = [
                'status' => 500,
                'error' => 'Internal Server Error',
                'message' => $e->getMessage()
            ];
            return response()->json($errorData, 500);
        }
    }

   

    public function edit(string $id)
    {
        try {
            $publication = Publication::find($id);
            $data = [
                'status' => 200,
                'publications' => $publication
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $errorData = [
                'status' => 500,
                'error' => 'Internal Server Error',
                'message' => $e->getMessage()
            ];
            return response()->json($errorData, 500);
        }
    }

    public function update(Request $request, string $id)
    {
        $publication=Publication::find($id);
       
        $filename = null; 

        if ($request->has('fiel')) {
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $path='uploads/';
            $file->move($path,$filename);
            }
            $publication->description = $request->description;
            $publication->file=$filename;
            $publication->user_id = $request->user_id;
            $publication->save();

            
            $data=[
                'status'=>200,
                'message'=>'data update with success'
            ];
            return response()->json($data,200);

            

        

    }

 
    public function destroy(string $id)
    {
        $publication=Publication::find($id);
        $publication->delete();
        $data = [
            'status' => 200,
            'publications' => 'publication deleted with success'
        ];
        return response()->json($data,200);
    }
}
