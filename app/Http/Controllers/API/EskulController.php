<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

use App\Models\Eskul;
use App\Models\Bab;

class EskulController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Eskul::all();
        if (empty($data)) return $this->isEmpty();

        foreach ($data as $key => $v) { 
            $eskul_id = $v->id;

            $data[$key]['bab'] = $v->babs()->get();
            $data[$key]['anggota'] = $v->anggotas()->get();

            foreach($data[$key]['bab'] as $key_ => $x) {
                $bab_id = $x->id;
                $data[$key]['bab'][$key_]['subbab'] = Bab::where('id', $bab_id)->first()->subbabs()->get();
            }
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
        $hasAny = $request->hasAny(['nama_eskul', 'deskrispi']);

        if ($hasAny) {
            $data = [
                'nama_eskul' => $request->nama_eskul,
                'deskrispi' => $request->deskrispi
            ];

            Eskul::create($data);

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
        $data = Eskul::where('id', $id)->first();
        if (empty($data)) return $this->isEmpty();

        $data['bab'] = $data->babs()->get();
        $data['anggota'] = $data->anggotas()->get();

        foreach($data['bab'] as $key => $v) {
            $bab_id = $v->id;
            $data['bab'][$key]['subbab'] = Bab::where('id', $bab_id)->first()->subbabs()->get();
        }
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
        $check = Eskul::where('id', $id)->first();
        $hasAny = $request->hasAny(['nama_eskul', 'deskrispi']);

        if (!empty($check) && $hasAny) {
            $data = [
                'nama_eskul' => $request->nama_eskul ?: $check->nama_eskul,
                'deskrispi' => $request->deskrispi ?: $check->deskrispi
            ];

            Eskul::where('id', $id)->update($data);

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
        Eskul::where('id', $id)->delete();
        return response()->json(['message' => 'data has been deleted.']);
    }
}
