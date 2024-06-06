<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\training;

class TrainingController extends Controller
{
    //
    public function index(){

        $data = training::all();
    }
    
    function calculateEntropy($data)
{
    $total = count($data);
    $targetCounts = array_count_values(array_column($data, 'label'));
    $entropy = 0.0;

    foreach ($targetCounts as $count) {
        $probability = $count / $total;
        $entropy -= $probability * log($probability, 2);
    }

    return $entropy;
}

function calculateGain($data, $attribute)
{
    $totalEntropy = calculateEntropy($data);
    $total = count($data);
    $attributeValues = array_unique(array_column($data, $attribute));
    $weightedEntropy = 0.0;

    foreach ($attributeValues as $value) {
        $subset = array_filter($data, function ($item) use ($attribute, $value) {
            return $item[$attribute] == $value;
        });

        $subsetEntropy = calculateEntropy($subset);
        $weightedEntropy += (count($subset) / $total) * $subsetEntropy;
    }

    return $totalEntropy - $weightedEntropy;
}
function buildDecisionTree($data, $attributes)
{
    $targets = array_column($data, 'target');
    if (count(array_unique($targets)) == 1) {
        return $targets[0];
    }

    if (empty($attributes)) {
        return array_search(max(array_count_values($targets)), array_count_values($targets));
    }

    $gains = [];
    foreach ($attributes as $attribute) {
        $gains[$attribute] = calculateGain($data, $attribute);
    }

    $bestAttribute = array_search(max($gains), $gains);
    $tree = [$bestAttribute => []];
    $attributeValues = array_unique(array_column($data, $bestAttribute));

    foreach ($attributeValues as $value) {
        $subset = array_filter($data, function ($item) use ($bestAttribute, $value) {
            return $item[$bestAttribute] == $value;
        });

        $remainingAttributes = array_diff($attributes, [$bestAttribute]);
        $tree[$bestAttribute][$value] = buildDecisionTree($subset, $remainingAttributes);
    }

    return $tree;
}
public function showDecisionTree()
{
    $data = training::all()->toArray();
    $attributes = ['suhu', 'kelembapan', 'gas', 'api']; // Ganti dengan atribut yang sesuai

    $tree = buildDecisionTree($data, $attributes);
    return view('decision-tree', ['tree' => $tree]);
}
}
