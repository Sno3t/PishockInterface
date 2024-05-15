<?php


namespace App\Http\Controllers;


use App\Enums\Operations;
use App\Http\Requests\OperationRequest;
use App\Models\Device;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class PishockController extends Controller
{
    protected string $baseUrl = 'https://do.pishock.com/api/apioperate';
    protected string $username;
    protected string $apiKey;
    protected string $name;
    private array $devices;

    public function __construct()
    {
        $this->username = config('pishock.username');
        $this->apiKey = config('pishock.apikey');
        $this->name = 'Pishock interface';
        $this->devices = Device::all()->pluck('device_name', 'share_code')->toArray();
    }

    public function index(): View
    {
        return view('pishock', ['devices' => $this->devices]);
    }

    /**
     * @param OperationRequest $request
     * @return RedirectResponse
     */
    public function sendCommand(OperationRequest $request): RedirectResponse
    {
        $operation = $request->input('operation');
        $duration = $request->input('duration');
        $intensity = $request->input('intensity');

        $response = match ($operation) {
            'shock' => $this->sendRequest(Operations::SHOCK, $duration, $intensity),
            'vibrate' => $this->sendRequest(Operations::VIBRATE, $duration, $intensity),
            'beep' => $this->sendRequest(Operations::BEEP, $duration),
            default => 'Invalid operation',
        };

        return redirect()->back()->with('response', $response);
    }

    /**
     * @param string $operation
     * @param int $duration
     * @param int|null $intensity
     * @return string|null
     */
    protected function sendRequest(string $operation, int $duration, array $deviceShareCodes, ?int $intensity = null): ?string
    {
        try {
            $client = new Client();

            $operations = [];

            foreach ($deviceShareCodes as $device){
                $params = [
                    'Username' => $this->username,
                    'Name' => $this->name,
                    'Code' => $this->shareCode,
                    'Apikey' => $this->apiKey,
                    'Op' => $operation,
                    'Duration' => $duration,
                ];

                if ($intensity !== null) {
                    $params['Intensity'] = $intensity;
                }

                $operations[] = $params;
            }


            $responses = [];

            foreach ($operations as $operation){
                $response[] = $client->post($this->baseUrl, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode($operation),
                ]);
            }


//            return $response->getBody()->getContents();
        } catch (GuzzleException $e) {
            Log::error($e);
        }
        return null;
    }

}
