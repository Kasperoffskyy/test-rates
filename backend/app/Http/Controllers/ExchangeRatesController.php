<?php

namespace App\Http\Controllers;

use App\Http\Resources\RateResource;
use App\Http\Resources\RatesResource;
use App\Rate;
use App\Services\RatesService;
use Illuminate\Http\Request;

class ExchangeRatesController extends Controller
{

    /**
     * @var RatesService
     */
    protected RatesService $rates;

    /**
     * @param RatesService $rates
     */
    public function __construct(RatesService $rates)
    {
        $this->rates = $rates;
    }

    /**
     * @param string $date
     * @param string|null $code
     * @return RateResource|RatesResource
     */
    public function getRateByDate(string $date, ?string $code = null)
    {
        if ($code) {
            return new RateResource(
                $this->rates->getRate($date, $code)
            );
        }
        return new RatesResource(
            $this->rates->getRates($date)
        );
    }

    /**
     * @param Request $request
     * @param Rate $rate
     * @return RateResource
     */
    public function setNote(Rate $rate, Request $request): RateResource
    {
        $rate->note = $request->note;
        $rate->save();
        return new RateResource($rate);
    }

}
