<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skp;
use DB;
use Illuminate\Http\Request;

class UpdateStatusRatingSkpController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
        $resp = [
            'status' => true,
            'id' => $request->skp,
            'status' => $request->rating_status,
        ];

        DB::table('skp')->where('id', '=', $request->skp)->update(['rating_status' => $request->rating_status]);
        //        $skp->rating_status = $request->rating_status;
        // $skp->save();
    }
}
