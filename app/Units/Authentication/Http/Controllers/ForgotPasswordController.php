<?php

namespace MVG\Units\Authentication\Http\Controllers;

use MVG\Support\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

/**
 * Class ForgotPasswordController
 * @package MVG\Units\Authentication\Http\Controllers
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }
}
