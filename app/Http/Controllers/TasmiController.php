<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tasmi;
use App\Models\Mahasantri;

class TasmiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $ar_tasmi = DB::table('tasmi') //join tabel dengan Query Builder Laravel
        ->join('mahasantri', 'mahasantri.id', '=', 'tasmi.setoran_mahasantri_id')
        ->select('tasmi.*', 'mahasantri.nim AS nim', 'mahasantri.nama AS nama')
        ->get();
    return view('tasmi.index', compact('ar_tasmi'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengarahkan ke halaman form input
        return view('tasmi.form');
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data form
        $validasi = $request->validate(
            [ 
                'tanggal'=>'required',
                'waktu'=>'required',  
                'keterangan'=>'required',
                'setoran_id'=>'required',
                'setoran_mahasantri_id'=>'required',  
               
            ],
            //menampilkan pesan kesalahan
            [  
                'tanggal.required'=>'Tanggal Wajib di Isi',
                'waktu.required'=>'Waktu Wajib di Isi',  
                'keterangan.required'=>'Keterangan  Wajib di Isi',                        
                'setoran_id.required'=>'Juz Wajib di Isi',
                'setoran_mahasantri_id.required'=>'Nama Wajib di Isi',   
                
                        
            ],
            );

            // Proses input data ke database menggunakan model Tasmi
            $tasmi = Tasmi::create(
                [
                    'tanggal' => $request->tanggal,
                    'waktu' => $request->waktu,
                    'keterangan' => $request->keterangan,
                    'setoran_id' => $request->setoran_id,
                    'setoran_mahasantri_id' => $request->setoran_mahasantri_id,
                ]
            );

             // Log aktivitas tambah data tasmi
             activity()
             ->causedBy(auth()->user())
             ->performedOn($tasmi)
             ->withProperties(['before' => null, 'after' => $tasmi->fresh()->toArray()]);

            // Landing page setelah berhasil menyimpan data
            return redirect('/tasmi');
        }

    /**
     * Display the specified resource.
     */
    public function show($id)
        {
            $tasmi = DB::table('tasmi')
                ->join('mahasantri', 'mahasantri.id', '=', 'tasmi.setoran_mahasantri_id')
                ->select('tasmi.*', 'mahasantri.nim AS nim', 'mahasantri.nama AS nama')
                ->where('tasmi.id', '=', $id)
                ->first();

            if (!$tasmi) {
                abort(404); // Tampilkan halaman 404 jika data tidak ditemukan
            }

            return view('tasmi.show', compact('tasmi'));
        }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
        {
            //mengarahkan ke halaman form edit tasmi
            $data = DB::table('tasmi')
            ->where('id','=',$id)->get();
            return view('tasmi.form_edit',compact('data'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
        {
             // Ambil data tasmi sebelum diubah
             $tasmi = Tasmi::findOrFail($id);
             $oldData = $tasmi->getAttributes(); // Data sebelum diubah

             // Update data tasmi
             $tasmi->update(
                [
                    'tanggal' => $request->tanggal,
                    'waktu' => $request->waktu,
                    'keterangan' => $request->keterangan,
                    'setoran_id' => $request->setoran_id,
                    'setoran_mahasantri_id' => $request->setoran_mahasantri_id,
                ] 
            );

            // Ambil data setelah diubah
            $newData = $tasmi->fresh()->toArray(); // Data setelah diubah
            
            // Log aktivitas update data tasmi
            activity()
                ->causedBy(auth()->user())
                ->withProperties(
                    [
                        'old' => $oldData,
                        'attributes' => $newData
                    ]
                );

            //landing page
            return redirect('/tasmi'.'/'.$id);
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
        {
            
                // Menghapus data tasmi menggunakan model Tasmi
                $tasmi = Tasmi::findOrFail($id);
        
                // Hapus data tasmi
                DB::table('tasmi')->where('id', $id)->delete();

                // Ambil nama mahasantri terkait tasmi
                $mahasantriNama = Mahasantri::findOrFail($tasmi->setoran_mahasantri_id)->nama;
        
                // Log aktivitas hapus data mahasantri
                activity()
                ->causedBy(auth()->user())
                ->event('deleted')
                ->log('Ujian Tahfizh Nama ' . $mahasantriNama . ' Di Hapus');

                return redirect('/tasmi');
                
        }
        
}
