<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TermOfPayment;
use App\Traits\ControllersTrait;
use App\User;
use Bouncer;
use Notification;
use App\Traits\TermOfPaymentsTrait;
use Storage;
use App\ERFP;

class TermOfPaymentController extends Controller
{
    use ControllersTrait, TermOfPaymentsTrait;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    public function process(Request $request, $id){

    }

    public function cashRelease(Request $request, $id){
        $term_of_payment = TermOfPayment::findOrFail($id);
        $term_of_payment->update([
            'ref_no' => $request->ref_no
        ]);
        
        if($request->file){
           $term_of_payment->update([
               'file_name' => $this->storeFile($request)
           ]);
        }

        $this->updateItem($term_of_payment, TermOfPayment::class, "ERFP", $request, true);
        
        // Please check for TermOfPaymentObserver for Events
 
        return [
            'item_id' => $term_of_payment->erfp->id,
            'success_text' => $term_of_payment->erfp->code . " " . $term_of_payment->payment ." has been successfully updated."
        ];
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

    public function downloadPayment(Request $request){
        return Storage::download("term_of_payments/".$request->path, "Test Name");
    }
}
