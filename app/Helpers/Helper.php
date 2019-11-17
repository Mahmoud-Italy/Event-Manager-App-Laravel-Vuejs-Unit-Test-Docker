<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use \League\OAuth2\Server\ResourceServer;
use \Laravel\Passport\TokenRepository;
use \Laravel\Passport\Guards\TokenGuard;
use \Laravel\Passport\ClientRepository;
use App\User;
use DB;
use App;
use Auth;
use Image;

class Helper 
{

    #Get user_id from accessToken
	  static function whoIs_JWT($accessToken = false)
    {
        $user_id = 0;
        try {
            $token_parts = explode('.', $accessToken);
            $token_header = $token_parts[0];
            $token_header_json = base64_decode($token_header);
            $token_header_array = json_decode($token_header_json, true);
            $user_token = $token_header_array['jti'];
            $oauth_id = DB::table('oauth_access_tokens')->where('id', $user_token)->value('user_id');
            $user = User::findOrFail($oauth_id);
            $user_id = $user->id;
        } catch (\Exception $e) { $user_id = $e; }
        return $user_id;
    }

    #Get user_id from accessToken new way
    static function whoIs($bearerToken = false)
    {
        $user_id = 0;
        try {
            $tokenguard = new TokenGuard(
                App::make(ResourceServer::class), 
                Auth::createUserProvider('users'), 
                App::make(TokenRepository::class), 
                App::make(ClientRepository::class), 
                App::make('encrypter')
            );
            $request = Request::create('/');
            $request->headers->set('Authorization', 'Bearer ' . $bearerToken);
            $user_id = $tokenguard->user($request)->id;
        } catch (\Exception $e) {   }
        return $user_id;
    }

    #Fetch User
    static function fetchUser($user_id, $column)
    {
        $obj = false;
        if(User::where('id', $user_id)->count()) {
            $row = User::where('id', $user_id)->first();
            $obj = $row->$column;
        }
        return $obj;
    }

    #Has Default image just in case
    static function hasImage($image)
    {
        $obj = '/assets/images/avatar.png';
        if(isset($image)) {
            $obj = $image;
        }
        return $obj;
    }

    #Reformat date yyyy mm dd HH i s
    static function dateFormat($date)
    {
       return date('Y-m-d H:i:s', strtotime(explode('G', $date)[0]));
    }

    #Count Members in each Events
    static function getMembersCount($meeting_id, $tblName)
    {
      if($tblName == 'meeting_members') $column = 'meeting_id';
      else $column = 'call_id';
      return DB::table($tblName)->where($column, $meeting_id)->count();
    }

    #Get Event Months
    static function eventMonth($user_id, $isAdmin, $month)
    {
        $obj = 0;
        if($isAdmin) {
            $obj1 = DB::table('meetings')->where('status', true)->whereMonth('created_at', $month)->count();
            $obj2 = DB::table('calls')->where('status', true)->whereMonth('created_at', $month)->count();
            $obj = $obj1 + $obj2;
        } else {
            $obj1 = DB::table('meetings')->where('user_id', $user_id)->where('status', true)->whereMonth('created_at', $month)->count();
            $obj2 = DB::table('calls')->where('user_id', $user_id)->where('status', true)->whereMonth('created_at', $month)->count();
            $obj = $obj1 + $obj2;
        }
        return $obj;
    }

    #Upload Image process 
    static function uploadWithResize($file)
    {
      $obj = NULL;
        try {
            $path = '/uploads/events/';
            $fileName = date('Y-m-d-H-i-s').'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path().'/'.$path;
            $img = Image::make($file);
            $img->resize(524, 524, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$fileName);
            $obj = $path.$fileName;
        } catch (\Exception $e) { }
        return $obj;
    }

    #Get Time Elapsed 5min ago
    static public function timeElapsed($datetime, $full = false)
    {
      $now = new \DateTime;
      $ago = new \DateTime($datetime);
      $diff = $now->diff($ago);

      $diff->w = floor($diff->d / 7);
      $diff->d -= $diff->w * 7;

      $string = array(
          'y' => 'year',
          'm' => 'month',
          'w' => 'week',
          'd' => 'day',
          'h' => 'hour',
          'i' => 'min',
          's' => 'sec',
      );
      foreach ($string as $k => &$v) {
          if ($diff->$k) {
              $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
          } else {
              unset($string[$k]);
          }
        }

      if (!$full) $string = array_slice($string, 0, 1);
      return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}