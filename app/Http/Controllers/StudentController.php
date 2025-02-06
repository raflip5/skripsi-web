<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|JsonResponse
    {
        if (request()->ajax()) {
            $students = Student::all();

            return DataTables::of($students)
                ->addIndexColumn()
                ->escapeColumns()
                ->toJson();
        }

        return view('student.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (Student::create($validated)) {
            flash()->success('Berhasil menambah data siswa');

            return redirect()->route('siswa.index');
        }

        flash()->error('Gagal menambah data siswa');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $siswa): View
    {
        return view('student.edit', compact(['siswa']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $siswa): RedirectResponse
    {
        $validated = $request->validated();

        if ($siswa->update($validated)) {
            flash()->success('Berhasil mengubah data siswa');

            return redirect()->route('siswa.index');
        }

        flash()->error('Gagal mengubah data siswa');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $siswa): bool
    {
        $result = false;

        if ($siswa->delete()) {
            $result = true;
        }

        $result == true ? flash()->success('Berhasil menghapus data siswa') : flash()->error('Gagal menghapus data siswa');

        return $result;
    }

    public function lookupNIS(Request $request)
    {
        $nis = $request->query('nis');

        $siswa = Student::where('nis', $nis)->first();

        if (!$siswa) {
            return response()->json(['message' => 'NIS tidak ditemukan'], 404);
        }

        return response()->json([
            'nama' => $siswa->nama,
            'jenis_kelamin' => $siswa->jenis_kelamin,
            'kelas' => $siswa->kelas
        ]);
    }
}
