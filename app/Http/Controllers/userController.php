<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        if(!$users->isEmpty())
        {
                    $finaldata['status']="Success";
                    $finaldata['reason']="record Exist";
                    $finaldata['data']=$users;

        }
        else
        {
                 $finaldata['status']="Failure";
                 $finaldata['reason']="record doesn't exist";
                 $finaldata['data']=null;
        }
        return response()->json($finaldata);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $users = new User;

        $users->name = $request->name;
         $users->email = $request->email;
          $users->password = $request->password;
           $users->confirmpassword = $request->confirmpassword;
        $users->save();
         if($users)
        {
                    $finaldata['status']="Success";
                    $finaldata['reason']="record Added";
                    $finaldata['data']=$users;

        }
        else
        {
                 $finaldata['status']="Failure";
                 $finaldata['reason']="record doesn't exist";
                 $finaldata['data']=null;
        }
        return response()->json($finaldata);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $users=User::where('id', $id)->first();

        if($users)
        {
                    $finaldata['status']="Success";
                    $finaldata['reason']="record Exist";
                    $finaldata['data']=$users;

        }
        else
        {
                 $finaldata['status']="Failure";
                 $finaldata['reason']="record doesn't exist";
                 $finaldata['data']=null;
        }
        return response()->json($finaldata);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $users=User::where('id', $id)->first();

        if($users)
        {
                    $users = User::find($id);
                    $users->update($request->all());
                    $finaldata['status']="Success";
                    $finaldata['reason']="record Updated";
                    $finaldata['data']=$users;

        }
        else
        {
                 $finaldata['status']="Failure";
                 $finaldata['reason']="record doesn't exist";
                 $finaldata['data']=null;
        }
        return response()->json($finaldata);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $users=User::where('id', $id)->first();

        if($users)
        {
                    $users=User::find($id);
                    $users->delete();
                    $users=User::where('id', $id)->first();
                    $finaldata['status']="Success";
                    $finaldata['reason']="record Removed";
                    $finaldata['data']=$users;

        }
        else
        {
                 $finaldata['status']="Failure";
                 $finaldata['reason']="record doesn't exist";
                 $finaldata['data']=null;
        }
        return response()->json($finaldata);
       
    }
}
