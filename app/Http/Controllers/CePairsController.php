<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CePair;
use Illuminate\Support\Facades\DB;
use Validator;


class CePairsController extends Controller
{
    //List View Of Currency Exchange Pairs
    public function index(Request $request){

        $pairs=DB::select("SELECT ce_pairs.id,ce_pairs.status,ce1.name as BaseCurrency,ce2.name as AssetCurrency,ex.name as Exchange,cce1.code as BaseCurrencyCode,cce2.code as AssetCurrencyCode FROM `ce_pairs` JOIN `currencies` as ce1 ON ce1.id=ce_pairs.c1 JOIN `currencies` as ce2 ON ce2.id=ce_pairs.c2 JOIN `exchanges` as ex ON ex.id=ce_pairs.eid JOIN `currency_codes` as cce1 ON cce1.id=ce_pairs.cc1 JOIN `currency_codes` as cce2 ON cce2.id=ce_pairs.cc2");
        $data['pairs']=$pairs;
        return view('pairs.index',$data);
    }
    //Create View
    public function create(Request $request){
        return view('pairs.create');
    }
    //Store new Pairs
    public function store(Request $request){
        //return $request->all();
        $validator=Validator::make($request->all(),[
            'c1'=>'required',
            'c2'=>'required',
            'eid'=>'required',
            'cc1'=>'required',
            'cc2'=>'required',
            'status'=>'required'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('cepairs/list/create')
                    ->withErrors($validator)
                    ->withInput();
            }else{
                $pair=CePair::create([
                    'c1'=>$request->c1,
                    'c2'=>$request->c2,
                    'eid'=>$request->eid,
                    'cc1'=>$request->cc1,
                    'cc2'=>$request->cc2,
                    'status'=>$request->status
                ]);
                return redirect('cepairs/list');
            }

        }else{
            abort(403, 'Unauthorized action.');
        }
    }
    //Edit View
    public function edit(Request $request){

        $pair=CePair::find($request->id);
        $data['pair']=$pair;
        return view('pairs.update',$data);
    }
    //Update Pairs
    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            'c1'=>'required',
            'c2'=>'required',
            'eid'=>'required',
            'cc1'=>'required',
            'cc2'=>'required',
            'status'=>'required'
        ]);
        if($request->isMethod('post')) {
            if ($validator->fails()) {
                return redirect('cepairs/list/update')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $pair=CePair::find($request->id);
                $pair->c1=$request->c1;
                $pair->c2=$request->c2;
                $pair->eid=$request->eid;
                $pair->cc1=$request->cc1;
                $pair->cc2=$request->cc2;
                $pair->status=$request->status;
                $pair->save();
                return redirect('cepairs/list');
            }
        }else{
            abort(403, 'Unauthorized action.');
        }
    }
    //Delete Pairs
    public function destory(Request $request){
        //return "delete";
        $pair=CePair::find($request->id);
        $pair->delete();
        return redirect('cepairs/list');

    }
    //Change Status of Pair
    public function changeStatus(Request $request){
        $pair=CePair::find($request->id);
        if($pair->status==1){
            $pair->status=0;
        }else{
            $pair->status=1;
        }
        $pair->save();
        return "success";
    }
    //load Crpto Currency
    public function loadCurrency(Request $request){
        $currencies=DB::table('currencies')->select('id','name')->get();
        return $currencies;
    }
    public function loadExchanges(Request $request){
        $exchanges=DB::table('exchanges')->select('id','name')->get();
        return $exchanges;
    }
    public function loadCurrencyCode(Request $request){
        $cid=$request->cid;
        $eid=$request->eid;
        $code=DB::table('currency_codes')->where('cid','=',$cid)->where('eid','=',$eid)->select('id','code')->get();
        return $code;
    }
}
