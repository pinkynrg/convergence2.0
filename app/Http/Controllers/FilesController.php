<?php namespace App\Http\Controllers;

use Auth;
use Input;
use Response;
use App\Models\File;
use App\Models\Ticket;
use App\Models\Person;
use App\Models\Post;
use File as FileManager;
use App\Libraries\FilesRepository;

class FilesController extends Controller {

	protected $media;

	public function __construct(FilesRepository $filesRepository)
    {
        $this->repo = $filesRepository;
    }

    public function listFiles($target, $target_action, $target_id) {

	    $resource_type = 'App\\Models\\'.ucfirst(str_singular($target));
	    $uploader_id = Auth::user()->active_contact->id;

	    if ($target == "posts") { 
	    	if ($target_action == "create") {
	    		$post = Post::where('author_id',$uploader_id)->where("status_id","=",POST_DRAFT_STATUS_ID)->where("ticket_id",$target_id)->first(); 
	    	}
	    	elseif ($target_action == "edit") {
	    		$post = Post::where("id",$target_id)->first();
	    	}
		    $id = isset($post->id) ? $post->id : null;
	    }
	    elseif ($target == "tickets") { 
	    	if ($target_action == "create") {
		    	$ticket = Ticket::where('status_id',TICKET_DRAFT_STATUS_ID)
		    		->where('creator_id',$uploader_id)
		    		->first();
		    }
		    else {
	    		$ticket = Ticket::where("id",$target_id)->first();
		    }
		    $id = isset($ticket->id) ? $ticket->id : null;
		}
		elseif ($target == "people") {
			$target_id = is_null($target_id) ? Auth::user()->owner->id : $target_id;
			$person = Person::find($target_id);
			$id = $person->id;
		}

		$files = is_null($id) ? [] : File::where('resource_type',$resource_type)->where("resource_id",$id)->get();

		foreach ($files as $file) {
			$file->size = filesize(RESOURCES.DS.$file->file_path.DS.$file->file_name);
		}

		return $files;
    }

	public function show($id) {
		$file = File::find($id);
    	return response()->download($file->real_path(), $file->name);
	}
    
    public function upload()
    {
    	$uploader_id = Auth::user()->active_contact->id;

    	if (Input::file('file')->isValid()) {    		

		    if (Input::get('target') == "posts") {
		    	if (Input::get('target_action') == "create") {
		    		$target = Post::where('author_id',$uploader_id)
		    			->where("status_id","=",POST_DRAFT_STATUS_ID)
		    			->where("ticket_id",Input::get('target_id'))
		    			->first(); 
		    	}
		    	elseif (Input::get('target_action') == "edit") {
		    		$target = Post::where("id",Input::get('target_id'))
		    			->first(); 
		    	}
		    }
		    elseif (Input::get('target') == "tickets") {
		    	if (Input::get('target_action') == "create") {
		    		$target = Ticket::where('status_id',TICKET_DRAFT_STATUS_ID)
		    			->where('creator_id',$uploader_id)
		    			->first();
		    	}
		    	elseif (Input::get('target_action') == "edit") {
		    		$target = Ticket::where("id",Input::get('target_id'))
		    			->first();
		    	}
 		    }

		    $id = $target->id;
	
	        $request['target_id'] = $id;
	        $request['uploader_id'] = $uploader_id;

	    	$request['file'] = Input::file('file');
	        $request['target'] = Input::get('target');
	        $request['target_action'] = Input::get('target_action');

	        $response = $this->repo->upload($request);

	        $response = Response::json($response, 200);

	        return $response;
	    }
    }

    public function destroy($id) {
    	return $this->repo->destroy($id);
    }
}