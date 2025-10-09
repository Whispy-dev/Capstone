<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;

class NotificationController extends Controller
{
    public function notifyUser(FirebaseService $firebase)
    {
        $firebase->sendNotification(
            $deviceToken,
            'Incidencia asignada',
            'Tienes una nueva incidencia en tu comuna',
            ['id_incidencia' => '123']
        );
    }
}