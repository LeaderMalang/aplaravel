<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;


class AutoSeedCreator extends Controller
{
    /*
    It loads create of Iseeder with table names and DB name
    */
    public function create(){
        $data=$this->dbtables();
        return view('iseeder.create',$data);
    }
    /*
    Return Database name and table names

    */
    protected function dbtables(){
        $data=[];
        $dbase=DB::getDatabaseName();
        $tableName="Tables_in_".$dbase;
        $tables = DB::select('SHOW TABLES');
        $tableNames=[];
        foreach($tables as $table)
        {
            array_push($tableNames,$table->$tableName);

        }

        $data['dbName']=$tableName;
        $data['tableNames']=$tableNames;
        return $data;
    }
    /*
    Arguments:- Request
    Receive Table names and it store their seeders
    Return response with success or failure of table seeds

    */
    public function store(Request $request){
        $res=[];
        $tables=$request->table;
        $validator=Validator::make($request->all(),[
           'table'=>'required'
        ]);
        if($request->isMethod('post')){
            if($validator->fails()){
                $data=$this->dbtables();
               return redirect('seeder/create')->with($data)->withErrors($validator)->withInput();
            }else {
                foreach ($tables as $table){
                    if(\Iseed::generateSeed($table)){
                        $mtable['success']=$table;
                        array_push($res,$mtable);
                    }else{
                        $mtable['fail']=$table;
                        array_push($res,$mtable);

                    }


                }
                $data=$this->dbtables();
                $data['result']=$res;
                //return $data['result'];
                return  redirect('seeder/create')->with('data',$data);
            }
        } else {
            abort(404,'Unauthorize request');
        }



    }


}
