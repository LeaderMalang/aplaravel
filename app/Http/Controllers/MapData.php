<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Currency;
use App\CurrencyDetail;
ini_set('max_execution_time', 300);

class MapData extends Controller
{
    public  $j=0;
    public function currencies(Request $request){


        Excel::load(public_path().'/output.csv')->each(function (Collection $csvLine) {

            $tags=explode(',',$csvLine->get('tags'));
            if($csvLine->get('circulating_supply')>0) {
                $circulating_supply=str_replace(',','',$csvLine->get('circulating_supply'));
            } else {
                $circulating_supply=0;
            }
            if($csvLine->get('max_supply')>0) {
                $max_supply=str_replace(',','',$csvLine->get('max_supply'));
            }else{
                $max_supply=0;
            }

            if($csvLine->get('total_supply')>0) {
                $total_supply=str_replace(',','',$csvLine->get('total_supply'));
            } else{
                $total_supply=0;
            }
            $name=$csvLine->get('name');
            $slug=$csvLine->get('slug');
            $symbol=$csvLine->get('symbol');
            $rank=$csvLine->get('rank');


            $imageName=explode('/',$csvLine->get('image_paths'));
            if(in_array('Coin',$tags)){
                if(in_array('Mineable',$tags)){
                    $currency=Currency::create([
                        "name"=>$name,
                        "slug"=>$slug,
                        "currency_type"=>'Coin',
                        "symbol"=>$symbol,
                        "logo"=>$imageName[1],
                        "circulating_supply"=>$circulating_supply,
                        "max_supply"=>$max_supply,
                        "total_supply"=>$total_supply,
                        "mineable"=>'1',
                        "ranking"=>$rank,
                        "status"=>'1',


                    ]);
                }else{
                    $currency=Currency::create([
                        "name"=>$name,
                        "slug"=>$slug,
                        "currency_type"=>'Coin',
                        "symbol"=>$symbol,
                        "logo"=>$imageName[1],
                        "circulating_supply"=>$circulating_supply,
                        "max_supply"=>$max_supply,
                        "total_supply"=>$total_supply,
                        "mineable"=>'0',
                        "ranking"=>$rank,
                        "status"=>'1',


                    ]);
                }


            }elseif (in_array('Token',$tags)){
                if(in_array('Mineable',$tags)){
                    $currency=Currency::create([
                        "name"=>$name,
                        "slug"=>$slug,
                        "currency_type"=>'Token',
                        "symbol"=>$symbol,
                        "logo"=>$imageName[1],
                        "circulating_supply"=>$circulating_supply,
                        "max_supply"=>$max_supply,
                        "total_supply"=>$total_supply,
                        "mineable"=>'1',
                        "ranking"=>$rank,
                        "status"=>'1',


                    ]);
                }else{
                    $currency=Currency::create([
                        "name"=>$name,
                        "slug"=>$slug,
                        "currency_type"=>'Token',
                        "symbol"=>$symbol,
                        "logo"=>$imageName[1],
                        "circulating_supply"=>$circulating_supply,
                        "max_supply"=>$max_supply,
                        "total_supply"=>$total_supply,
                        "mineable"=>'0',
                        "ranking"=>$rank,
                        "status"=>'1',


                    ]);
                }
            }
            if(isset($currency->id)&&$currency->id>0){
                if(!empty($csvLine->get('website'))){
                    $website=explode(',',$csvLine->get('website'));
                }else{
                    $website=[];
                }
                if(!empty($csvLine->get('message_board'))){
                    $message_board=explode(',',$csvLine->get('message_board'));
                }else{
                    $message_board=[];
                }
                if(!empty($csvLine->get('source_cdoe'))){
                    $source_code=explode(',',$csvLine->get('source_cdoe'));
                }else{
                    $source_code=[];
                }
                if(!empty($csvLine->get('tech_doc'))){
                    $tech_doc=explode(',',$csvLine->get('tech_doc'));
                }else{
                    $tech_doc=[];
                }
                if(!empty($csvLine->get('explorer'))){
                    $explorer=explode(',',$csvLine->get('explorer'));
                }else{
                    $explorer=[];
                }
                if(!empty($csvLine->get('announcement'))){
                    $announcement=explode(',',$csvLine->get('announcement'));
                } else{
                    $announcement=[];
                }
                if(!empty($csvLine->get('chat'))){
                    $chat=explode(',',$csvLine->get('chat'));
                }else{
                    $chat=[];
                }

                if(count($website)>0){
                    foreach ($website as $web){
                        CurrencyDetail::create([
                            'cid'=>$currency->id,
                            'type'=>'Website',
                            'url'=>$web,
                            'text'=>''
                    ]);
                    }

                }
                if(count($message_board)>0){
                    foreach ($message_board as $msg){
                        CurrencyDetail::create([
                            'cid'=>$currency->id,
                            'type'=>'Message Board',
                            'url'=>$msg,
                            'text'=>''
                        ]);
                    }
                }
                if(count($source_code)>0){
                    foreach ($source_code as $src){
                        CurrencyDetail::create([
                            'cid'=>$currency->id,
                            'type'=>'Source Code',
                            'url'=>$src,
                            'text'=>''
                        ]);
                    }
                }
                if(count($tech_doc)>0){
                    foreach ($tech_doc as $tchdoc){
                        CurrencyDetail::create([
                            'cid'=>$currency->id,
                            'type'=>'Technical Documentation',
                            'url'=>$tchdoc,
                            'text'=>''
                        ]);
                    }
                }
                if(count($explorer)>0){
                    foreach ($explorer as $exp){
                        CurrencyDetail::create([
                            'cid'=>$currency->id,
                            'type'=>'Explorer',
                            'url'=>$exp,
                            'text'=>''
                        ]);
                    }
                }
                if(count($announcement)>0){
                    foreach ($announcement as $announce){
                        CurrencyDetail::create([
                            'cid'=>$currency->id,
                            'type'=>'Announcement',
                            'url'=>$announce,
                            'text'=>''
                        ]);
                    }
                }
                if(count($chat)>0){
                    foreach ($chat as $ch){
                        CurrencyDetail::create([
                            'cid'=>$currency->id,
                            'type'=>'Chat',
                            'url'=>$ch,
                            'text'=>''
                        ]);
                    }
                }
                if(count($tags)>0){
                    foreach ($tags as $tag){
                        CurrencyDetail::create([
                            'cid'=>$currency->id,
                            'type'=>'Tags',
                            'url'=>'',
                            'text'=>$tag
                        ]);
                    }
                }

            }



            $this->j++;

        });
        echo $this->j;
    }
    public function test(Request $request){
        $str="17,375,325";
        $newstr=str_replace(',','',$str);

        print_r($newstr);
    }
}
