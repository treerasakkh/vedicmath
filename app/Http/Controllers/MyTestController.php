<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

Collection::macro('twofirst',function(){
    return array_slice($this->items,0,2);
});
class MyTestController extends Controller
{
    //
    public function index(){

        Collection::macro('toInt',function(){
            return intval(implode($this->items));
        });


        $collect = collect([
            'name'=>'Tee',
            'age'=>44
        ]);

        $rs = $collect->select(['name,age']);

        dd($rs);
    }
}
