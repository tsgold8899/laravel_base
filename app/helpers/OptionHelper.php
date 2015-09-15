<?php
class OptionHelper {
    public static function getOption($user_id, $key) {
        $option = Option::where('user_id', '=', $user_id)->where('key', '=', $key)->first();
        return $option ? $option : new Option();
    }
    
    public static function getValue($user_id, $key) {
        // $option = Option::where('user_id', '=', $user_id)->where('key', '=', $key)->first();
        $option = OptionHelper::getOption($user_id, $key);
        $value = ($option && $option->id > 0) ? $option->value : Config::get('option.'.$key);
        return $value;
    }
    
    public static function setValue($user_id, $key, $value) {
        $option = OptionHelper::getOption($user_id, $key);
        $option->user_id = $user_id;
        $option->key = $key;
        $option->value = $value;
        
        try {
            $option->save();
            return array(
                    'code'      => 1,
                    'message'   => 'option has been saved successfully',
                    'data'      => $option->id
                );
        } catch (\Exception $e) {
            return array(
                    'code'      => 0,
                    'message'   => $e->getMessage(),
                    'data'      => ''
                );
        }
    }
}
