<?php



namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequestRequest;

use App\Services\DashboardService;

class DashboardViewController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $stats = $this->dashboardService->getDashboardStats();

        return view('dashboard', compact('stats'));
    }
}


// <!-- resources/views/dashboard.blade.php -->

// @extends('layouts.app')

// @section('content')
//     <div class="container">
//         <h1>Tableau de Bord</h1>

//         <div class="row">
//             <div class="col-md-3">
//                 <div class="card">
//                     <div class="card-body">
//                         <h3>{{ $stats['nombre_equipes'] }}</h3>
//                         <p>Nombre d'équipes</p>
//                     </div>
//                 </div>
//             </div>
//             <div class="col-md-3">
//                 <div class="card">
//                     <div class="card-body">
//                         <h3>{{ $stats['nombre_matchs'] }}</h3>
//                         <p>Nombre de matchs</p>
//                     </div>
//                 </div>
//             </div>
//             <div class="col-md-3">
//                 <div class="card">
//                     <div class="card-body">
//                         <h3>{{ $stats['nombre_competitions'] }}</h3>
//                         <p>Nombre de compétitions</p>
//                     </div>
//                 </div>
//             </div>
//             <div class="col-md-3">
//                 <div class="card">
//                     <div class="card-body">
//                         <h3>{{ $stats['nombre_calendriers'] }}</h3>
//                         <p>Nombre de calendriers</p>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     </div>
// @endsection
