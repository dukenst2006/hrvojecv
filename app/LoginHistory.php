<?php

namespace App;

use App\LoginHistory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginHistory extends Model
{
   	public $timestamps = false;

  	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'login'
    ];

    public static function getAllUsersWithLastLogin()
    {
        $allUsers = DB::table('users')
                        ->leftJoin('login_histories', 'login_histories.user_id', '=', 'users.id')
                        ->select(DB::raw('max(users.name) as name, max(users.role) as role, max(users.email) as email, max(login_histories.login) as login, max(users.hash) as hash, max(users.address) as address, max(users.company) as company , max(users.created_at) as created_at'))
                        ->groupBy('users.id')
                        ->get();

        return $allUsers;
    }

    public function setLastLogin($id = NULL)
    {
        if ($id == NULL) {
            $id = Auth::id();
        }

        $setLastLogin = new LoginHistory();
        $setLastLogin->user_id = $id;
        $setLastLogin->login = new \DateTime();
        $setLastLogin->save();

        if(!$setLastLogin)
        {
            return response('status', 'Last login information was not successfully stored.', 500);
        }

        return $setLastLogin;
    }
}
