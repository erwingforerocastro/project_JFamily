<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\core;
use DB;
class CoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function familyStructure($id){
        try {
            $structure_1=DB::table('cores as c')->where('c.vertex_1',$id)->join('users as u','u.id','=','c.vertex_2')
                                                ->select('u.*','c.*')->get();
            $structure_2=DB::table('cores as c')->where('c.vertex_2',$id)->join('users as u','u.id','=','c.vertex_1')
                                                ->select('u.*','c.*')->get();
            return response()->json([
                      'html'=>view('users.family')->with(['family_1'=>$structure_1,'family_2'=>$structure_2,'user_principal'=>$id])->render(),
            ]);
        } catch (Exception $e) {
                return'Excepción capturada:'.$e->getMessage();
        }
        
    
    }
    public function familyStructureNew($id){
        try {
            return response()->json([
                'html'=>view('users.add_family')->with(['id'=>$id])->render(),
            ]);
        } catch (Exception $e) {
            return'Excepción capturada:'.$e->getMessage();
        }
    }

    public function familyStructureSave($id,Request $request){
        try {
            $user=new User();
            $user=$user->create([
                'identification'=>$request->identification,
                'name'=>$request->name,
                'age'=>$request->age,
                'ocupation'=>$request->ocupation,   
             ]);

             $core=new Core();
             $core->create([
                 'level'=>$request->consanguinity,
                 'description'=>$request->relationship,
                 'vertex_1'=>$id,
                 'vertex_2'=>$user->id,
             ]);
        } catch (Exception $e) {
            return'Excepción capturada:'.$e->getMessage();
        }
    }
}
