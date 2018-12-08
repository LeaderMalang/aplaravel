<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use App\CurrencyDetail;
use Mockery\Exception;
use Validator;
use Illuminate\Support\Facades\DB;

class CryptoCurrencyController extends Controller
{
    //load list of crypto currencies
    public function index(){
        $currencies=Currency::where("currency_type","=","Coin")->orWhere("currency_type","=","Token")->orderBy('id',"DSC")->get();
        $data['crypto_currencie']=$currencies;
        return view("currencies.crypto_currencies.index",$data);
    }
    //load create view of crypto currency
    public function create(Request $request){
        return view('currencies.crypto_currencies.create');
    }
    //store the Crypto Currency Main Data
    public function store(Request $request){
        //return $request->all();
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:3',
            'slug'=>'required',
            'symbol'=>'required',
            'currency_type'=>'required',
            'circulating_supply'=>'required',
            'max_supply'=>'required',
            'total_supply'=>'required',
            'ranking'=>'required',
            'mineable'=>'required',
            'status'=>'required',
            'cimage'=>'image|required|mimes:jpeg,png,jpg|dimensions:min_width=200,min_height=200|max:5000'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('currencies/crypto/create')
                    ->withErrors($validator)
                    ->withInput();
            }
            else{

                $imagePath=$request->file('cimage');
                $imageExtention= $imagePath->getClientOriginalExtension();
                $imageName=$request->slug.'.'.$imageExtention;
                if($request->hasFile('cimage')){
                    if($this->thumbnail($imagePath,$imageName)){
                        $currency=Currency::create([
                            'name'=>$request->name,
                            'slug'=>$request->slug,
                            'symbol'=>$request->symbol,
                            'logo'=>$imageName,
                            'currency_type'=>$request->currency_type,
                            'circulating_supply'=>$request->circulating_supply,
                            'max_supply'=>$request->max_supply,
                            'total_supply'=>$request->total_supply,
                            'ranking'=>$request->ranking,
                            'mineable'=>$request->mineable,
                            'status'=>$request->status
                        ]);
                        return $this->index();
                    }
                }


            }

        }else{
            abort(403, 'Unauthorized action.');
        }


    }
    //Thumbnail Creator which creates Two thumbnail 16X16 and 32X32
    public function thumbnail($imagePath,$imageName){

        \Image::configure(array('driver' => 'imagick'));

        $uploadPath16=public_path("/assets/images/16X16/".$imageName);
        $uploadPath32=public_path("/assets/images/32X32/".$imageName);


        try{
            $img16 = \Image::make($imagePath)->resize(16, 16)->save($uploadPath16);
            $img32 = \Image::make($imagePath)->resize(32, 32)->save($uploadPath32);
        }
        catch (Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return true;
    }
    //Delete's Crypto Currency
    public function destory(Request $request){
        $currency=Currency::find($request->cid);
        $uploadPath16=public_path("/assets/images/16X16/".$currency->logo);
        $uploadPath32=public_path("/assets/images/32X32/".$currency->logo);
        $this->deleteImage($uploadPath16);
        $this->deleteImage($uploadPath32);
        $currency->delete();
        return redirect('currencies/crypto');
    }
    //Load Edit View of Crypto Currency
    public function edit(Request $request){
        $currency=Currency::find($request->cid);
        $data['crypto_currency']=$currency;
        return view('currencies.crypto_currencies.update',$data);
    }
    //Update existing crypto currency

    public function update(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:3',
            'slug'=>'required',
            'symbol'=>'required',
            'currency_type'=>'required',
            'circulating_supply'=>'required',
            'max_supply'=>'required',
            'total_supply'=>'required',
            'ranking'=>'required',
            'mineable'=>'required',
            'status'=>'required',
            'cimage'=>'image|mimes:jpeg,png,jpg|dimensions:min_width=200,min_height=200|max:5000'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('currencies/crypto/update')
                    ->withErrors($validator)
                    ->withInput();
            }
            else{
                $currency=Currency::find($request->cid);
                if($request->hasFile('cimage')){
                    $imagePath=$request->file('cimage');
                    $imageExtention= $imagePath->getClientOriginalExtension();
                    $imageName=$request->slug.'.'.$imageExtention;
                    if($this->thumbnail($imagePath,$imageName)){
                        //Getting Images
                        $uploadPath16=public_path("/assets/images/16X16/".$currency->logo);
                        $uploadPath32=public_path("/assets/images/32X32/".$currency->logo);
                        //Deleting Images
                        $this->deleteImage($uploadPath16);
                        $this->deleteImage($uploadPath32);
                        //Updating Records

                        $currency->name=$request->name;
                        $currency->slug=$request->slug;
                        $currency->symbol=$request->symbol;
                        $currency->logo=$imageName;
                        $currency->currency_type=$request->currency_type;
                        $currency->circulating_supply=$request->circulating_supply;
                        $currency->max_supply=$request->max_supply;
                        $currency->total_supply=$request->total_supply;
                        $currency->ranking=$request->ranking;
                        $currency->mineable=$request->mineable;
                        $currency->status=$request->status;
                        $currency->save();
                        return redirect('currencies/crypto');
                    }

                }else{
                    $currency->name=$request->name;
                    $currency->slug=$request->slug;
                    $currency->symbol=$request->symbol;
                    $currency->currency_type=$request->currency_type;
                    $currency->circulating_supply=$request->circulating_supply;
                    $currency->max_supply=$request->max_supply;
                    $currency->total_supply=$request->total_supply;
                    $currency->ranking=$request->ranking;
                    $currency->mineable=$request->mineable;
                    $currency->status=$request->status;
                    $currency->save();
                    return redirect('currencies/crypto');
                }

            }
        }
        else{
            abort(403, 'Unauthorized action.');
        }

    }
    //Delete Image It receive image path with Image name and extension
    public function deleteImage($imagePath){

        try{
            $del=unlink($imagePath);
        }catch (Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $del;
    }
    public function currencyDetailList(Request $request){
        $currencyDetails = DB::table('currency_details')
            ->join('currencies', 'currency_details.cid', '=', 'currencies.id')
            ->select('currencies.name','currency_details.type','currency_details.url','currency_details.text','currency_details.id')
            ->get();

        $data['currencyDetails']=$currencyDetails;
        return view('currencies.crypto_currencies.currencyDetailList',$data);
    }
    public function editDetals(Request $request){
        $details=CurrencyDetail::find($request->id);
        $data['detail']=$details;
        return view('currencies.crypto_currencies.updateDetails',$data);
    }
    public function destoryDetals(Request $request){
        $detail=CurrencyDetail::find($request->id);
        $detail->delete();
        return redirect('currencies/cryptoDetail');
    }
    public  function createDetails(Request $request){
        return view('currencies.crypto_currencies.createDetail');
    }
    public function loadCurrency(Request $request){
        $currencies=DB::table('currencies')->where("currency_type","=","Coin")->orWhere("currency_type","=","Token")->select('id','name')->get();
        return $currencies;
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
    //Store Crypto Details
    public function storeDetails(Request $request){
        $validator=Validator::make($request->all(),[
            'currency_id'=>'required',
            'detail_type'=>'required',
            'else_url'=>'nullable',
            'tag_text'=>'nullable'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('currencies/cryptoDetail/createDetails')
                    ->withErrors($validator)
                    ->withInput();
            }else{
                $text=(empty($request->tag_text))?"":$request->tag_text;
                $url=(empty($request->else_url))?"":$request->else_url;
                $details=CurrencyDetail::create([
                    'cid'=>$request->currency_id,
                    'type'=>$request->detail_type,
                    'url'=>$url,
                    'text'=>$text
                ]);
                return redirect('currencies/cryptoDetail');
            }
        }else{
            abort(403, 'Unauthorized action.');
        }
    }
    //Update Crypto Details
    public function updateDetails(Request $request){
        //return $request->all();
        $validator=Validator::make($request->all(),[
            'currency_id'=>'required',
            'detail_type'=>'required',
            'else_url'=>'nullable',
            'tag_text'=>'nullable'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                return redirect('currencies/cryptoDetail/editDetals')
                    ->withErrors($validator)
                    ->withInput();
            }else{
                $text=(empty($request->tag_text))?"":$request->tag_text;
                $url=(empty($request->else_url))?"":$request->else_url;
                $detail=CurrencyDetail::find($request->id);
                $detail->cid=$request->currency_id;
                $detail->type=$request->detail_type;
                $detail->url=$url;
                $detail->text=$text;
                $detail->save();
                return redirect('currencies/cryptoDetail');

            }

        }else{
            abort(403, 'Unauthorized action.');
        }
    }



}
