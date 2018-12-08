<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use Validator;

class FiatCurrencyController extends Controller
{
    //Showing list of view of Fiat Currencies
    public function index(){

        $data=[];
        $data['fiat_currencies']=Currency::where('currency_type','Fiat')->get();

        return view("currencies.fiat_currencies.index",$data);
    }
    //Create new Fiat Currency
    public function create(Request $request){
        return view("currencies.fiat_currencies.create");
    }
    //Store new Fiat currency
    public function store(Request $request){
        //return $request->all();
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:3',
            'slug'=>'required',
            'symbol'=>'required',
            'exchange_rate'=>'required'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('currencies/fiat/create')
                    ->withErrors($validator)
                    ->withInput();
            }
            else{
                 $currency= Currency::create([
                   'name'=>$request->name,
                   'slug'=>$request->slug,
                   'currency_type'=>'Fiat',
                   'symbol'=>$request->symbol,
                   'logo'=>'',
                   'circulating_supply'=>0,
                   'max_supply'=>0,
                   'total_supply'=>0,
                   'exchange_rate'=>$request->exchange_rate,
                     'mineable'=>0,
                     'ranking'=>'',
                     'status'=>1
                 ]);
                return redirect('currencies/fiat');

            }
        }else {
            abort(403, 'Unauthorized action.');
        }
    }
    //Changing status of Fiat Currency
    public function changeStatus(Request $request){
        $token=$request->_token;
        $cid=$request->cid;
        $status=$request->status;
        if($status==0){
            $currency=Currency::find($cid);
            $currency->status=1;
            $currency->save();
            $response = array(
                'status' => 'Active',
                'msg' => "success",
            );
            return response()->json($response);
        }
        elseif ($status==1){
            $currency=Currency::find($cid);
            $currency->status=0;
            $currency->save();
            $response = array(
                'status' => 'Inactive',
                'msg' => "success",
            );
            return response()->json($response);

        }

    }
    //load Edit View
    public function edit(Request $request){
        $currency=Currency::find($request->cid);
        $data['fiat_currencies']=$currency;
        return view("currencies.fiat_currencies.update",$data);
    }
    //Updating Fiat Currency
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:3',
            'slug'=>'required',
            'symbol'=>'required',
            'exchange_rate'=>'required'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('currencies/fiat/create')
                    ->withErrors($validator)
                    ->withInput();
            }
            else{
                $currency=Currency::find($request->id);
                $currency->name=$request->name;
                $currency->slug=$request->slug;
                $currency->symbol=$request->symbol;
                $currency->exchange_rate=$request->exchange_rate;
                $currency->save();
                return redirect('currencies/fiat');
            }

        }else {
            abort(403, 'Unauthorized action.');
        }
    }
    //Deletin Fiat Currency
    public function destory(Request $request){
        $currency=Currency::find($request->cid);
        $currency->delete();
        return redirect('currencies/fiat');

    }
    //Update Fiat Currency Exchange Rate
    public function updateExchangeRate(Request $request){

        $currency=Currency::find($request->cid);
        $currency->exchange_rate=$request->exchange_rate;
        $currency->save();
        $response = array(
            'status' => 'Updated',
            'msg' => "success",
        );
        return response()->json($response);
    }

}
