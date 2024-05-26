{{--@extends('layouts.app')--}}
{{--@section('content')--}}
    <div class="container">
        <h1>Edit shocker</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('devices.update', $device->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="device_name">Device name</label>
                <input type="text" name="device_name" class="form-control" id="device_name" value="{{ old('device_name', $device->device_name) }}">
            </div>
            <div class="form-group">
                <label for="share_code">Device share code</label>
                <input type="text" name="share_code" class="form-control" id="share_code" value="{{ old('share_code', $device->share_code) }}">
            </div>
            <button type="submit" class="btn btn-success">Update Device</button>
        </form>
    </div>
{{--@endsection--}}
