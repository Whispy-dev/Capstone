<?php
namespace App\Http\Controllers\Api;

use App\Models\DeviceToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeviceTokenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'user_id' => 'required|integer',
            'platform' => 'nullable|string',
        ]);

        if($request->user_id){
                DeviceToken::updateOrCreate(
                    ['token' => $request->token],
                    ['user_id' => $request->user_id, 'platform' => $request->platform]
                );
        
                return response()->json(['message' => 'Token registrado correctamente']);
        }else{
             return response()->json(['message' => 'Token No registrado correctamente']);
        }
    }
}