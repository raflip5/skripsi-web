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
            $histories = History::with('student');

            return DataTables::of($histories)
                ->addIndexColumn()
                ->escapeColumns()
                ->toJson();
        }

        return view('report.index');
    }
}
