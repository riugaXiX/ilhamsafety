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
    const treeLayout = d3.tree().size([width, height]); // Ukuran pohon diatur secara horizontal

    treeLayout(root);

    // Nodes
    const nodes = svg.selectAll('g.node')
        .data(root.descendants())
        .enter().append('g')
        .attr('class', 'node')
        .attr('transform', function(d) { return 'translate(' + d.x + ',' + d.y + ')'; });

    nodes.append('circle')
        .attr('r', 10)
        .style('fill', function(d) {
            // Ubah warna fill berdasarkan atribut 'kelembapan' dan nilai 'value'
            if (d.data.attribute === 'kelembapan') {
                if (d.data.value === 'lembab') {
                    return 'green';  // Warna untuk kelembapan 'lembab'
                } else if (d.data.value === 'kering') {
                    return 'brown';  // Warna untuk kelembapan 'kering'
                }
            }
            return '#4682B4'; // Warna default
        });

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
        .attr('d', d3.linkVertical()
            .x(function(d) { return d.x; })
            .y(function(d) { return d.y; }))
        .style('fill', 'none')
        .style('stroke', '#ccc')
        .style('stroke-width', '2px');

    // Add link labels
    svg.selectAll('g.link-label')
        .data(root.links())
        .enter().append('g')
        .attr('class', 'link-label')
        .attr('transform', function(d) {
            return 'translate(' + ((d.source.x + d.target.x) / 2) + ',' + ((d.source.y + d.target.y) / 2) + ')';
        })
        .append('text')
        .attr('dy', -5)
        .attr('text-anchor', 'middle')
        .text(function(d) {
            // Ganti dengan logika Anda untuk menampilkan label yang sesuai
            const parentChildren = Object.entries(d.source.data.children || {});
            for (const [key, value] of parentChildren) {
                if (value === d.target.data) {
                    return key;
                }
            }
            return '';
        });
});
</script>


@endsection
