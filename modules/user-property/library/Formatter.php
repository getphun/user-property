<?php
/**
 * User property formatter
 * @package user-property
 * @version 0.0.1
 * @upgrade true
 */

namespace UserProperty\Library;
use UserProperty\Model\UserProperty as UProperty;

class Formatter
{
    static function format($object, $fetch=false){
        $objects = Formatter::formatMany([$object], false, $fetch);
        return $objects[0];
    }
    
    static function formatMany($objects, $arraykey=false, $fetch=false){
        $dis = \Phun::$dispatcher;
        
        if(!isset($dis->config->formatter['user-property'])){
            $config = $dis->config->formatter['user'];
            
            $properties = $dis->config->user_property;
            foreach($properties as $prop => $args){
                if(isset($args['format']))
                    $config[$prop] = $args['format'];
            }
            $dis->config->set('formatter', 'user-property', $config);
        }
        
        $ids = array_column($objects, 'id');
        $props = UProperty::get(['user'=>$ids], true);
        $props = $props ? group_by_prop($props, 'user') : [];
        
        foreach($props as $uid => $prs)
            $props[$uid] = array_column($prs, 'value', 'name');

        $new_props = array_keys($dis->config->user_property);
        $new_props = array_combine($new_props, array_fill(0, count($new_props), null));
        
        foreach($objects as $index => $object){
            $uprops = $props[$object->id] ?? [];
            $uprops = array_replace($new_props, $uprops);
            $object = object_replace($object,$uprops);
            $objects[$index] = $object;
        }
        
        return \Formatter::formatMany('user-property', $objects, $arraykey, $fetch);
    }
}