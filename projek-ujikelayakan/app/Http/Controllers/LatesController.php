<?php

namespace App\Http\Controllers;

use App\Models\lates;
use App\Models\rayons;
use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
use Illuminate\Support\Facades\Auth;
use App\Exports\LatesExport;
use PDF;


class LatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lates = lates::all();
        $students = students::all();

        if (Auth::user()-> role == 'ps') {
        $rayon = rayons::where('user_id', Auth::user()->id)->first();

         $lates = lates::with('students')
            ->whereHas('students', function ($query) use ($rayon) {
                $query->where('rayon_id', $rayon->id);
        })->get();
    


    return view('Late.index', compact('lates'));
        }
        return view('Late.index', compact('students','lates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lates = lates::all();
        $student = students::all();
        return view('Late.create', compact('lates','student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required',
        ]);

        Lates::create([
            'student_id' => $request->student_id,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
            'bukti' => $request->bukti,
        ]);


        return redirect()->route('late.index')->with('success','data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
   
    public function edit(lates $lates, $id)
    {
        $lates =lates::findOrFail($id);
        $student = students::all();
        return view('Late.edit', compact('lates','student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lates $lates, $id)
    {
        $request->validate([
            'student_id' => 'required',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'nullable|mimes:jpg,jpeg,png,gif|max:1024'
        ]);

        $dataToUpdate = [
            'student_id' => $request->student_id,
            'date_time_late' => $request->date_time_late,
            'information' => $request->information,
        ];

        if ($request->hasFile('bukti')) {
            $bukti_file = $request->file('bukti');
            $bukti_nama = $bukti_file->hashName();
            $bukti_file->move(public_path('image'), $bukti_nama);

            $dataToUpdate['bukti'] = $bukti_nama;
        }

        lates::where('id', $id)->update($dataToUpdate);
        return redirect()->route('late.index')->with('success','data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(lates $lates, $id)
    {
        lates::where('id', $id)->delete();

        return redirect()->back()->with('deleted','Data berhasil dihapus');
    }

    public function rekap()
    {
        $lates = Students::withCount('lates')
        // ->select('student_id', DB::raw('count(*) as total'))
        // ->groupBy('student_id')
        ->get();
        // dd($lates);
        $latesStudent = $lates->groupBy('student_id')->count();
        // $student = Students::with('lates')->select('id', 'name', 'nis')->distinct()->get();
        $student = students::all();

        if (Auth::user()-> role == 'ps') {
            $rayon_id = Auth::user()->rayon_id;
            $studenRayon = $student->where('rayon_id', $rayon_id);

            $lateCounts = [];
            foreach ($studenRayon as $student) {
                $lateCount = lates::where('student_id', $student->id)->count();

                $lateCounts[$student->id] = $lateCount;
            }

            return view('late.rekap', compact('studenRayon','lateCounts'));
        }
        return view('late.rekap', compact('lates', 'latesStudent', 'student'));
    }
    public function exportExcel()
    {
        $file_name = 'data_keterlambatan'.'.xlsx';
        return Excel::download(new LatesExport, $file_name);
    }
   public function downloadPDF($student_id)
   {
    if (Auth::user()-> role == 'ps') {
      
        $student = Students::with('rombel', 'rayon')->find($student_id);
        $pdf = PDF::loadView('late.print', compact('student'));
        $pdfFileName = 'keterlambatan_' . $student->name . '.pdf';
    
        return $pdf->stream($pdfFileName);
    }
    $student = Students::with('rombel', 'rayon')->find($student_id);
    $pdf = PDF::loadView('late.print', compact('student'));
    $pdfFileName = 'keterlambatan_' . $student->name . '.pdf';

    return $pdf->stream($pdfFileName);
   }

   public function detail(Lates $late, $id)
    {
        $lates = lates::with('students')->where('student_id', $id)->get();
        // dd($lates);
        $student = Students::find($id);

        return view('late.detail', compact('lates', 'student'));
    }
    
}



