@extends('frontend.layouts.app')
@section('title')
    {{ __('menu.homepage') }}
@endsection
@section('content')
    @include('frontend.blocks.slider')
    @include('frontend.blocks.card')
    @include('frontend.blocks.feature')
@endsection
