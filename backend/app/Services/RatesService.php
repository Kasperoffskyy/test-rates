<?php

namespace App\Services;

use App\Day;
use App\Rate;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RatesService
{
    /**
     * @param string $date
     * @param string|null $code
     * @return Rate
     */
    public function getRate(string $date, ?string $code = null): Rate
    {
        $day = Day::updateOrCreate(['date' => Carbon::parse($date)]);
        $code = strtoupper($code);
        $rate = $day->rate()
            ->findByCode($code)
            ->firstOrNew(['code' => $code]);
        if (!$rate->value) {
            foreach ($this->getCbrData($date)['Valute'] as $item) {
                if ($item['CharCode'] === $code) {
                    $rate->name = $item['Name'];
                    $rate->value = $item['Value'];
                    if (request()->save){
                        $rate->save();
                    }
                    break;
                }
            }
        }
        return $rate;
    }

    /**
     * @param string $date
     * @return Collection
     */
    public function getRates(string $date): Collection
    {
        $day = Day::where(['date' => Carbon::parse($date)])->firstOrFail();
        return $day->rates()->get();
    }

    /**
     * @param string $date
     * @return array
     */
    private function getCbrData(string $date): array
    {
        return Cache::remember('rates-' . $date, 86400, function () use ($date) {
            try {
                $xml = simplexml_load_file(config('cbr.api_url') . '?date_req=' . Carbon::parse($date)->format('d/m/Y'));
                return json_decode(json_encode($xml), TRUE);
            } catch (Exception $e) {
                Log::info($e->getMessage());
            }
        });
    }

}
