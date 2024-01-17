<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\CommentsResource;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payload = Comments::all();

        return response()->json([
            "successful" => true,
            "payload" => CommentsResource::collection($payload)
        ], Response::HTTP_OK);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate incoming requests
        $validation = Validator::make($request->all(),[
            "user_id" => "string|required",
            "task_id" =>'string|required',
            "comment" => "string|required"
        ]);

        if($validation->fails()){
            return response()->json([
                "successful" => false,
                "message" => "validation error",
                "errors" => $validation->errors(),
            ],Response::HTTP_BAD_REQUEST);
        }
        // save payload
        dd($request->all());
        $payload = Comments::create($request->all());


        // return response()->json([
        //     "successful" => true,
        //     "message" => "successfully created",
        //     "payload" => CommentsResource::collection($payload)
        // ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comments $comments, $id)
    {
        // validate request

        // update request
        // $update_data = $tasks::find($id)->update($request->all());

        // return CommentsResource($update_data);

        // return response()->json([
        //     "successful" => true,
        //     "message" => "successfully updated",
        //     "payload" => CommentsResource::collection($update_data)
        // ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comments $comments, $id)
    {
        $comments::destroy($id);

        return response()->json([
            "successful" => true,
            "message" => "successfully deleted"
        ], Response::HTTP_OK);

    }
}
