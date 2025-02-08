<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Student;
use App\Models\Training;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Phpml\Classification\DecisionTree;
use Yajra\DataTables\Facades\DataTables;

class ClassificationControllerC45 extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user->role != 1) {
            flash()->error('Anda tidak memiliki izin');

            return redirect()->route('dashboard');
        }

        $nis = $request->query('nis');

        $student = Student::where('nis', $nis)->first();

        if ($student) {
            $student->jenis_kelamin = trim(str_replace(["\r", "\n", " "], "", $student->jenis_kelamin));
            $student->kelas = trim($student->kelas);
        }

        return view('clasification.index', compact('student'));
    }

    public function predict(Request $request)
    {
        $user = Auth::user();

        if ($user->role != 1) {
            flash()->error('Anda tidak memiliki izin');

            return redirect()->route('dashboard');
        }

        // Ambil data dari form
        $nis = $request->nis;

        $student = Student::where('nis', $nis)->first();

        $data = [
            [
                $request->jenis_kelamin,
                $request->kelas,
                $request->umur,
                $request->insiden,
                $request->insiden_langsung,
                $request->siapa_pelaku,
                $request->jenis_kelamin_pelaku,
                $request->lokasi,
                $request->frekuensi,
                $request->dampak_psikologis
            ]
        ];

        // Data latih dan label (hasil klasifikasi)
        $samplesData = Training::with('student')->get();

        foreach ($samplesData as $index => $dataTraining) {
            $samples[$index] = [
                $dataTraining->student->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan',
                $dataTraining->student->kelas,
                $dataTraining->umur,
                $dataTraining->insiden,
                $dataTraining->pelaku,
                $dataTraining->jenis_kelamin_pelaku,
                $dataTraining->lokasi,
                $dataTraining->frekuensi,
                $dataTraining->dampak,
                $dataTraining->hasil
            ];
        }

        // Hasil klasifikasi
        $features = array_map(function ($sample) {
            return array_slice($sample, 0, count($sample) - 1); // Ambil semua data kecuali label
        }, $samples);

        $labels = array_map(function ($sample) {
            return end($sample); // Ambil label yang ada di akhir data
        }, $samples);

        // Latih model dengan DecisionTree (algoritma pohon keputusan)
        $classifier = new DecisionTree();
        $classifier->train($samples, $labels);

        // Prediksi hasil berdasarkan input pengguna
        $prediction = $classifier->predict($data);

        $confidences = $this->calculateConfidence($classifier, $data, $features, $labels);

        // Create history data
        History::create([
            'student_id' => $student->id,
            'result' => $prediction[0],
            'score' => $confidences
        ]);

        // Create data latih
        Training::firstOrCreate(
            [
                'student_nis' => $student->nis,
                'umur' => $request->umur,
                'insiden' => $request->insiden,
                'lokasi' => $request->lokasi,
                'frekuensi' => $request->frekuensi,
                'insiden_kejadian' => $request->insiden_langsung,
                'pelaku' => $request->siapa_pelaku,
                'jenis_kelamin_pelaku' => $request->jenis_kelamin_pelaku,
                'dampak' => $request->dampak_psikologis,
            ],
            [
                'hasil' => $prediction[0]
            ]
        );

        // Menampilkan hasil prediksi dan skor kepastian
        return view('clasification.result', [
            'result' => $prediction[0],
            'confidence' => $confidences
        ]);
    }

    private function calculateConfidence($classifier, $data, $features, $labels)
    {
        // Mendapatkan hasil prediksi untuk semua sampel
        $predictions = $classifier->predict($features);

        // Menghitung seberapa sering label yang diprediksi oleh model muncul
        $counts = array_count_values($predictions);

        // Skor kepastian berdasarkan jumlah kemunculan label yang benar
        $prediction = $classifier->predict($data);
        $confidence = isset($counts[$prediction[0]]) ? ($counts[$prediction[0]] / count($predictions)) * 100 : 0;

        return $confidence; // Skor kepastian (dalam persen)
    }

    public function dataTraining(Request $request): View|JsonResponse
    {
        $user = Auth::user();

        if ($user->role != 1) {
            flash()->error('Anda tidak memiliki izin');

            return redirect()->route('dashboard');
        }

        if ($request->ajax()) {
            $trainings = Training::with('student');

            return DataTables::of($trainings)
                ->addIndexColumn()
                ->escapeColumns()
                ->toJson();
        }

        return view('clasification.data');
    }
}
