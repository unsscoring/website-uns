<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(){
        if(auth()->user()->hasRole('manajer')) {
            return redirect('/manajer/dashboard');
        } elseif(auth()->user()->hasRole('admin')){
            return redirect('/admin/dashboard');
        } elseif(auth()->user()->hasRole('superadmin')){
            return redirect('/superadmin/dashboard');
        } 
    }
}
