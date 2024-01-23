<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Tasks;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class TasksController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::guard('user')) {
            return $this->sendResponse([], false, Response::HTTP_UNAUTHORIZED, "UNAUTHOORIZED USER");
        }

        $payload = Tasks::all();

        if (count($payload) < 1) {
            return $this->sendResponse([], false, Response::HTTP_BAD_REQUEST, "NO TASKS ON THE DATABASE");
        }

        return $this->sendResponse(TaskResource::collection($payload), true, Response::HTTP_OK, "TASK LISTS");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        /*
        |--------------------------------------------------------------------------
        | set payload
        |--------------------------------------------------------------------------
        */
        $request->merge(['deadline' => now()->addHour(2), "user_id" => $request->user()["id"]]);
        $payload = $request->only(["title", "user_id", "category", "deadline", "description", "priority", "user_id", "deadline"]);

        /*
        |--------------------------------------------------------------------------
        | validate request
        |--------------------------------------------------------------------------
        */
        $request->validated($request->all());

        /*
        |--------------------------------------------------------------------------
        | login
        |--------------------------------------------------------------------------
        */
        if (!Auth::attempt($payload)) {
            return $this->sendResponse(null, false, Response::HTTP_NOT_ACCEPTABLE, "NO TASKS");
        }

        // store the data
        $task = Tasks::create($payload);

        // return response
        return $this->sendResponse(new TaskResource($task), true, Response::HTTP_OK, "successfully uploaded to the db");
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
    public function destroy(Tasks $tasks, $id)
    {
        $tasks::destroy($id);

        return response()->json([
            "successful" => true,
            "message" => "successfully deleted"
        ], Response::HTTP_OK);
    }
}
