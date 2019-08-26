<?php


namespace App\Http\Controllers;


use App\Services\LineBotService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class LineController
{
    /**
     * @var LineBotService
     */
    private $lineBotService;

    /**
     * @var LINEBot
     */
    private $LINEBot;

    /**
     * LineController constructor.
     * @param LineBotService $lineBotService
     * @param LINEBot $LINEBot
     */
    public function __construct(LineBotService $lineBotService, LINEBot $LINEBot)
    {
        $this->lineBotService = $lineBotService;
        $this->LINEBot = $LINEBot;
    }

    /**
     * @param Request $request
     * @return LINEBot\Response
     */
    public function line(Request $request)
    {
        return $this->LINEBot->pushMessage(env('LINE_USER_ID'), new TextMessageBuilder('aaa'));
    }
}
