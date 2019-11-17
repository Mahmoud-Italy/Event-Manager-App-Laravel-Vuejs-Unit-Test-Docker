<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Resources\Meetings as MeetingResource;
use App\Http\Resources\Calls as CallResource;
use App\Http\Resources\Members as MemberResource;
use App\AppSetting;
use App\User;
use App\Meeting;
use App\Call;
use DeviceTrust;
use Helper;
use DB;

class MemberController extends Controller
{
    /**
    * __constract with validation on accessToken
    * 
    * @var array
    */
    private $apVersion = 'v1.0';
    public function hasToken($accessToken)
    {
        $err = false;
        if (!$accessToken) { $err = 'accessToken is required.'; } 
        else if (!Helper::whoIs($accessToken)) { $err = 'Invalid accessToken.'; }
        return $err;
    }

    /**
    * member list function with array ['id'=> $id, 'name'=>$name] 
    * 
    * @var array
    */
    public function list(Request $request)
    {
    	$statusCode = 200;
    	$err = $data = NULL;

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else {
        	$rows = User::where(['status'=> true, 'suspend'=>false, 'role_id'=>false])->get();
        	foreach ($rows as $row) {
        		$data[] = ['id'=>$row->id, 'name'=>$row->name.' - '.$row->email];
        	}
        }
    	return response()->json(['statusCode'=>$statusCode, 'err'=>$err, 'data'=>$data]);
    }

     /**
    * index function with return all members
    * 
    * @var array
    */
    public function index(Request $request)
    {
        $statusCode = 500;
        $err = NULL;
        $data = $meta = $res = [];

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else if (!Helper::fetchUser(Helper::whoIs($request->accessToken), 'role_id')) { $err = 'Access denied.'; }
        else {
            try {
                $user_id = Helper::whoIs($request->accessToken);

                $paginate = DeviceTrust::settings('BACKEND_PAGINATION');
                if($request->paginate) { $paginate = $request->paginate; }
                
            	   $data = User::where('role_id', false);

                if($request->search) { 
                    $data = $data->where('name', 'LIKE','%'.$request->search.'%')
                    					->orwhere('email','LIKE','%'.$request->search.'%');
                }
            							
            	   $data = $data->orderBy('id','DESC')
            							->paginate($paginate);
                
                $res = MemberResource::collection($data);
                $arr = $data->toArray();
                $meta = ['current_page'=> $arr['current_page'], 'last_page'=> $arr['last_page'], 'next_page_url'=> $arr['next_page_url'], 
                               'prev_page_url'=> $arr['prev_page_url'], 'per_page' => $arr['per_page'], 'total'=> $arr['total']];
                $statusCode = 200;
            } catch (\Exception $e) { $err = 'Something went wrong.'; }
        }
        return response()->json(['statusCode'=>$statusCode, 'err'=>$err, 'data'=>$res, 'meta'=>$meta]);
    }


    /**
    * meetings function with return all meetings for specific member
    * 
    * @var array
    */
    public function meetings(Request $request)
    {
        $statusCode = 500;
        $err = NULL;
        $data = $meta = $res = [];

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else if (!Helper::fetchUser(Helper::whoIs($request->accessToken), 'role_id')) { $err = 'Access denied.'; }
        else {
            try {
                $user_id = Helper::whoIs($request->accessToken);

                $paginate = DeviceTrust::settings('BACKEND_PAGINATION');
                if($request->paginate) { $paginate = $request->paginate; }
                
            	   $data = Meeting::where('user_id', $request->user_id);

                if($request->search) { 
                    $data = $data->where('title', 'LIKE','%'.$request->search.'%');
                }
            							
            	   $data = $data->orderBy('id','DESC')
            							->paginate($paginate);
                
                $res = MeetingResource::collection($data);
                $arr = $data->toArray();
                $meta = ['current_page'=> $arr['current_page'], 'last_page'=> $arr['last_page'], 'next_page_url'=> $arr['next_page_url'], 
                               'prev_page_url'=> $arr['prev_page_url'], 'per_page' => $arr['per_page'], 'total'=> $arr['total']];
                $statusCode = 200;
            } catch (\Exception $e) { $err = 'Something went wrong.'; }
        }
        return response()->json(['statusCode'=>$statusCode, 'err'=>$err, 'data'=>$res, 'meta'=>$meta]);
    }

    /**
    * calls function with return all meetings for specific member
    * 
    * @var array
    */
    public function calls(Request $request)
    {
        $statusCode = 500;
        $err = NULL;
        $data = $meta = $res = [];

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else if (!Helper::fetchUser(Helper::whoIs($request->accessToken), 'role_id')) { $err = 'Access denied.'; }
        else {
            try {
                $user_id = Helper::whoIs($request->accessToken);

                $paginate = DeviceTrust::settings('BACKEND_PAGINATION');
                if($request->paginate) { $paginate = $request->paginate; }
                
                   $data = Call::where('user_id', $request->user_id);

                if($request->search) { 
                    $data = $data->where('title', 'LIKE','%'.$request->search.'%');
                }
                                        
                   $data = $data->orderBy('id','DESC')
                                        ->paginate($paginate);
                
                $res = CallResource::collection($data);
                $arr = $data->toArray();
                $meta = ['current_page'=> $arr['current_page'], 'last_page'=> $arr['last_page'], 'next_page_url'=> $arr['next_page_url'], 
                               'prev_page_url'=> $arr['prev_page_url'], 'per_page' => $arr['per_page'], 'total'=> $arr['total']];
                $statusCode = 200;
            } catch (\Exception $e) { $err = 'Something went wrong.'; }
        }
        return response()->json(['statusCode'=>$statusCode, 'err'=>$err, 'data'=>$res, 'meta'=>$meta]);
    }

     /**
    * suspend function
    * 
    * @var array
    */
    public function suspend(Request $request)
    {
        $statusCode = 500;
        $err = NULL;

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else if(!User::where('id', $request->user_id)->count()) { $err = 'No data found.'; }
        else if (!Helper::fetchUser(Helper::whoIs($request->accessToken), 'role_id')) { $err = 'Access denied.'; }
        else {
            $row = User::findOrFail($request->user_id);
            $row->suspend = ($row->suspend == 1) ? 0 : 1;
            $row->save();
            $statusCode = 200;
        }
        return response()->json(['statusCode'=>$statusCode, 'err'=>$err]);
    }

     /**
    * destroy function
    * 
    * @var array
    */
    public function destroy(Request $request)
    {
        $statusCode = 500;
        $err = NULL;

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else if(!User::where('id', $request->user_id)->count()) { $err = 'No data found.'; }
        else if (!Helper::fetchUser(Helper::whoIs($request->accessToken), 'role_id')) { $err = 'Access denied.'; }
        else {
            $row = User::findOrFail($request->user_id);
                if($row->image) { \File::Delete($row->image); }
            $row->delete();
            $statusCode = 200;
        }
      	return response()->json(['statusCode'=>$statusCode, 'err'=>$err]);
    }


}
