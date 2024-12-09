<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Bus;
use App\Models\Route;

class DashboardComponent extends Component
{
    public $totalUsers;
    public $totalTickets;
    public $totalBuses;
    public $totalRoutes;

    public function mount()
    {
        $this->totalUsers = User::count();
        $this->totalTickets = Ticket::count();
        $this->totalBuses = Bus::count();
        $this->totalRoutes = Route::count();
    }

    public function render()
    {
        return view('livewire.dashboard-component');
    }
}
