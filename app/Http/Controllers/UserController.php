<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use DB;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('users.user');
        } catch (Exception $e) {
            return'Excepción capturada:'.$e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $name='';
            if($request->hasFile('image')){

                $file=$request->file('image');
                $extension=$file->getClientOriginalExtension();
                $name=time().$file->getClientOriginalName();
                $r=Storage::disk('profiles')->put($name,\File::get($file));
            }
            $user=new User();

            $user->create([
               'identification'=>$request->identification,
               'name'=>$request->name,
               'phone'=>$request->phone,
               'age'=>$request->age,
               'ocupation'=>$request->ocupation,
               'email'=>$request->email,
               'image'=>$name,
            ]);
        } catch (Exception $e) {
            return'Excepción capturada:'.$e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response()->json([
                'html' => view('users.family')
                ->with(['user' => User::find($id)])
                ->render(),
            ]); 
        } catch (Exception $e) {
            return'Excepción capturada:'.$e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            return response()->json([
                'html' => view('users.edit_user')
                ->with(['user' => User::find($id)])
                ->render(),
            ]); 
        } catch (Exception $e) {
            return'Excepción capturada:'.$e->getMessage();
        }
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

        $request->validate([
            'email' => 'required|unique:users',
        ]);

        try {
            $name='';
            $user=User::find($id);
            if ($request->hasFile('image')) {
                if (File::exists(public_path() . '/profiles/' . $user->image)) {
                    File::delete(public_path() . '/profiles/' . $user->image);
                }
                $file            = $request->file('image');
                $name            = time() . $file->getClientOriginalName();
                $r               = Storage::disk('public_profiles')->put($name, \File::get($file));
            }

            $user->update([
               'name'=>$request->name,
               'phone'=>$request->phone,
               'age'=>$request->age,
               'ocupation'=>$request->ocupation,
               'email'=>$request->email,
               'image'=>$name,

            ]);
            return redirect()->action('UserController@index');
        } catch (Exception $e) {
            return'Excepción capturada:'.$e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
           User::find($id)->delete();
           DB::raw('ALTER TABLE tablename AUTO_INCREMENT = 1;');
           return redirect()->action('UserController@index');
        } catch (Exception $e) {
            return'Excepción capturada:'.$e->getMessage();
        }
    } 


}
