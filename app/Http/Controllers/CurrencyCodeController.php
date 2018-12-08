<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\CurrencyCode;

class CurrencyCodeController extends Controller
{
    //list view of Currency Code
    public function index(Request $request){

        $currencyCodes=DB::select('SELECT cc.id,cc.code as CurrencyCode,c.name as CurrencyName,ex.name as ExchangeName FROM `currency_codes` as cc JOIN `currencies` as c ON c.id=cc.cid JOIN `exchanges` as ex ON ex.id=cc.eid');
        $data['currencyCodes']=$currencyCodes;
        return view('currencyCodes.index',$data);
    }
    //Create View
    public function create(Request $request){
        return view('currencyCodes.create');
    }
    //Store new Currency code
    public function store(Request $request){
        //return $request->all();
        $validator=Validator::make($request->all(),[
            'cid'=>"required",
            'eid'=>'required',
            'code'=>'required'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('currencyCode/create')
                    ->withInput()
                    ->withErrors($validator);
            }else {
                $currencyCode=CurrencyCode::create([
                    'cid'=>$request->cid,
                    'eid'=>$request->eid,
                    'code'=>$request->code
                ]);
                return redirect('currencyCode/list');
            }
        }else{
            abort(403,'Unauthorized Request');
        }
    }
    //Edit View
    public function edit(Request $request){
        $currencyCode=CurrencyCode::find($request->id);
        $data['currencyCode']=$currencyCode;
        return view('currencyCodes.update',$data);
    }
    //Update Currency Code
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            'cid'=>"required",
            'eid'=>'required',
            'code'=>'required'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('currencyCode/list/edit')
                    ->withInput()
                    ->withErrors($validator);
            }else {
                $currencyCode=CurrencyCode::find($request->id);
                $currencyCode->cid=$request->cid;
                $currencyCode->eid=$request->eid;
                $currencyCode->code=$request->code;
                $currencyCode->save();

                return redirect('currencyCode/list');
            }
        }else{
            abort(403,'Unauthorized Request');
        }
    }
    //delete Currency Code
    public function destory(Request $request){
        $currencyCode=CurrencyCode::find($request->id);
        $currencyCode->delete();
        return redirect('currencyCode/list');
    }

    public function loadCurrency(Request $request){
        $currencies=DB::table('currencies')->select('id','name')->get();
        return $currencies;
    }

    public function loadExchanges(Request $request){
        $exchanges=DB::table('exchanges')->select('id','name')->get();
        return $exchanges;
    }
}
