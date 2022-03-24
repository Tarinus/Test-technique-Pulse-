<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;
use App\Http\Resources\Card as CardResource;
   
class CardController extends BaseController
{

    public function index()
    {
        $cards = Card::all();
        $cards = Card::with('user')->orderBy('created_at', 'DESC')->get();
        return $cards;
    }

    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'companyname' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $input['user_id'] = Auth::id();
        $card = Card::create($input);

        return $this->sendResponse($card, 'Card created.');
        
    }

   
    public function show($id)
    {
        $card = Card::with('user')->orderBy('created_at', 'DESC')->find($id);;
        if (is_null($card)) {
            return $this->sendError('Cart does not exist.');
        }
        return $card;
    }
    

    public function update(Request $request, Card $card)
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

        $card->description = $input['description'];
        $card->save();
        
        return $this->sendResponse($card, 'Post updated.');
    }
   
    public function destroy(Card $card)
    {
        $card->delete();
        return $this->sendResponse([], 'Post deleted.');
    }

}