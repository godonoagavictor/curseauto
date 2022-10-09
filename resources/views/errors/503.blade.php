@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', get_translated_settings('app_maintenance_message', __('Service Unavailable')))
