<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bank;


class BankController extends Controller
{
    public function index()
    {
        $bank = Bank::first();
        return response()->json($bank, 200);
    }
}