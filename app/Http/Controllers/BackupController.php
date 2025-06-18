<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function run()
    {

        Artisan::call('backup:run');
        //$output = Artisan::output();

        return redirect()->back()->with([
            'status' => now()->format('d M Y - H:i'),
            //'output' => $output,
        ]);
    }
}
