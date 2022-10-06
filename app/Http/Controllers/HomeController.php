<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {

        if(!auth()->guest()){

            if(auth()->user()->role == 'admin'){
                return redirect('admin/products');
            }
        }

        return redirect('products');;


    }
}
