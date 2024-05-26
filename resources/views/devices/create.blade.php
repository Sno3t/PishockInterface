{{--@extends('layouts.app')--}}
{{--@section('content')--}}
    <div class="container">
        <h1>Add New Device</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('devices.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="device_name">Device name: </label>
                <input type="text" name="device_name" class="form-control" id="device_name" value="{{ old('device_name') }}">
            </div>
            <div class="form-group">
                <label for="share_code">Share code: </label>
                <input type="text" name="share_code" class="form-control" id="share_code" value="{{ old('share_code') }}">
            </div>
            <button type="submit" class="btn btn-success">Add Device</button>
        </form>
    </div>
{{--@endsection--}}
