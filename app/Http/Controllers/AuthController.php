<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Helper;
use Auth;
use App;

class AuthController extends Controller
{

    /**
    * Register 
    *
    * @var array
    */
    public function register(Request $request)
    {
      $statusCode = 500;
      $err = $accessToken = NULL;

      if(!$request->name) { $err = 'Name is required.'; }
      else if(!$request->email) { $err = 'Email Address is required.'; }
      else if (!$request->password) { $err = 'Password is required.'; }
      else if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) { $err = 'Invalid Email Address.'; }
      else if (User::where('email', $request->email)->count()) { $err = 'Email Address already exists.'; }

      else {
        try {
            $user = User::create([
              'name' => $request->name,
              'email' => $request->email,
              'password' => bcrypt($request->password),
              'status' => true
            ]);
            $accessToken = $user->createToken('myApp')->accessToken; 
            return $this->respondWithToken($accessToken);
        } catch (\Exception $e) { $err = 'Something went wrong.'; }

      }
      return response()->json(['statusCode'=>$statusCode, 'err'=>$err]);
    }

    /**
    * Login 
    *
    * @var array
    */
    public function login(Request $request)
    {
      $statusCode = 500;
      $err = $accessToken = NULL;
      
      if(!$request->email) { $err = 'Email Address is required.'; }
      else if(!$request->password) { $err = 'Password is required.'; }
      else if (User::where('email', $request->email)->where('status', false)->count()) { $err = 'Your account is deactived.'; }
      else if (User::where('email', $request->email)->where('suspend', true)->count()) { $err = 'Your account has been suspended.'; }

      else if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) { 
              $user = Auth::user(); 
              $success['token'] = $user->createToken('myApp')->accessToken; 
              return $this->respondWithToken($success['token']); } 
      else { $err = 'Unauthorised Credentials.'; }
      return response()->json(['statusCode'=>$statusCode, 'err'=>$err]);
    }

    /**
    * Response with Token bearer 
    *
    * @var array
    */
    protected function respondWithToken($accessToken)
    {
      return response()->json([
        'statusCode' => 200,
        'accessToken' => $accessToken,
        'token_type' => 'bearer'
      ]);
    }

    /**
    * fetch User data 
    *
    * @var array
    */
    public function fetchUser(Request $request)
    {
      $statusCode = 500;
      $err = $row = NULL;

        $user_id = Helper::whoIs($request->accessToken);
        if(!$request->accessToken) { $err = 'accessToken is required.'; }
        else if (!User::where('id', $user_id)->count()) { $err = 'Invalid accessToken.'; }
        else {
            try {
                    $row = User::select('id','image','name','email','role_id as is_admin')
                                         ->where('id', $user_id)
                                         ->first();
                    $statusCode = 200;
            } catch(\Exception $e) { $err = 'Somethign went wrong.'; }
        }
        return response()->json(['statusCode'=>$statusCode, 'err'=>$err, 'row'=>$row]);
    }

}
