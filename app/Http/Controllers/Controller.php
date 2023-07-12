<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="Api serviconsa",
 *    version="1.0.0",
 *    description="<b>Estados:</b> (Enviada, Recibida, Procesando, Finalizada, Rechazada)",
 * ) 
 * 
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Login with email and password to get the authentication token",
 *     name="Token based Based",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="apiAuth",
 * )
 * 
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
