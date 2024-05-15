<?php


namespace App\Http\Controllers;


use App\Enums\Operations;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class PishockController extends Controller
{
    protected string $baseUrl = 'https://do.pishock.com/api/apioperate';
    protected string $username;
    protected string $apiKey;
    protected string $shareCode;
    protected string $name;

    public function __construct()
    {
        $this->username = config('pishock.username');
        $this->apiKey = config('pishock.apikey');
        $this->shareCode = 'share code';
        $this->name = 'Pishock interface';
    }

    public function index(): View
    {
        return view('pishock');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendCommand(Request $request): RedirectResponse
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
    protected function sendRequest(string $operation, int $duration, ?int $intensity = null): ?string
    {
        try {
            $client = new Client();
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


            $response = $client->post($this->baseUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode($params),
            ]);

            return $response->getBody()->getContents();
        } catch (GuzzleException $e) {
            Log::error($e);
        }
        return null;
    }

}
