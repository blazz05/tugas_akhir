<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasantri;

class MahasantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
       //dapatkan seluruh data mahasantri dengan query builder
       $ar_mahasantri = DB::table('mahasantri')->get();
       //arahkan ke halaman baru dengan menyertakan data mahasantri(compact)
       //di resources/views/mahasantri/index.blade.php
       return view('mahasantri.index',compact('ar_mahasantri'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengarahkan ke halaman form input
        return view('mahasantri.form');
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            // Validasi data form
            $validasi = $request->validate([
                'nim' => 'required|integer',
                'nama' => 'required|max:50',
                'asal' => 'required',
                'kelas' => 'required',
                'tahun_ajaran' => 'required',
                'lulus' => 'required',
                'keterangan' => 'required|string|max:255',
            ], [
                'nim.required' => 'Nim Wajib di Isi',
                'nama.required' => 'Nama Wajib di Isi',
                'asal.required' => 'Asal Daerah Wajib di Isi',
                'kelas.required' => 'Kelas Wajib di Isi',
                'tahun_ajaran.required' => 'Tahun Ajaran Wajib di Isi',
                'lulus.required' => 'Ujian Tahfizh Wajib di Isi',
                'keterangan.required' => 'Keterangan Wajib di Isi',
            ]);

            // Proses input data ke database menggunakan model Mahasantri
            $mahasantri = Mahasantri::create(
                [
                    'nim' => $request->nim,
                    'nama' => $request->nama,
                    'asal' => $request->asal,
                    'kelas' => $request->kelas,
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'lulus' => $request->lulus,
                    'keterangan' => $request->keterangan,
                ]
            );

                // Log aktivitas tambah data mahasantri
                activity()
                    ->causedBy(auth()->user())
                    ->performedOn($mahasantri)
                    ->withProperties(['before' => null, 'after' => $mahasantri->fresh()->toArray()]);
                    
                // Landing page setelah berhasil menyimpan data
                return redirect('/mahasantri');
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
        {
            // menampilkan detail mahasantri
            $ar_mahasantri = DB::table('mahasantri')
            ->where('mahasantri.id', '=',$id)->get();
            // Menampilkan detail mahasantri menggunakan model Mahasantri
            $mahasantri = Mahasantri::findOrFail($id);

            return view('mahasantri.show',compact('ar_mahasantri'));
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
        {
            //mengarahkan ke halaman form edit mahasantri
            $data = DB::table('mahasantri')
            ->where('id','=',$id)->get();

            return view('mahasantri.form_edit',compact('data'));
        }

    /**
     * Update the specified resource in storage.
     */
  
     public function update(Request $request, string $id)
        {
            // Ambil data mahasantri sebelum diubah
            $mahasantri = Mahasantri::findOrFail($id);
            $oldData = $mahasantri->getAttributes(); // Data sebelum diubah
        
            // Update data mahasantri
            $mahasantri->update(
                [
                    'nim' => $request->nim,
                    'nama' => $request->nama,
                    'asal' => $request->asal,
                    'kelas' => $request->kelas,
                    'tahun_ajaran' => $request->tahun_ajaran,
                    'lulus' => $request->lulus,
                    'keterangan' => $request->keterangan,
                ]
            );
        
            // Ambil data setelah diubah
            $newData = $mahasantri->fresh()->toArray(); // Data setelah diubah
        
            // Log aktivitas update data mahasantri
            activity()
                ->causedBy(auth()->user())
                ->withProperties(
                    [
                        'old' => $oldData,
                        'attributes' => $newData
                    ]   
                );
        
            // Redirect ke halaman detail mahasantri setelah berhasil menyimpan perubahan
            return redirect('/mahasantri'.'/'.$id);
        }
     

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
        {

            // Menghapus data mahasantri menggunakan model Mahasantri
            $mahasantri = Mahasantri::findOrFail($id);
            //menghapus data mahasantri
            DB::table('mahasantri')->where('id',$id)->delete();
            
            // Log aktivitas hapus data mahasantri
            activity()
            ->causedBy(auth()->user())
            ->event('deleted')
            ->log('Mahasantri ' . $mahasantri->nama . ' dihapus');
            
            return redirect('/mahasantri');
        }
}
