<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;


use App\Models\SubBab;
use App\Models\Bab;

class SubBabController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SubBab::all();
        foreach ($data as $key => $v) {
            $bab_id = $v->bab_id;
            $data[$key]['nama_bab'] = Bab::where('id', $bab_id)->first()['nama_bab'];
        }
        return $this->sendResponse(true, $data);
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
        $hasOnly = $request->has(['bab_id', 'nama_subbab', 'isi_subbab']);

        if ($hasOnly) {
            $data = [
                'bab_id' => $request->bab_id,
                'nama_subbab' => $request->nama_subbab,
                'isi_subbab' => $request->isi_subbab,
            ];

            SubBab::create($data);

            return $this->sendResponse(true, $data);
        } else {
            return $this->wasWrong();
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
        $data = SubBab::where('id', $id)->first();
        if (empty($data)) return $this->isEmpty();
        $bab_id = $data->bab_id;
        $data['nama_bab'] = Bab::where('id', $bab_id)->first()['nama_bab'];


        return $this->sendResponse(true, $data);
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
        $check = SubBab::where('id', $id)->first();
        $hasAny = $request->hasAny(['bab_id', 'nama_subbab', 'isi_subbab']);

        if (!empty($check) && $hasAny) {
            $data = [
                'bab_id' => $request->bab_id ?: $check->bab_id,
                'nama_subbab' => $request->nama_subbab ?: $check->nama_subbab,
                'isi_subbab' => $request->isi_subbab ?: $check->isi_subbab
             ];

            SubBab::where('id', $id)->update($data);

            return $this->sendResponse(true, $data);
        } else {
            return $this->wasWrong();
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
        SubBab::where('id', $id)->delete();
        return response()->json(['message' => 'data has been deleted.']);
    }
}
