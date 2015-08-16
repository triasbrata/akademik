<?php

namespace Akademik\Http\Controllers\Pegawai\StaffTu\kepegawaian;

use Illuminate\Http\Request;

use Akademik\Http\Requests\PegawaiPekerjaanRequest;
use Akademik\Http\Controllers\Controller;
use Akademik\PegawaiPekerjaan;

class PekerjaanController extends Controller
{
     public function __construct()
    {
        parent::__construct('stafftu.kepegawaian.pekerjaan', new PegawaiPekerjaan(), 'Pekerjaan');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PegawaiPekerjaan $model,PegawaiPekerjaanRequest $r)
    {
        if ($model->fill($r->all())->save()) {
            return $this->routeAndSuccess('store');
        }
        return $this->routebackWithError('store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
   
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(PegawaiPekerjaan $model,PegawaiPekerjaanRequest $r)
    {
        if ($model->fill($r->all())->save()) {
            return $this->routeAndSuccess('update');
        }
        return $this->routebackWithError('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(PegawaiPekerjaan $model)
    {
        if ($model->delete()) {
            return $this->routeAndSuccess('delete');
        }
         return $this->routebackWithError('delete');
    }
}
