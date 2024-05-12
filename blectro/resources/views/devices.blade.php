<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>blectro | Devices</title>
</head>
<body>
    <h1>Devices</h1>
    @foreach ($devices as $device)
        <h2>{{ $device->nama_device }}</h2>
        <h3>Range value: {{ $device->nilai_min }} - {{ $device->nilai_max }}</h3>
        <p>Current value: {{ $device->nilai }}</p>
    @endforeach
</body>
</html>
