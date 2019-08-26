<?php


namespace App\Services;


use LINE\LINEBot;
use LINE\LINEBot\Response;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder;

class LineBotService
{
    /**
     * @var LINEBot
     */
    private $lineBot;
    /**
     * @var string
     */
    private $lineUserId;

    /**
     * LineBotService constructor.
     * @param string $lineUserId
     * @param LINEBot $lineBot
     */
    public function __construct(string $lineUserId, LINEBot $lineBot)
    {
        if(empty($lineUserId)){
            $this->lineUserId = env('LINE_USER_ID');
        } else {
            $this->lineUserId = $lineUserId;
        }
        $this->lineBot = $lineBot;
    }

    /**
     * @param TemplateMessageBuilder $content
     * @return Response
     */
    public function pushMessage(TemplateMessageBuilder $content): Response
    {
        return $this->lineBot->pushMessage($this->lineUserId, $content);
    }
}
