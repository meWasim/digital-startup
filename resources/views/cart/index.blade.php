@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Cart</h2>
    <div class="row">
        @forelse($templates as $template)
            <div class="col-md-3 col-sm-3 p-md-3 pl-2 pr-3 pt-0 pb-1">
                <div class="webImg">
                    <div class="webTemp position-relative">
                        <img src="{{ asset($template->thumbnail) }}" alt="{{ $template->name }}">
                    </div>
                    <div class="webArea position-relative py-4 px-3">
                        <div class="title w-100 d-block text-left position-absolute pl-3">
                            {{ $template->name }}</div>
                        <div class="rupee-sym w-100 d-block text-left position-absolute pl-3">
                            ₹ Free</div>
                    </div>
                    <div class="web-demo w-100 d-block text-right position-absolute pr-3">
                        <a href="{{ url('user/template-preview/' . $template->folder) }}" target="_blank" class="btn btn-info btn-sm">Preview</a>
                        <a href="{{ route('template.edit', $template->id) }}" class="btn btn-warning ml-2">Edit</a>
                        <a href="{{ route('check.template.edit', ['template_id' => $template->id, 'user_id' => auth()->id()]) }}" class="btn btn-success ml-2">Edit About Us & Services</a>
                    </div>
                    
                </div>
            </div>
        @empty
            <p>Your cart is empty.</p>
        @endforelse
    </div>
    <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
</div>
@endsection
