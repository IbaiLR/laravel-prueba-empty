<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\UserPreference; 
use App\Models\Task; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function register(Request $req){

    $validator = Validator::make($req->all(),[
        'name' =>'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email|max:255',
        'password' => 'required|min:6',
        'confirm_password' => 'required|same:password'
    ]);

    if($validator->fails()){
        return response()-> json($validator -> errors(), 400);
    }

    $user = User::create([
        'name' =>$req->name,
        'lastname' => $req->lastname,
        'email' => $req -> email,
        'password' => Hash::make($req->password),
        'biography' => $req->biography,
        'website' => $req->website
        

    ]);

    return response()-> json(['message' => 'Usuario Creado'], 201);
    }

    public function update(Request $req){
        $validator = Validator::make($req->all(),[
            'name'=> 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email',
            'biography' => 'string|max:255',
            'website' => 'string|max:255'
        ]);

        if($validator->fails()){
            return response()-> json($validator -> errors(), 400);
        }
        $user = User::find($req->id);
        if($user){
            $user->update([
                'name'=> $req->name,
                'lastname' => $req->lastname,
                'email' => $req->email,
                'biography'=> $req->biography,
                'website' => $req->website
            ]);
        }

        return response()->json(["Message"=>"Usuario acrualizado"], 201);
    }

    public function destroy($id){
        $user = User::find($id);
        if($user){
           $user->delete();
           return response()->json(["Message"=> "Usuario eliminado correctamente"], 200);

        } else{
            return response()-> json(["Message"=>"Usuario no encontrado"], 404);
        }
    }

    public function show(Request $req, $id){
        $user = User::find($id);
        if($user){
          
           return response()->json([
            'name'=> $user->name
           ], 200);
        } else{
            return response()-> json(['Message'=>"Usuario no encontradooo"], 404);
        }
    }

    public function login(Request $req){
        $validator = Validator::make($req->all(),[
            'email'=>'required|string|email|max:255',
            'password' =>'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json(["Message"=>"Formato inadecuado"], 400);
        }

        $user = User::where('email', $req->email)->first();
        if(!$user || !Hash::check($req->password, $user->password)){
            return response()-> json(["Message" =>"Credenciales incorrectas"],401);
        }

        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json([
            "Message"=>"Sesion iniciada correctamente",
            "Nombre" => $user->name,
            "Apellidos" => $user->lastname,
            "Email" => $user->email,
            "token"=> $token
            ], 200);
        
    }

    public function getPreferences(Request $req, $id){
        $user = User::find($id);
            if(!$user){
                return response()-> json(["Message"=>"Usuario no encontrado"], 404);
            }
        $preferences= UserPreference::where('user_id', $id)->get();
        return response()->json($preferences, 200);

        
    }

    public function getTasks(Request $req, $id){
        $user = User::find($id);
        if(!$user){
            return response()->json(["Message"=> "Usuario no encontrado"], 404);

        }

        $tasks = Task::where('user_id', $id)
        ->select('title', 'description')->get();

        return response()-> json($tasks, 200);
    
    }

    public function getLabels(Task $task) {
    // 1. Accedemos a la relación 'labels' definida en el modelo
    // 2. Usamos select para devolver solo id y name
    $labels = $task->labels()->select('labels.id', 'labels.name')->get();

    // 3. Retornamos el Array JSON
    return response()->json($labels, 200);
}

}