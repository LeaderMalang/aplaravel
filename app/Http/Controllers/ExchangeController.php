<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exchange;
use Validator;

class ExchangeController extends Controller
{
    //list View of Exchanges
    public function index(Request $request){

        $exchanges=Exchange::all();
        $data['exchanges']=$exchanges;
        //return $data;
        return view("exchanges.index",$data);

    }
    //load create view of Exchange
    public function create(Request $request){
        return view('exchanges.create');

    }
    //Store new Exchange
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required',
            'url'=>'required',
            'fetch_url'=>'required',
            'has_fee'=>'nullable',
            'fee'=>'nullable',
            'status'=>'required',
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('exchanges/create')
                    ->withErrors($validator)
                    ->withInput();
            }else{
                $fee=(empty($request->fee))?0.0:$request->fee;
                $has_fee=(empty($request->has_fee))?0:$request->has_fee;
                $exchanges=Exchange::create([
                    'name'=>$request->name,
                    'status'=>$request->status,
                    'slug'=>$request->slug,
                    'url'=>$request->url,
                    'fetch_url'=>$request->fetch_url,
                    'has_fee'=>$has_fee,
                    'fee'=>$fee
                ]);
                return redirect('exchanges/list');
            }

        }else {
            abort(403, 'Unauthorized action.');
        }
    }
    //load edit View
    public function edit(Request $request){
        $exchange=Exchange::find($request->id);
        $data['exchange']=$exchange;
        return view("exchanges.update",$data);
    }
    //Update existing exchange
    public function update(Request $request){
        //return "update";
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required',
            'url'=>'required',
            'fetch_url'=>'required',
            'has_fee'=>'nullable',
            'fee'=>'nullable',
            'status'=>'required',
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('exchanges/list/edit')
                    ->withErrors($validator)
                    ->withInput();
            }else{
                $fee=(empty($request->fee))?0.0:$request->fee;
                $has_fee=(empty($request->has_fee))?0:$request->has_fee;
                $exchange=Exchange::find($request->id);
                $exchange->name=$request->name;
                $exchange->slug=$request->slug;
                $exchange->url=$request->url;
                $exchange->fetch_url=$request->fetch_url;
                $exchange->has_fee=$has_fee;
                $exchange->fee=$fee;
                $exchange->status=$request->status;
                $exchange->save();
                return redirect('exchanges/list');

            }

        }else{
            abort(403, 'Unauthorized action.');
        }

    }
    //Delete Exchange
    public function destory(Request $request){
        $exchange=Exchange::find($request->id);
        $exchange->delete();
        return redirect('exchanges/list');
    }
}
