<?php

namespace App\Http\Controllers\Api;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Responses;
use App\Models\Task;

class TaskApiController extends Controller
{
	use Responses;

    public function getList()
    {
    	try {
    		return $this->handleResponse(
    					$this->toArray(
    						Task::all()
    					),
    					config('status.http_codes.success')
				);	
    	} catch (Exception $e) {
    		return $this->handleResponse($e, config('status.http_codes.server_failed'));
    	}
    }

    public function create(Request $request)
    {
    	try {
    		// eloquent model to create the data, add guarded/fillable property in model
	    	$task = Task::create([
	    		'name'			=>	$request->name,
	    		'description'	=>	$request->description ?? '',
	    		'user_id'		=>	$request->user_id
	    	]);

	    	$array_task = $task->toArray();

	    	// return back the response
	    	return $this->handleResponse($task, config('status.http_codes.success'));
    	} catch (Exception $e) {
	    	return $this->handleResponse($e, config('status.http_codes.server_failed'));
    	}
    }

    public function update(Request $request, $id)
    {
    	try {
	    	// find the task with the $id
	    	$task = Task::find($id);

	    	if (is_null($task)) {
	    		throw new ModelNotFoundException('Task not exist!');
	    	}

	    	// update the task with new $request
	    	$task->update([
	    		'name'			=>	$request->name,
	    		'description'	=>	$request->description ?? '',
	    		'user_id'		=>	$request->user_id,
	    		'completed'		=>	$request->completed
	    	]);

	    	// return back to the response
	    	return $this->handleResponse($task, config('status.http_codes.success'));

	    } catch (ModelNotFoundException $e) {

	    	return $this->handleResponse($e, config('status.http_codes.not_found'));
    	
    	} catch (Exception $e) {

	    	return $this->handleResponse($task, config('status.http_codes.server_failed'));
    	}
    }

    public function delete($id)
    {
    	try {
    		// find the task with the $id
    		$task = Task::find($id);

    		if (is_null($task)) {
    			throw new ModelNotFoundException('Task not found!');
    		}

    		// delete the task
    		$task->delete();

    		// return success response	
    		return $this->handleResponse(null, config('status.http_codes.success'));

    	} catch (ModelNotFoundException $e) {

    		return $this->handleResponse($e, config('status.http_codes.not_found'));

    	} catch (Exception $e) {
    		
    		return $this->handleResponse($e, config('status.http_codes.server_failed'));

    	}
    }

    public function toArray($data)
    {
    	$responses = [];

    	foreach ($data as $task) {
	    	$responses[] = [
	    		'id'			=> $task->id,
	    		'name' 			=> $task->name,
	    		'description' 	=> $task->description,
	    		'completed' 	=> ($task->completed) 
	    							? 'Completed' 
	    							: 'Incompleted',
	    		'created_by'	=> $task->user->name
	    	];
    	}

    	return $responses;
    }
}
