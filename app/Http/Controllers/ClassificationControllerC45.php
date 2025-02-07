<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Phpml\Classification\DecisionTree;

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
        $samples = [
            ['Laki-Laki', 'X', 15, 'BV', 'Langsung', 'Teman Sebaya', 'Laki-Laki', 'kelas', 'jarang', 'rendah', 'Bullying Verbal'],
            ['Perempuan', 'XI', 16, 'BS', 'Tidak Langsung', 'Senior', 'Perempuan', 'media sosial', 'kadang-kadang', 'sedang', 'Bullying Sosial'],
            ['Laki-Laki', 'XII', 17, 'BF', 'Langsung', 'Senior', 'Laki-Laki', 'koridor sekolah', 'tinggi', 'tinggi', 'Bullying Fisik'],
            ['Perempuan', 'X', 15, 'PSV', 'Langsung', 'Teman Sebaya', 'Laki-Laki', 'kelas', 'jarang', 'sedang', 'Pelecehan Seksual Verbal'],
            ['Laki-Laki', 'XI', 16, 'PSF', 'Tidak Langsung', 'Senior', 'Perempuan', 'kantin', 'kadang-kadang', 'sedang', 'Pelecehan Seksual Fisik'],
            ['Perempuan', 'XII', 17, 'PSNF', 'Langsung', 'Guru/Staff', 'Laki-Laki', 'koridor sekolah', 'tinggi', 'tinggi', 'Pelecehan Seksual Non Verbal'],
            ['Laki-Laki', 'X', 15, 'PSO', 'Online', 'Teman Sebaya', 'Campuran', 'media sosial', 'tinggi', 'tinggi', 'Pelecehan Seksual Online'],
            ['Perempuan', 'XI', 16, 'BV', 'Langsung', 'Senior', 'Perempuan', 'lapangan', 'jarang', 'rendah', 'Bullying Verbal'],
            ['Laki-Laki', 'XII', 17, 'BS', 'Tidak Langsung', 'Senior', 'Laki-Laki', 'koridor sekolah', 'tinggi', 'sedang', 'Bullying Sosial'],
            ['Perempuan', 'X', 15, 'BF', 'Langsung', 'Teman Sebaya', 'Perempuan', 'kantin', 'kadang-kadang', 'sedang', 'Bullying Fisik'],
            ['Laki-Laki', 'XI', 16, 'PSV', 'Tidak Langsung', 'Senior', 'Perempuan', 'kelas', 'kadang-kadang', 'sedang', 'Pelecehan Seksual Verbal'],
            ['Perempuan', 'XII', 17, 'PSNF', 'Langsung', 'Guru/Staff', 'Laki-Laki', 'media sosial', 'tinggi', 'tinggi', 'Pelecehan Seksual Non Verbal'],
            ['Laki-Laki', 'X', 15, 'PSF', 'Langsung', 'Teman Sebaya', 'Perempuan', 'koridor sekolah', 'jarang', 'rendah', 'Pelecehan Seksual Fisik'],
            ['Perempuan', 'XI', 16, 'PSO', 'Online', 'Teman Sebaya', 'Campuran', 'media sosial', 'kadang-kadang', 'sedang', 'Pelecehan Seksual Online'],
            ['Laki-Laki', 'XII', 17, 'BV', 'Langsung', 'Teman Sebaya', 'Laki-Laki', 'lapangan', 'tinggi', 'sedang', 'Bullying Verbal'],
            ['Perempuan', 'X', 15, 'BS', 'Tidak Langsung', 'Senior', 'Perempuan', 'kelas', 'jarang', 'rendah', 'Bullying Sosial'],
            ['Laki-Laki', 'XI', 16, 'BF', 'Langsung', 'Guru/Staff', 'Perempuan', 'koridor sekolah', 'kadang-kadang', 'sedang', 'Bullying Fisik'],
            ['Perempuan', 'XII', 17, 'PSV', 'Langsung', 'Teman Sebaya', 'Laki-Laki', 'kantin', 'tinggi', 'tinggi', 'Pelecehan Seksual Verbal'],
            ['Laki-Laki', 'X', 15, 'PSNF', 'Tidak Langsung', 'Senior', 'Perempuan', 'media sosial', 'jarang', 'rendah', 'Pelecehan Seksual Non Verbal'],
            ['Perempuan', 'XI', 16, 'PSF', 'Langsung', 'Senior', 'Laki-Laki', 'lapangan', 'kadang-kadang', 'sedang', 'Pelecehan Seksual Fisik'],
            ['Laki-Laki', 'XII', 17, 'PSO', 'Online', 'Teman Sebaya', 'Perempuan', 'koridor sekolah', 'tinggi', 'tinggi', 'Pelecehan Seksual Online'],
            ['Perempuan', 'X', 15, 'BV', 'Langsung', 'Guru/Staff', 'Perempuan', 'kantin', 'kadang-kadang', 'sedang', 'Bullying Verbal'],
            ['Laki-Laki', 'XI', 16, 'BS', 'Tidak Langsung', 'Teman Sebaya', 'Laki-Laki', 'kelas', 'tinggi', 'rendah', 'Bullying Sosial'],
            ['Perempuan', 'XII', 17, 'BF', 'Langsung', 'Senior', 'Laki-Laki', 'media sosial', 'jarang', 'tinggi', 'Bullying Fisik'],
            ['Laki-Laki', 'X', 15, 'PSV', 'Tidak Langsung', 'Teman Sebaya', 'Campuran', 'koridor sekolah', 'kadang-kadang', 'rendah', 'Pelecehan Seksual Verbal'],
            ['Perempuan', 'XI', 16, 'PSF', 'Langsung', 'Guru/Staff', 'Perempuan', 'lapangan', 'tinggi', 'sedang', 'Pelecehan Seksual Fisik'],
        ];

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

        History::create([
            'student_id' => $student->id,
            'result' => $prediction[0],
            'score' => $confidences
        ]);

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
}
