<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Helpers\formatAPI;
use Exception;

class siswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Siswa::all();

        if($data){
            return formatAPI::createAPI(200,'Success',$data);
        }else{
            return formatAPI::createAPI(400,'Failed');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
        // Get the latest ID from the database
        // $latestSiswa = Siswa::latest('id_siswa')->first();
        // $id = ($latestSiswa) ? $latestSiswa->id_siswa + 1 : 1;

            $siswa = Siswa::create([
                'nis' => $request->nis,
                'nama' => $request->nama,
                'rombel' => $request->rombel
            ]);

            //get data siswa where id_siswa = id_siswa
            $data = Siswa::where('id','=',$siswa->id)->get();  

            //check data is valid? return data : failed
            if($data){
                return formatAPI::createAPI(200,'Success',$data);
            }else{
                return formatAPI::createAPI(400,'Failed');
            }

        }catch(Exception $error){
            return formatAPI::createAPI(400,'Failed',$error);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $data = Siswa::where('id', '=', $id)->first();

            if($data){
                return formatAPI::createAPI(200,'success', $data);
            }else{
                return formatAPI::createAPI(400,'failed');
            }
        }catch(Exception $error){
            return formatAPI::createAPI(400,'failed', $error->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->update($request->all());

            $data = Siswa::where('id', '=', $siswa->id)->first();
    
            if ($data) {
                return formatAPI::createAPI(200, 'Success', $data);
            } else {
                return formatAPI::createAPI(400, 'Failed');
            }
        } catch (Exception $error) {
            return formatAPI::createAPI(400, 'Failed', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $siswa = Siswa::findorfail($id);
            $data = $siswa->delete();
            if($data){
                return formatAPI::createAPI(200,'Success',$data);
            }else{
                return formatAPI::createAPI(400,'Failed');
            }
        }catch(Exception $error){
            return formatAPI::createAPI(400,'Failed',$error->getMessage());
        }
    }
}
