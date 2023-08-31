<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [update] process for the listmessage
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\listmessage;
use Illuminate\Contracts\Support\Responsable;

class StoreResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for listmessage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //prepend content on top of list or show full table
        if ($count == 1) {
            $html = view('pages/listmessage/components/table/table', compact('listmessage'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => '#listmessage-table-wrapper',
                'action' => 'replace',
                'value' => $html);
        } else {
            //prepend content on top of list
            $html = view('pages/listmessage/components/table/ajax', compact('listmessage'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => '#listmessage-td-container',
                'action' => 'prepend',
                'value' => $html);
        }

        //close modal
        $jsondata['dom_visibility'][] = array('selector' => '#commonModal', 'action' => 'close-modal');

        //notice
        $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

        //response
        return response()->json($jsondata);

    }

}
