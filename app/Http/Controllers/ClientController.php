<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title as Title;
use App\Client as Client;

class ClientController extends Controller
{
    //
    public function __construct( Title $titles , Client $client)
    {
        $this->titles = $titles->all();
        $this->client = $client;
    }

    public function di()
    {
        dd($this->titles);
    }

    public function index()
    {
        $data=[];
        $data['clients']=$this->client->all();
        return view('client/index', $data);
    }

    public function newClient(Request $request, Client $client)
    {
        $data = [];

        $data ['title']= $request->input('title');
        $data ['name']= $request->input('name');
        $data ['last_Name']= $request->input('last_Name');
        $data ['zip_Code']= $request->input('zip_Code');
        $data ['address']= $request->input('address');
        $data ['city']= $request->input('city');
        $data ['state']= $request->input('state');
        $data ['email']= $request->input('email');
   

        if($request->isMethod('post'))
        {
            $this->validate(
                $request,
                [
                    'name'=>'required',
                    'last_Name'=>'required',
                    'zip_Code'=>'required',
                    'address'=>'required',
                    'city'=>'required',
                    'state'=>'required',
                    'email'=>'required',
                ]
            );

            $client->insert($data);

            return redirect('clients');
        }

        $data['titles'] = $this->titles;
        $data['modify'] = 0;

        return view('client/form', $data);
    }

    public function create()
    {
            return view('client/create');
    }

    public function show($client_id)
    {
        $data = [];
        $data['client_id']=$client_id;
        $data['titles'] = $this->titles;
        $data['modify'] = 1;
        $client_data= $this->client->find($client_id);
        $data['name']=$client_data->name;
        $data['last_name']=$client_data->last_name;
        $data['title']=$client_data->title;
        $data['address']=$client_data->address;
        $data['city']=$client_data->city;
        $data['state']=$client_data->state;
        $data['zip_code']=$client_data->zip_code;
        $data['email']=$client_data->email;
        return view('client/form', $data);
    }

    public function modify(Request $request, $client_id, Client $client)
    {
        $data = [];

        $data ['title']= $request->input('title');
        $data ['name']= $request->input('name');
        $data ['last_Name']= $request->input('last_Name');
        $data ['zip_Code']= $request->input('zip_Code');
        $data ['address']= $request->input('address');
        $data ['city']= $request->input('city');
        $data ['state']= $request->input('state');
        $data ['email']= $request->input('email');
   

        if($request->isMethod('post'))
        {
            $this->validate(
                $request,
                [
                    'name'=>'required',
                    'last_Name'=>'required',
                    'zip_Code'=>'required',
                    'address'=>'required',
                    'city'=>'required',
                    'state'=>'required',
                    'email'=>'required',
                ]
            );

            $client_data=$this->client->find($client_id);

             $client_data->title= $request->input('title');
             $client_data->name= $request->input('name');
             $client_data->last_Name= $request->input('last_Name');
             $client_data->zip_Code= $request->input('zip_Code');
             $client_data->address= $request->input('address');
             $client_data->city= $request->input('city');
             $client_data->state= $request->input('state');
             $client_data->email= $request->input('email');

            $client_data->save();
             return redirect('clients');
        }

        return view('client/form', $data);
    }
}
