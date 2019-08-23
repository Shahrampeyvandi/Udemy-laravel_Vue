<?php 

namespace Bahdcasts\Exceptions;

use Exception;

class AuthFailedException extends Exception 
{
    public function render() {
        return response()->json([
            'message' => 'اطلاعات وارد شده صحیح نمیباشد'
        ], 422);
    }
}