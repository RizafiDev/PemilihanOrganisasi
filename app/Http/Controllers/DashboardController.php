<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Kandidat;
use App\Models\Vote;
use Illuminate\Http\Request;
use App\Models\KandidatFirebase;
use App\Models\VoteFirebase;

class DashboardController extends Controller
{
    protected $kandidatModel;
    protected $voteModel;

    public function __construct()
    {
        $this->kandidatModel = new KandidatFirebase();
        $this->voteModel = new VoteFirebase();
    }

    public function index()
    {
        $totalKandidat = $this->kandidatModel->count();
        $totalSuara = $this->voteModel->count();
        $kandidats = $this->kandidatModel->all();

        return view('dashboard.index', compact('totalKandidat', 'totalSuara', 'kandidats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
