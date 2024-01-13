<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payload = Tasks::all();

        return response()->json([
            "successful" => false,
            "message" => "error uploading data to the db",
            "payload" => $payload
            ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['deadline' => now()->addHour(2),"user_id" => $request->user()["id"]]);
        $payload = $request->only(["title", "user_id", "category", "deadline", "description", "priority","user_id","deadline"]);

        // validate request
        $validate_request = Validator::make(
            $payload,
            [
                "title" => "string|required",
                "deadline" => "date|required",
                "user_id" => "numeric|required",
                "category" => "string|required",
                "priority" => "string|required",
                "description" => "string|required",
            ]
        );

        if ($validate_request->fails()) {
            return response()->json([
                "successful" => false,
                "message" => $validate_request->errors()
            ]);
        }
        // store the data
        Tasks::create($payload);

        // return successful response
        return response()->json([
            "successful" => true,
            "message" => "successfully uploaded to the db",
            "payload" => $payload
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tasks $tasks, $id)
    {
        $update_data = $tasks::find($id)->update($request->all());

        return response()->json([
            "successful" => true,
            "message" => "data successfully updated",
            "payload" => $update_data
        ], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $tasks,$id)
    {
        $tasks::destroy($id);

        return response()->json([
            "successful" => true,
            "message" => "successfully deleted"
        ], Response::HTTP_OK);

    }
}
