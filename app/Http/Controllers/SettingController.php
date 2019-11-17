<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppSetting;
use Helper;
use Image;

class SettingController extends Controller
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
    * index function to display appSetting
    * 
    * @var array
    */
    public function index(Request $request)
    {
        $statusCode = 500;
        $err = NULL;
        $row = [];
            try {
                $row = AppSetting::FirstOrCreate(['id'=>1]);
                $statusCode = 200;
            } catch (\Exception $e) { $err = 'Something went wrong.'; }
        return response()->json(['statusCode'=>$statusCode, 'err'=>$err, 'row'=>$row]);
    }

    /**
    * update function to update appSetting
    * 
    * @var array
    */
    public function update(Request $request)
    {
        $statusCode = 500;
        $err = NULL;

        if(self::hasToken($request->accessToken)) { $err = self::hasToken($request->accessToken); }
        else if(!Helper::fetchUser(Helper::whoIs($request->accessToken), 'role_id')) { $err = 'Access denied.'; }
        else {
            try {
                $row = AppSetting::FirstOrCreate(['id'=>1]);

                    if($request->hasFile('logo')) {
                        $row->logo = Helper::uploadWithResize($request->file('image'));
                    }

                $row->title = $request->title;
                $row->email = $request->email;
                $row->mobile = $request->mobile;
                $row->save();
                $statusCode = 201;
            } catch (\Exception $e) { $err = 'Something went wrong.'; }
        }
        return response()->json(['statusCode'=>$statusCode, 'err'=>$err]);
    }
}
