@extends('layouts.template')

@section('konten')
<h1>Decision Tree</h1>
<pre>{{ print_r($tree, true) }}</pre>
@endsection