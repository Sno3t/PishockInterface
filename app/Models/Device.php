<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'device_name',
        'share_code',
    ];


    private string $name;

    private string $username;

    private string $apiKey;

    private string $shareCode;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getShareCode(): string
    {
        return $this->shareCode;
    }

    /**
     * @param string $shareCode
     */
    public function setShareCode(string $shareCode): void
    {
        $this->shareCode = $shareCode;
    }


}
