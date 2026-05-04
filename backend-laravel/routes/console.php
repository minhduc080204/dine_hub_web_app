<?php

use Illuminate\Support\Facades\Schedule;


Schedule::command('app:call-train-data')
    ->weekly();