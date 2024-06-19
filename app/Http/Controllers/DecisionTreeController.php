<?php

namespace App\Http\Controllers;

use App\Models\Training;
use Illuminate\Http\Request;

class DecisionTreeController extends Controller
{
    // Fungsi untuk menghitung entropi
    private function calculateEntropy($data, $targetAttribute)
    {
        $values = array_count_values(array_column($data, $targetAttribute));
        $entropy = 0.0;
        $total = count($data);

        foreach ($values as $value) {
            $probability = $value / $total;
            $entropy -= $probability * log($probability, 2);
        }

        return $entropy;
    }

    // Fungsi untuk menghitung gain
    private function calculateGain($data, $attribute, $targetAttribute)
    {
        $totalEntropy = $this->calculateEntropy($data, $targetAttribute);
        $values = array_unique(array_column($data, $attribute));
        $subsetEntropy = 0.0;

        foreach ($values as $value) {
            $subset = array_filter($data, function ($row) use ($attribute, $value) {
                return $row[$attribute] == $value;
            });
            $probability = count($subset) / count($data);
            $subsetEntropy += $probability * $this->calculateEntropy($subset, $targetAttribute);
        }

        return $totalEntropy - $subsetEntropy;
    }

    // Fungsi untuk membangun pohon keputusan
    private function buildTree($data, $attributes, $targetAttribute)
    {
        $debugInfo = [];
        $tree = $this->recursiveBuildTree($data, $attributes, $targetAttribute, $debugInfo);
        return [$tree, $debugInfo];
    }

    // Fungsi rekursif untuk membangun pohon keputusan
    private function recursiveBuildTree($data, $attributes, $targetAttribute, &$debugInfo, $iteration = 1)
    {
        $targetValues = array_column($data, $targetAttribute);
        if (count(array_unique($targetValues)) === 1) {
            return $targetValues[0]; // Semua data memiliki label yang sama
        }

        if (empty($attributes)) {
            return array_search(max(array_count_values($targetValues)), array_count_values($targetValues)); // Mayoritas
        }

        $bestGain = -1;
        $bestAttribute = null;
        $bestEntropy = null;

        foreach ($attributes as $attribute) {
            $entropy = $this->calculateEntropy($data, $targetAttribute);
            $gain = $this->calculateGain($data, $attribute, $targetAttribute);
            if ($gain > $bestGain) {
                $bestGain = $gain;
                $bestAttribute = $attribute;
                $bestEntropy = $entropy;
            }
        }

        $debugInfo[] = [
            'iteration' => $iteration,
            'attribute' => $bestAttribute,
            'entropy' => $bestEntropy,
            'gain' => $bestGain
        ];

        $remainingAttributes = array_diff($attributes, [$bestAttribute]);
        $tree = (object)[
            'attribute' => $bestAttribute,
            'children' => []
        ];

        $values = array_unique(array_column($data, $bestAttribute));
        foreach ($values as $value) {
            $subset = array_filter($data, function ($row) use ($bestAttribute, $value) {
                return $row[$bestAttribute] == $value;
            });
            $tree->children[$value] = $this->recursiveBuildTree($subset, $remainingAttributes, $targetAttribute, $debugInfo, $iteration + 1);
        }

        return $tree;
    }

    // Fungsi untuk menampilkan hasil perhitungan
    public function showCalculations()
    {
        $data = Training::all()->toArray();
        $targetAttribute = 'label';
        $attributes = ['suhu', 'kelembapan', 'gas', 'api'];

        list($tree, $debugInfo) = $this->buildTree($data, $attributes, $targetAttribute);
        // dd($tree);
        $title = 'C4.5';

        return view('admin.pages.c45-details', compact('debugInfo', 'tree', 'title'));
    }
}

