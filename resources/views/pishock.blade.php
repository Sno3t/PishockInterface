<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiShock Controller</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>PiShock Controller</h1>
    @if (session('response'))
        <div class="alert alert-info">{{ session('response') }}</div>
    @endif
    <form method="POST" action="{{ route('pishock') }}">
        @csrf
        <div class="mb-3">
            <label>Devices: </label>
            <select class="form-select" id="devices" name="devices[]" multiple required>
                @foreach ($devices as $deviceId => $deviceName)
                    <option value="{{ $deviceId }}">{{ $deviceName }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="operation" class="form-label">Operation</label>
            <select class="form-select" id="operation" name="operation" required>
                <option value="">Select Operation</option>
                <option value="shock">Shock</option>
                <option value="vibrate">Vibrate</option>
                <option value="beep">Beep</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Duration (seconds)</label>
            <input type="number" class="form-control" id="duration" name="duration" min="1" max="15" required>
        </div>
        <div class="mb-3" id="intensity-group">
            <label for="intensity" class="form-label">Intensity</label>
            <input type="number" class="form-control" id="intensity" name="intensity" min="1" max="100">
        </div>
        <button type="submit" class="btn btn-primary">Send Command</button>
    </form>
</div>

<script>
    const operationSelect = document.getElementById('operation');
    const intensityGroup = document.getElementById('intensity-group');

    operationSelect.addEventListener('change', function () {
        if (this.value === 'shock' || this.value === 'vibrate') {
            intensityGroup.style.display = 'block';
        } else {
            intensityGroup.style.display = 'none';
        }
    });
</script>
</body>
</html>
