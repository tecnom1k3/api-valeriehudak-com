<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormRequestModel;
use Acme\Service\FormHandler;
use Acme\Dto\FormProcessRequest;

class FormController extends Controller
{
    /**
     * @var FormHandler
     */
    protected $formHandlerService;

    public function __construct(FormHandler $formHandler)
    {
        $this->formHandlerService = $formHandler;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\FormRequestModel  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormRequestModel $request)
    {
        return response()->json([
            'success' => $this->formHandlerService->processForm($this->marshalFormRequest($request)),
        ])->withCallback($request->input('callback'));

    }

    protected function marshalFormRequest(FormRequestModel $requestModel): FormProcessRequest
    {
        /** @var FormProcessRequest $formProcessRequest */
        $formProcessRequest = App()->make(FormProcessRequest::class);
        $formProcessRequest->setName($requestModel->get('name'))
            ->setEmail($requestModel->get('email'))
            ->setComments($requestModel->get('comments'));

        return $formProcessRequest;
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
