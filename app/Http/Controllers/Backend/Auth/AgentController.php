<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    //
    public function __construct() {

    }
    public function index() {
        return view('backend.agent.agent_dashboard');
    }
}