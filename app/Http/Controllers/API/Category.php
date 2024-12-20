<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
class Category extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryList(Request $request)
    {
        $data = DB::table('category')->get();
   
        return $this->sendResponse($data, 'Category List.');
    }
}
