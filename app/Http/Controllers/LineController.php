<?php


namespace App\Http\Controllers;


use App\Services\LineBotService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
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
     * @return string
     */
    public function line(Request $request)
    {
        dd(
            config('app.line_user_id'),
            config('app.linebot_token'),
            config('app.linebot_secret')
        );
        return $this->LINEBot->pushMessage(config('app.line_user_id'), new TextMessageBuilder('aaa'))->getRawBody();
    }
}
