<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\JsonModel;

class GenerateService
{
    protected $model;

    public function __construct(JsonModel $model)
    {
        $this->model = $model;
    }
    /**
     * @param array $request
     * @return array
     */
    public function execute(array $request): array
    {
        // リクエストからそれぞれのvalue取得　
        $time = $request['time'];
        $place = $request['place'];
        $person = $request['person'];
        // jsonデータ取得
        $jsonData = $this->model->getAll();

        $array = [
            '0' => "おはようございます。ミサワです。",
            '1' => $place . "で" . $jsonData['do'] . "、",
            '2' => $person . "が",
            '3' => $jsonData['reason'] . "ため、",
            '4' => "本日は" . $time . "遅れます。",
        ];

        return $array;
    }
}
