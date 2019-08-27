<?php


namespace App\Services;


use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\Exception\InvalidEventRequestException;
use LINE\LINEBot\Exception\InvalidSignatureException;
use LINE\LINEBot\Response;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\ImageCarouselTemplateBuilder;
use LINE\LINEBot\MessageBuilder;
use LINE\LINEBot\Constant\HTTPHeader;
use ReflectionException;

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
     * @var TemplateMessageBuilder
     */
    private $templateMessageBuilder;

    /**
     * LineBotService constructor.
     * @param string $lineUserId
     * @param LINEBot $lineBot
     */
    public function __construct(string $lineUserId, LINEBot $lineBot)
    {
        $this->lineUserId = $lineUserId;
        $this->lineBot = $lineBot;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws InvalidEventRequestException
     * @throws InvalidSignatureException
     * @throws ReflectionException
     */
    public function pushMessage(Request $request): Response
    {
        $signature = $request->header(HTTPHeader::LINE_SIGNATURE);

        if (empty($signature)) {
            return response('Bad Request', 400);
        }

        $events = $this->lineBot->parseEventRequest($request->getContent(), $signature[0]);
        foreach ($events as $event) {
            if (!$event instanceof MessageEvent) {
                continue;
            }
            if (!$event instanceof TextMessage) {
                continue;
            }
            $replyText = $event->getText();
            $response = $this->lineBot->replyText($event->getReplyToken(), $replyText);
            return $response;
        }
    }
}
