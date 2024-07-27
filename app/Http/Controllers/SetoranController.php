<?php

namespace App\Http\Controllers;

use App\Models\Mahasantri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Setoran;
use Illuminate\Support\Facades\View;
use \Mpdf\Mpdf;
class SetoranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        {        
            $ar_setoran = DB::table('setoran') //join tabel dengan Query Builder Laravel
            ->join('mahasantri', 'mahasantri.id', '=', 'setoran.mahasantri_id')
            ->select('setoran.*', 'mahasantri.nim AS nim', 'mahasantri.nama AS nama')
            ->get();
            return view('setoran.index', compact('ar_setoran'));
        }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
        {
            // Mengarahkan ke halaman form input
            return view('setoran.form');
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
                    'juz'=>'required',
                    'halaman'=>'required',
                    'mahasantri_id'=>'required',  
                
                ],
                //menampilkan pesan kesalahan
                [  
                    'tanggal.required'=>'Tanggal Wajib di Isi',
                    'waktu.required'=>'Waktu Wajib di Isi',  
                    'juz.required'=>'Juz Daerah Wajib di Isi',                        
                    'halaman.required'=>'Halaman Wajib di Isi',
                    'mahasantri_id.required'=>'Nim Wajib di Isi',    
                    'mahasantri_id.required'=>'Nama Wajib di Isi',    
                    
                            
                ],
                );

             // Proses input data ke database menggunakan model Setoran
             $setoran = Setoran::create(
                [
                    'tanggal' => $request->tanggal,
                    'waktu' => $request->waktu,
                    'juz' => $request->juz,
                    'halaman' => $request->halaman,
                    'mahasantri_id' => $request->mahasantri_id,
                ]
            );

            // Log aktivitas tambah data setoran
            activity()
                ->causedBy(auth()->user())
                ->performedOn($setoran)
                ->withProperties(['before' => null, 'after' => $setoran->fresh()->toArray()]);
                

            // Landing page setelah berhasil menyimpan data
            return redirect('/setoran');
        }

    /**
     * Display the specified resource.
     */
    public function show($id)
        {
            $setoran = DB::table('setoran')
                ->join('mahasantri', 'mahasantri.id', '=', 'setoran.mahasantri_id')
                ->select('setoran.*', 'mahasantri.nim AS nim', 'mahasantri.nama AS nama')
                ->where('setoran.id', '=', $id)
                ->first();

            if (!$setoran) {
                abort(404); // Tampilkan halaman 404 jika data tidak ditemukan
            }

            return view('setoran.show', compact('setoran'));
        }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
        {
            //mengarahkan ke halaman form edit setoran
            $data = DB::table('setoran')
            ->where('id','=',$id)->get();
            return view('setoran.form_edit',compact('data'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
        {
            // Ambil data setoran sebelum diubah
            $setoran = Setoran::findOrFail($id);
            $oldData = $setoran->getAttributes(); // Data sebelum diubah

            // Update data setoran
            $setoran->update(
                [
                    'tanggal' => $request->tanggal,
                    'waktu' => $request->waktu,
                    'juz' => $request->juz,
                    'halaman' => $request->halaman,
                    'mahasantri_id' => $request->mahasantri_id,
                ] 
            );

            // Ambil data setelah diubah
            $newData = $setoran->fresh()->toArray(); // Data setelah diubah
            
            // Log aktivitas update data setoran
            activity()
                ->causedBy(auth()->user())
                ->withProperties(
                    [
                        'old' => $oldData,
                        'attributes' => $newData
                    ]
                );
            
            //landing page
            return redirect('/setoran'.'/'.$id);
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
        {
            // Menghapus data setoran menggunakan model Setoran
            $setoran = Setoran::findOrFail($id);

            //menghapus data setoran
            DB::table('setoran')->where('id',$id)->delete();

            // Ambil nama mahasantri terkait setoran
            $mahasantriNama = Mahasantri::findOrFail($setoran->mahasantri_id)->nama;

             // Log aktivitas hapus data setoran
             activity()
             ->causedBy(auth()->user())
             ->event('deleted')
             ->log('Setoran Nama ' . $mahasantriNama . ' Di Hapus');
             
            return redirect('/setoran');
        }
}
