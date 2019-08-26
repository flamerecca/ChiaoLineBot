<?php


namespace App\Http\Controllers;


use App\Services\LineBotService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LineController
{
    /**
     * @var LineBotService
     */
    private $lineBotService;

    /**
     * LineController constructor.
     * @param LineBotService $lineBotService
     */
    public function __construct(LineBotService $lineBotService)
    {
        $this->lineBotService = $lineBotService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function line(Request $request)
    {
        return response('okk');
    }
}
