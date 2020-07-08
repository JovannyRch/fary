<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class PagesAdmin extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $data = [];
        $data['users'] = DB::table('users')->count();
        $data['negocios'] = DB::table('negocios')->count();
        $data['tipos'] = DB::table('tipos')->count();
        $data['posts'] = DB::table('posts')->count();
        $data['cars'] = DB::table('cars')->count();
        $data['ads'] = DB::table('ads')->count();
        return view('components.pages-admin',$data);
    }
}
