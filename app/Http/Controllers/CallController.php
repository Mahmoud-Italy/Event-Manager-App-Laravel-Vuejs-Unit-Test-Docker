<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Resources\Calls as CallResource;
use App\Http\Resources\Members as MemberResource;
use App\AppSetting;
use App\Call;
use App\Call_member;
use App\User;
use DeviceTrust;
use Helper;
use Image;
use DB;

class CallController extends Controller
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
    * Index function that should be return array for rows to user data only.
    *
    * @var array
    */
    public function index(Request $request)
    {
        $statusCode = 500;
        $err = NULL;
        $data = $meta = $res = [];

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else {
            try {
                $user_id = Helper::whoIs($request->accessToken);

                $paginate = DeviceTrust::settings('BACKEND_PAGINATION');
                if($request->paginate) { $paginate = $request->paginate; }
                
            	   $data = Call::where('user_id', $user_id);

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
    * Store function that include create new or update depend on method type.
    *
    * @var array
    */
    public function store(Request $request)
    {
        $statusCode = 500;
        $err = $row = NULL;

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else if(strtotime(Helper::dateFormat($request->start_dateTime)) >= strtotime(Helper::dateFormat($request->end_dateTime))) { $err = 'Invalid  dateTime period.'; }
        else if($request->isMethod('put') && !Call::where('id', $request->call_id)->count()) { $err = 'No data found.'; }
        else if ($request->isMethod('put') && !Call::where(['id'=>$request->call_id, 'user_id'=> Helper::whoIs($request->accessToken)])->count()) 
            { $err = 'You can only edit your own data.'; }
        else {
            try {
                if($request->isMethod('put')) $row = Call::findOrFail($request->call_id);
                else $row = new Call;

                    if($request->hasFile('image')) {
                        $row->image = Helper::uploadWithResize($request->file('image'));
                    }
                    
                $row->user_id = Helper::whoIs($request->accessToken);
                $row->title = ($request->title) ? $request->title : $row->title;
                $row->content = ($request->content ) ? $request->content : $row->content;
                $row->start_dateTime = ($request->start_dateTime ) ? Helper::dateFormat($request->start_dateTime) : $row->start_dateTime;
                $row->end_dateTime = ($request->end_dateTime ) ? Helper::dateFormat($request->end_dateTime) : $row->end_dateTime;
                $row->status = true;
                $row->save();

                $statusCode = 201;
            } catch (\Exception $e) { $err = 'Something went wrong.'; }
        }
        return response()->json(['statusCode'=>$statusCode, 'err'=>$err, 'row'=>$row]);
    }

    /**
    * edit function with privileges
    *
    * @var array
    */
    public function edit(Request $request)
    {
        $statusCode = 500;
        $err = $row = $members = NULL;

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else if(!Call::where('id', $request->call_id)->count()) { $err = 'No data found.'; }
        else if (!Call::where(['id'=>$request->call_id, 'user_id'=> Helper::whoIs($request->accessToken)])->count()) { $err = 'You can only edit your own data.'; }
        else {
            $row = new CallResource(Call::findOrFail($request->call_id));
            $members = MemberResource::collection(DB::table('call_members as m')
                                ->select('u.id','u.image','u.name','u.email')
                                ->where('m.call_id', $request->call_id)
                                ->leftjoin('users as u','u.id','=','m.user_id')
                                ->get());
            $statusCode = 200;
        }
        return response()->json(['statusCode'=>$statusCode, 'err'=>$err, 'row'=>$row, 'members'=>$members]);
    }

    /**
    * destroy function that remove everything related with that event
    *
    * @var array
    */
    public function destroy(Request $request)
    {
        $statusCode = 500;
        $err = NULL;

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else if(!Call::where('id', $request->call_id)->count()) { $err = 'No data found.'; }
        else if (!Call::where(['id'=>$request->call_id, 'user_id'=> Helper::whoIs($request->accessToken)])->count()) {  $err = 'You can only delete your own data.'; }
        else {
            $row = Call::findOrFail($request->call_id);
                if($row->image) { \File::Delete($row->image); }
            $row->delete();
            Call_member::where('call_id', $request->meeting_id)->delete();
            $statusCode = 200;
        }
      	return response()->json(['statusCode'=>$statusCode, 'err'=>$err]);
    }

     /**
    * Invite member function that will allow add member to event
    *
    * @var array
    */
    public function inviteMember(Request $request)
    {
        $statusCode = 500;
        $err = NULL;

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else if(!$request->user_id) { $err = 'user_id is required.'; }
        else if(!$request->call_id) { $err = 'call_id is required.'; }
        else if(!User::where('id', $request->user_id)->count()) { $err = 'user_id not found.'; }
        else if(!Call::where('id', $request->call_id)->count()) { $err = 'call_id not found.'; }
        else if(!Call::where(['id'=>$request->call_id, 'user_id'=> Helper::whoIs($request->accessToken)])->count()) {  $err = 'You can only invite to your own event.'; }
        else if(Call_member::where('call_id', $request->call_id)->count() > 2) { $err = 'No more available slots.'; }
        else if(Call_member::where(['call_id'=> $request->call_id, 'user_id'=> $request->user_id])->count()) { $err = 'user_id already exists.'; }
        else {
            try {
                $row = new Call_member;
                $row->call_id = $request->call_id;
                $row->user_id = $request->user_id;
                $row->save();
                $statusCode = 201;
            } catch (\Exception $e) { $err = 'Something went wrong'; }
        }
        return response()->json(['statusCode'=>$statusCode, 'err'=>$err]);
    }

    /**
    * remove member function that will allow remove member from event
    *
    * @var array
    */
    public function removeMember(Request $request)
    {
        $statusCode = 500;
        $err = NULL;

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else if(!$request->user_id) { $err = 'user_id is required.'; }
        else if(!$request->call_id) { $err = 'call_id is required.'; }
        else if(!User::where('id', $request->user_id)->count()) { $err = 'user_id not found.'; }
        else if(!Call::where('id', $request->call_id)->count()) { $err = 'call_id not found.'; }
        else if(!Call::where(['id'=>$request->call_id, 'user_id'=> Helper::whoIs($request->accessToken)])->count()) {  $err = 'You can only remove from your own event.'; }
        else if(!Call_member::where(['call_id'=> $request->call_id, 'user_id'=>$request->user_id])->count()) { $err = 'No data found.'; }
        else {
            try {
                Call_member::where(['call_id'=> $request->call_id, 'user_id'=>$request->user_id])->delete();
                $statusCode = 200;
            } catch (\Exception $e) { $err = 'Something went wrong'; }
        }
        return response()->json(['statusCode'=>$statusCode, 'err'=>$err]);
    }
}
