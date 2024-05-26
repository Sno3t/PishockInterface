<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index(): View
    {
        $devices = Device::paginate(10);
        return view('devices.index', ['devices' => $devices]);
    }

    public function create()
    {
        return view('devices.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'device_name' => 'required',
            'share_code' => 'required',
        ]);

        Device::create($request->all());

        return redirect()->route('devices.index')->with('status', 'Device added successfully!');
    }

    public function edit(Device $device)
    {
        return view('devices.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $request->validate([
            'device_name' => 'required',
            'share_code' => 'required',
        ]);

        $device->update($request->all());

        return redirect()->route('devices.index')->with('status', 'Device updated successfully');
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.index')->with('status', 'Device deleted successfully');
    }
}
