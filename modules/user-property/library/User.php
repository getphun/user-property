<?php
/**
 * User property provider
 * @package user-property
 * @version 0.0.1
 * @upgrade true
 */

namespace UserProperty\Library;
use UserProperty\Model\UserProperty as UProperty;

class User
{
    static $fetched = null;
    
    static function fetch($name, $reset=false){
        $dis = &\Phun::$dispatcher;
        
        if(!$dis->user->isLogin()){
            self::$fetched = null;
            return null;
        }
        
        if($reset)
            self::$fetched = null;
        
        $uid = $dis->user->id;
        
        if(self::$fetched && $uid == self::$fetched->user)
            return self::$fetched->$name ?? null;
        
        self::$fetched = (object)['user'=>$uid];
        
        $data = UProperty::get(['user' => $uid]);
        if($data){
            foreach($data as $row){
                self::$fetched->{$row->name} = $row->value;
                $dis->user->{$row->name} = $row->value;
            }
        }
        
        return self::$fetched->$name ?? null;
    }
}