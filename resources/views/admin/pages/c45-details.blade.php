@extends('layouts.template')

@section('csstambahan')
<!-- CSS tambahan jika ada -->
<script src="https://d3js.org/d3.v6.min.js"></script>
<style>
    .highlight {
        background-color: red;
    }
    .highlight-gain {
        background-color: yellow;
    }
    .node circle {
        fill: #4682B4;
        stroke: steelblue;
        stroke-width: 3px;
    }

    .node text {
        font: 12px sans-serif;
    }

    .link {
        fill: none;
        stroke: #ccc;
        stroke-width: 2px;
    }
</style>
@endsection

@section('konten')
<h1>{{ $title }}</h1>
<div id="treeContainer" style="width: 100%; height: 500px;"></div>

@php
    $iterations = collect($debugInfo)->groupBy('iteration');
    $selectedAttributes = [];
@endphp

@foreach ($iterations as $iteration => $infos)
<section>

    <h2>Detail Node {{ $iteration }}</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Atribut</th>
                    <th>Entropy</th>
                    <th>Gain</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($infos as $info)
                    @if (!in_array($info['attribute'], $selectedAttributes))
                        <tr class="{{ in_array($info['attribute'], $selectedAttributes) ? 'highlight' : '' }}">
                            <td>{{ $info['attribute'] }}</td>
                            <td>{{ number_format($info['entropy'], 6) }}</td>
                            <td class="{{ $info['gain'] == $infos->max('gain') ? 'highlight-gain' : '' }}">{{ number_format($info['gain'], 6) }}</td>
                        </tr>
                        @endif
                @endforeach
            </tbody>
        </table>
    </div>
</section>
    @php
        // Menambahkan atribut yang terpilih ke dalam array selectedAttributes
        $selectedAttributes[] = $infos->firstWhere('gain', $infos->max('gain'))['attribute'];
    @endphp
    @endforeach

<!-- <h2>Rules Based on Decision Tree</h2>
<div class="rules">
    @php
        $rules = generateRules($tree);
    @endphp
    <ul>
        @foreach ($rules as $rule)
            <li>{{ $rule }}</li>
        @endforeach
    </ul>
</div> -->
@endsection

@section('jstambahan')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const treeData = @json($tree);

    const margin = {top: 20, right: 90, bottom: 30, left: 90},
        width = 960 - margin.left - margin.right,
        height = 500 - margin.top - margin.bottom;

    const svg = d3.select("#treeContainer").append("svg")
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

    const root = d3.hierarchy(treeData, function(d) { return d.children ? Object.values(d.children) : null; });
    const treeLayout = d3.tree().size([width, height]); // Tukar width dan height

    treeLayout(root);

    // Nodes
    const nodes = svg.selectAll('g.node')
        .data(root.descendants())
        .enter().append('g')
        .attr('class', 'node')
        .attr('transform', function(d) { return 'translate(' + d.x + ',' + d.y + ')'; }); // Tukar d.x dan d.y

    nodes.append('circle')
        .attr('r', 10)
        .style('fill', '#4682B4');

    nodes.append('text')
        .attr('dy', '.35em')
        .attr('x', function(d) { return d.children ? -13 : 13; })
        .style('text-anchor', function(d) { return d.children ? 'end' : 'start'; })
        .text(function(d) { return d.data.attribute ? d.data.attribute : d.data; });

    // Links
    const links = svg.selectAll('path.link')
        .data(root.links())
        .enter().append('path')
        .attr('class', 'link')
        .attr('d', d3.linkHorizontal()
            .x(function(d) { return d.x; }) // Tukar d.x dan d.y
            .y(function(d) { return d.y; })) // Tukar d.x dan d.y
        .style('fill', 'none')
        .style('stroke', '#ccc')
        .style('stroke-width', '2px');
});
</script>
@endsection

@php
function generateRules($node, $path = []) {
    $rules = [];
    if ($node instanceof \stdClass) {
        if (!empty($node->children)) {
            foreach ($node->children as $value => $child) {
                $newPath = array_merge($path, ["{$node->attribute} = '$value'"]);
                $rules = array_merge($rules, generateRules($child, $newPath));
            }
        }
    } else {
        $condition = implode(" AND ", $path);
        $rule = "IF " . $condition . " THEN class = '$node'";
        $rules[] = $rule;
    }
    return $rules;
}
@endphp

