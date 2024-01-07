<?php

namespace App\Exports;

use App\Models\rayons;
use Illuminate\Support\Facades\Auth;
use App\Models\lates;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LatesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (Auth::user()-> role == 'ps') {
            $rayon = rayons::where('user_id', Auth::user()->id)->first();

            $lates = lates::withCount('students')
            ->whereHas('students', function ($query) use ($rayon) {
                $query->where('rayon_id', $rayon->id);
            })->get();
            return $lates;

        }

        // Mengambil semua data terlambat beserta relasi siswa dan menghitung jumlah terlambat
        $lates = lates::with('students')->get();

        // Mengelompokkan data berdasarkan siswa dan menghitung jumlah keterlambatan
        $students = $lates->groupBy('student_id')->map(function ($late) {
            return [
                'students' => $late->first()->students,
                'lates_count' => $late->count()
            ];
        });
        return $students;
    }
    public function headings(): array
    {
        return [
            "NIS", "Nama", "Rombel", "Rayon", "Total Keterlambatan"
        ];
    }

    public function map($item): array
    {
        if (Auth::user()->role == 'ps') {
            [
                $item->students->nis,
                $item->students->name,
                $item->students->rombel->rombel,
                $item->students->rayon->rayon,
                $item->lateCounts,
            ];
        }
        return [
            $item['students']->nis,
            $item['students']->name,
            $item['students']->rombel->rombel,
            $item['students']->rayon->rayon,
            $item['lates_count'],
        ];
    }
}




// if (Auth::user()-> role == 'ps') {
//     $rayon_id = Auth::user()->rayon_id;
//     $studenRayon = $student->where('rayon_id', $rayon_id);

//     $lateCounts = [];
//     foreach ($studenRayon as $student) {
//         $lateCount = lates::where('student_id', $student->id)->count();

//         $lateCounts[$student->id] = $lateCount;
//     }

//     return view('late.rekap', compact('studenRayon','lateCounts'));
// }