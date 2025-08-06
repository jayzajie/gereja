<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SejarahGereja;
use App\Models\SejarahJemaat;

class SejarahController extends Controller
{
    /**
     * Display the church history page
     */
    public function gereja()
    {
        // Get active sejarah gereja data
        $sejarahGereja = SejarahGereja::where('is_active', true)->first();

        return view('sejarah.gereja', compact('sejarahGereja'));
    }

    /**
     * Display the congregation history page
     */
    public function jemaat()
    {
        // Get active sejarah jemaat data
        $sejarahJemaat = SejarahJemaat::where('is_active', true)->first();

        return view('sejarah.jemaat', compact('sejarahJemaat'));
    }


}
