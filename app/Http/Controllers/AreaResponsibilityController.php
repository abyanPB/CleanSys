<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\AreaResponsibility;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AreaResponsibilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //Start Guest
        public function showAreaResponsibilitiesGuest()
            {
                $title = 'Daftar Penanggung Jawab Area Kerja';
                $cleaners = User::where('level', 'cleaner')->with('areaResponsibilities')->get();
                return view('guest.index', compact('cleaners', 'title'));
            }
    //End Guest

    //Start Admin
        //Menampilkan Penanggung Jawab Area Kerja
        public function showAreaResponsibilitiesAdmin()
        {
            $title = 'Daftar Penanggung Jawab Area Kerja';
            $cleanersArea = User::where('level', 'cleaner')->get();
            return view('admin.area_responsibilities.index', compact('cleanersArea', 'title'));
        }

        //Edit Penanggung Jawab Area Kerja
        public function editAreaResponsibilitiesAdmin(Request $request){
            $cleanersArea = User::findOrFail($request->id_users);
            $assignedAreas = AreaResponsibility::where('user_id', '!=', $request->id_users)->pluck('area_id')->toArray();
            $availableAreas = Area::whereNotIn('id_area', $assignedAreas)->get();
            $areas = Area::all();
            $title = 'Tambah Penanggung Jawab Area Kerja';
            return view('admin.area_responsibilities.edit', compact('cleanersArea', 'availableAreas', 'title'));
        }

        public function updateAreaResponsibilitiesAdmin(Request $request)
        {
            $request->validate([
                'area_id' =>'required',
            ]);
            $user_id = $request->id_users;
            $area_ids = $request->area_id;

            // Delete existing area responsibilities for the user
            AreaResponsibility::where('user_id', $user_id)->delete();

            // Create new area responsibilities
            foreach ($area_ids as $area_id) {
                AreaResponsibility::create([
                    'user_id' => $user_id,
                    'area_id' => $area_id,
                ]);
            }
            return redirect()->route('Penanggung-Jawab-Area.index')->with('success', 'Penanggung Jawab Area berhasil ditambahkan');
        }

        //Reset Data Penanggung Jawab Area Kerja
        public function resetAreaResponsibilitiesAdmin()
        {
            AreaResponsibility::truncate();

            return redirect()->route('Penanggung-Jawab-Area.index')->with('success', 'Penanggung Jawab Area berhasil Di Reset');
        }

        //Fungsi untuk mencetak PDF
        public function generatePdf(Request $request){
            $selectedUsers = $request->input('selected_users',[]);//Mendaparkan inputan user dari inputan

            //Jika tidak ada pekerja dipilih, maka cetak semua
            if (empty($selectedUsers)){
                $printData = User::where('level', 'cleaner')->get();
            }else{ //Cetak berdasarkan nama pekerja yang dipilih
                $printData = User::where('level', 'cleaner')->whereIn('id_users', $selectedUsers)->get();
            }
            $title = 'Daftar Penanggung Jawab Area Kerja';
            $currentMonthYear = Carbon::now()->format('F Y');
            $fileName = "{$title}_{$currentMonthYear}.pdf";
            $pdf = Pdf::loadView('admin.area_responsibilities.pdf',compact('printData', 'title','currentMonthYear'));
            return $pdf->download("$fileName");
        }
    //End Admin
}
