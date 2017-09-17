<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Acme\Service\Jwt;

class CsrfController extends Controller
{
    /**
     * @var Jwt
     */
    protected $jwtService;

    /**
     * CsrfController constructor.
     * @param Jwt $jwtService
     */
    public function __construct(Jwt $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return $this
     */
    public function index(Request $request)
    {
        return response()->json([
            'csrf' => $this->jwtService->get(),
        ])->withCallback($request->input('callback'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
