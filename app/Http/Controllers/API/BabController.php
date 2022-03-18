<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

use App\Models\Bab;
use App\Models\Eskul;

class BabController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Bab::all();
        foreach ($data as $key => $v) {
            $eskul_id = $v->eskul_id;
            $data[$key]['nama_eskul'] = Eskul::where('id', $eskul_id)->first()['nama_eskul'];
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
        $hasOnly = $request->has(['eskul_id', 'nama_bab']);

        if ($hasOnly) {
            $data = [
                'eskul_id' => $request->eskul_id,
                'nama_bab' => $request->nama_bab,
            ];

            Bab::create($data);

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
        $data = Bab::where('id', $id)->first();
        if (empty($data)) return $this->isEmpty();
        $eskul_id = $data->eskul_id;
        $data['nama_eskul'] = Eskul::where('id', $eskul_id)->first()['nama_eskul'];


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
        $check = Bab::where('id', $id)->first();
        $hasAny = $request->hasAny(['eskul_id', 'nama_bab']);

        if (!empty($check) && $hasAny) {
            $data = [
                'eskul_id' => $request->eskul_id ?: $check->eskul_id,
                'nama_bab' => $request->nama_bab ?: $check->nama_bab
            ];

            Bab::where('id', $id)->update($data);

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
        Bab::where('id', $id)->delete();
        return response()->json(['message' => 'data has been deleted.']);
    }
}
