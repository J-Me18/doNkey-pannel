<?php

namespace App\Http\Controllers;

use App\Models\Pincode;
use Illuminate\Http\Request;


class PincodeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:pincode-list|pincode-create|pincode-edit|pincode-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:pincode-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pincode-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pincode-delete', ['only' => ['destroy']]);
    }

    //Pincode
    public function index()

    {
        $pincode = Pincode::with(['subscriber'])
            ->get();
        //dd($pincode);
        return view('admin.pincode.index', compact('pincode'));
    }

    public function create()
    {
        return view('admin.pincode.create');
    }
    public function pincodestore(Request $request)
    {
        $this->validate($request, [
        'state' => 'required|alpha',
            'district' => 'required|alpha',
            'city' => 'required|alpha',
            'pincode' => 'required|numeric|unique:pincode,pincode',
        ]);
        $pincode = new Pincode();
        $pincode->district = $request->get('district');
         $pincode->state= $request->get('state');
        $pincode->city = $request->get('city');
        $pincode->taluk = $request->get('taluk');
        $pincode->pincode = $request->get('pincode');
        $pincode->save();


        //return back()->with('success', 'You have just created one pincode');
        return redirect('pincode')->with('success', 'Pincode added!');
    }
    public function edit($id)
    {
        $pincode = Pincode::find($id);
        return view('admin.pincode.edit', compact('pincode'));
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [
        'state' => 'required|alpha',
            'district' => 'required|alpha',
            'city' => 'required|alpha',
            'pincode' => 'required|numeric',
        ]);
        $count = Pincode::where("id", "!=", $id)->where("pincode", $request->input('pincode'))->count();
        if ($count > 0) {
            $this->validate($request, [
            'state' => 'required|alpha',
                'district' => 'required|alpha',
                'city' => 'required|alpha',
                'pincode' => 'required|numeric|unique:pincode,pincode',
            ]);
        } else {
            $pincode =  Pincode::findorFail($id);
              $pincode->state= $request->input('state');
            $pincode->district = $request->input('district');
            $pincode->pincode = $request->input('pincode');
            $pincode->city = $request->get('city');
            $pincode->taluk = $request->get('taluk');

            $pincode->update();

            return redirect('pincode')->with('status', 'Pincode Updated');
        }
    }
    public function destroy($id)
    {
        Pincode::find($id)->delete();
        return back()->with('success', 'Pincode deleted successfully');
    }
}
