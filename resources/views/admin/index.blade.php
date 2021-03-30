@extends('main')

@section('title','Admin')

<!-- Main Content -->
@section('content')

<!-- Flash Message -->
@include('partials.message')
<!-- End Flash Message -->

<div class="col-md-12">
    @include('admin.user.form')
</div>
<div class="col-md-12">
    @include('admin.user.table')
</div>

@endsection