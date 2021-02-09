<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $active;
    public function __construct($active)
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.menu' , ['active' => $this->active]);
    }
    public function list(){
        return[
            [
                'label'=> 'Dashboard',
                'route' => 'dashboard',
                'icon' => 'fa fa-tachometer-alt'
            ],
            [
                'label'=> 'Movies',
                'route' => 'dashboard.movies',
                'icon' => 'fa fa-video'
            ],
            [
                'label'=> 'Theaters',
                'route' => 'dashboard.theaters',
                'icon' => 'fa fa-university'
            ],
            [
                'label'=> 'Tickets',
                'route' => 'dashboard.tickets',
                'icon' => 'fa fa-ticket-alt'
            ],
            [
                'label'=> 'Users',
                'route' => 'dashboard.users',
                'icon' => 'fa fa-users'
            ]
        ];
    }

    public function isActive($label){
        if ($label === $this->active){
            return 'active';
        }
    }
}
