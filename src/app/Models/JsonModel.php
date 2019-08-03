<?php
declare(strict_types=1);

namespace App\Models;

class JsonModel
{
    protected $json;
    private $data;
    protected $doCount;
    protected $reasonCount;

    public function __construct()
    {
        $url = public_path() . '/json/reason.json';
        $this->json = file_get_contents($url);
        $this->data = json_decode(mb_convert_encoding($this->json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN'), true);
        $this->doCount = count($this->data['do']);
        $this->reasonCount = count($this->data['reason']);
    }

    public function getAll()
    {
        return [
        'do' => $this->getDo(rand(1, $this->doCount)),
        'reason' => $this->getReason(rand(1, $this->reasonCount)),
        ];
    }

    public function getDo(int $id)
    {
        return $this->data['do'][$id];
    }

    public function getReason(int $id)
    {
        return $this->data['reason'][$id];
    }
}