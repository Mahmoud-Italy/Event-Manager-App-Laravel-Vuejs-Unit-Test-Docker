<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use DB;

class DashboardController extends Controller
{
    private $apVersion = 'v1.0';
    public function hasToken($accessToken)
    {
        $err = false;
        if (!$accessToken) { $err = 'accessToken is required.'; } 
        else if (!Helper::whoIs($accessToken)) { $err = 'Invalid accessToken.'; }
        return $err;
    }

    public function index(Request $request)
    {
        $statusCode = 500;
        $err = $eventChart = NULL;
        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else {
            try {
                $user_id = Helper::whoIs($request->accessToken);
                
                $isAdmin = false;
                if(Helper::fetchUser($request->accessToken,'role_id')) $isAdmin = true;

                $mo01 = Helper::eventMonth($user_id, $isAdmin, '01');
                $mo02 = Helper::eventMonth($user_id, $isAdmin, '02');
                $mo03 = Helper::eventMonth($user_id, $isAdmin, '03');
                $mo04 = Helper::eventMonth($user_id, $isAdmin, '04');
                $mo05 = Helper::eventMonth($user_id, $isAdmin, '05');
                $mo06 = Helper::eventMonth($user_id, $isAdmin, '06');
                $mo07 = Helper::eventMonth($user_id, $isAdmin, '07');
                $mo08 = Helper::eventMonth($user_id, $isAdmin, '08');
                $mo09 = Helper::eventMonth($user_id, $isAdmin, '09');
                $mo10 = Helper::eventMonth($user_id, $isAdmin, '10');
                $mo11 = Helper::eventMonth($user_id, $isAdmin, '11');
                $mo12 = Helper::eventMonth($user_id, $isAdmin, '12');
                $eventChart = [$mo01, $mo02, $mo03, $mo04, $mo05, $mo06, $mo07, $mo08, $mo09, $mo10, $mo11, $mo12];
                $statusCode = 200;
             } catch (\Exception $e) { $err = 'Something went wrong.'; }
        }
        return response()->json(['statusCode'=>$statusCode, 'err'=>$err, 'eventChart'=>$eventChart]);
    }


    public function rowStatus(Request $request)
    {
        $statusCode = 500;
        $err = NULL;
        $namespace = '\\App\\';
        $model = $namespace . $request->modelName;

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else if (!$model::where('id', $request->rowId)->count()) { $err = 'No data found.'; }
        else if ($request->modelName != 'User' && !$model::where(['id'=> $request->rowId, 'user_id'=>Helper::whoIs($request->accessToken)])->count() &&
                 !Helper::fetchUser(Helper::whoIs($request->accessToken), 'role_id')) { $err = 'You can only update status your own data.'; }
        else if ($request->modelName == 'User' && !$model::where(['id'=> $request->rowId, 'id'=>Helper::whoIs($request->accessToken)])->count() &&
                 !Helper::fetchUser(Helper::whoIs($request->accessToken), 'role_id')) { $err = 'You can only update status your own data.'; }
        else {
    		  if($model::where('id', $request->rowId)->count()) {
    	    	$row = $model::where('id', $request->rowId)->first();
    	    	$row->status = ($row->status == 1) ? 0 : 1;
    	    	$row->save();
                $statusCode = 200;
	    	}
        }
    	return response()->json(['statusCode'=>200]);
    }

}
