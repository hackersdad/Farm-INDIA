<?php
class Login
{
  public static function isloggedin()
  {
    if(isset($_COOKIE['SNID']))
    { 
      $user_id=DB::query('select user_id from login_tokens where token=:token',array(':token'=>sha1($_COOKIE['SNID'])))[0]['user_id'];
      if($user_id>0)
      {
        echo"<p class = 'loggedIn'>Logged in as ".DB::query('select userName from users where id=:id',array(':id'=>$user_id))[0]['userName'];echo "</p>";
        return $user_id;
      }
    }
  return false;
  }
}
