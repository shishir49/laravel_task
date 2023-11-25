<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function verifyUser(Request $request) {

        if(auth()->attempt(array('email' => $request->email, 'password' => $request->password)))
        {
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('BlogApplication')->plainTextToken; 
            $success['name'] =  $user->name;
            $success['type'] =  $user->type;
            $success['message'] = 'User login successfully.';

            \Session::put('userType', $user->type);

            return response()->json($success, 200);
            
        }else{
            return redirect()->route('login')
                ->with(['error' => 'Email-Address And Password Are Wrong.']);
        }




        // if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
        //     $user = Auth::user(); 
        //     $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
        //     $success['name'] =  $user->name;

        //     return $this->sendResponse($success, 'User login successfully.');

        // } 

        // else{ 
        //     return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        // } 
    }

    public function registration() {
        return view('auth.registration');
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|min:3',
            'username'   => 'required',
            'email'      => 'required|email',
            'password'   => 'required|min:8',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());      
        }

        
        $input              = $request->all();
        $input['password']  = bcrypt($input['password']);
        $input['username']  = $input['username'];
        $input['type']      = $input['type'];
        $user               = User::create($input);
        $success['token']   = $user->createToken('BlogApplication')->plainTextToken;
        $success['name']    = $user->name;
        $success['type']    = $user->type;
        $success['message'] =  'User register successfully.';

        \Session::put('userType', $user->type);
   
        return response()->json([$success, 200]);
    }

    public function logout() {
        try{
            Auth::logout();
            return redirect()->route('login')->with(['msg' => 'Logout Successful!']);
        } catch(\Exception $e) {
            return response()->json(['msg' => 'Server Error']);
        }
    }
}
