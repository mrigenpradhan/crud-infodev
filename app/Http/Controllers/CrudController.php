<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Data;

class CrudController extends Controller
{
    public function index()
    {
        $entries = Data::paginate(5);
        return view('index',compact('entries'));
    }

    //new data entry operation
    public function newData(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'gender' => 'required|string',
            'age' => 'required|integer'
        ]);

        $new_data = [ 
            'name'=>$request->name, 
            'email'=>$request->email, 
            'phone'=>$request->phone, 
            'gender'=>$request->gender, 
            'age'=>$request->age
        ];

        if(Data::create($new_data))
        {
            return back()->with('message','Data added successfully.');
        }
            return back()->with('errs','Something went wrong! Please try again.');
    }

    //edit data operation
    public function editData($id, Request $request)
    {
        
        $data = Data::find($id);
        if(  $data->update($request->all()) )
        {
            return back()->with('message','Data Updated.');
        }
            return back()->with('errs','Data could not be updated.');
    }

    //delete data operation
    public function deleteData($id)
    {
        $data = Data::where('id',$id)->first();
        if($data->delete())
        {
            return redirect (route('page.index'))->with('message','Data Deleted.');
        }
            return redirect (route('page.index'))->with('errs','Data could not be deleted.');
    }

}
