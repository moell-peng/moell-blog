<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    protected $fillable = ['key', 'value'];

    public $timestamps  = false;

    public static function keyValue($key)
    {
        return optional(System::where('key', $key)->first())->value;
    }

    public static function optionList()
    {
        $list = System::all(['key', 'value']);
        $system = call_user_func(function () {
            $init = [];
            $config = array_flip(config('blog.system_key'));
            foreach ($config as $key => $value) {
                $init[$key] = '';
            }
            return $init;
        });

        foreach ($list as $item) {
            $system[$item['key']]  = $item['value'];
        }

        return $system;
    }
}
