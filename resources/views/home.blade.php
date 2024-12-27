@extends('layouts.app')

@section('title', 'Home - Digital Startups')

@section('content')
    @include('layouts.partials.domain')
    @include('layouts.partials.get-website')
    @include('layouts.partials.freeTemplate')
    @include('layouts.partials.whyChooseUs')
    @include('layouts.partials.ourService')
    @include('layouts.partials.googleReview')
@endsection
