<?php
   
namespace App\Http\Controllers\API;
   
use Validator;
use App\Models\Card;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
   
class AuthController extends BaseController
{

    public function signin(Request $request)
    {
        if(Auth::attempt(['name' => $request->name, 'password' => $request->password])){ 
            $authUser = Auth::user(); 
            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken; 
            $success['name'] =  $authUser->name;
            $success['id'] =  $authUser->id;
   
            return $this->sendResponse($success, 'User signed in');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'companyname' => '',
            'email' => 'nullable|email',
            'password' => 'required',
            'phone' => '',
            'confirm_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;
        $success['id'] =  $user->id;
   
        return $this->sendResponse($success, 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'companyname' => '',
            'email' => 'email',
            'phone' => '',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $user = Auth::id();
        $user = User::find($user);
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->companyname = $input['companyname'];
        $user->phone = $input['phone'];
        $user->save();
        
        return $user;
    }


    public function shows($id)
    {
        $usr = User::find($id);
        $blg = $usr->cards;
        $blg = Card::with('user')->orderBy('created_at', 'DESC')->get();

        return $blg;
    } 
    
    public function getUser()
    {
        $usr = Auth::id();
        $usr = User::find($usr);
        return $usr;
    }
}