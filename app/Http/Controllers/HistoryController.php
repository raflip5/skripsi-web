<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class HistoryController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        if ($request->ajax()) {
            $histories = History::with(['student' => function ($query) {
                $query->select('id', 'name', 'nis', 'jenis_kelamin', 'kelas'); // Modify to select necessary columns from student
            }])->select([
                'student_id',
                'result',
                'score',
                'created_at',
            ])->get();
            

            return DataTables::of($histories)
                ->addIndexColumn()
                ->toJson();
        }

        return view('report.index');
    }
}
