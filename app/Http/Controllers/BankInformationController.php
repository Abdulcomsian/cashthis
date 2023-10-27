<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankInformation;

class BankInformationController extends Controller
{
    public function bankInformation()
    {
        return view('bank-information');
    }

    public function addBankInformation(Request $request)
    {
        $request->validate([
            'bank_name' => 'required|string',
            'routing_number' => 'required|string',
            'account_number' => 'required|string',
            'account_name' => 'required|string',
        ]);
        try{
            
    
            BankInformation::create([
                'name' => $request->bank_name,
                'routing_number' => $request->routing_number,
                'account_number' => $request->account_number,
                'account_name' => $request->account_name,
                'user_id' => auth()->user()->id,
            ]);

            return redirect()->route('card');

        }catch(\Exception $e){
            return redirect()->back()->with(['status' => false , 'error' => $e->getMessage() ]);
        }

    }

}
