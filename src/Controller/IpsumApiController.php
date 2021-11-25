<?php

namespace KnpU\LoremIpsumBundle\Controller;
use KnpU\LoremIpsumBundle\KnpUIpsum;
use KnpU\LoremIpsumBundle\Event\FilterApiResponseEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class IpsumApiController extends AbstractController
{
    /**
     * @var KnpUIpsum
     */
    private $knpUIpsum;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(KnpUIpsum $knpUIpsum, EventDispatcherInterface $eventDispatcher)
    {

        $this->knpUIpsum = $knpUIpsum;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function index()
    {
        $data = [
            'paragraphs' => $this->knpUIpsum->getParagraphs(),
            'sentences' => $this->knpUIpsum->getSentences()
        ];

        $event = new FilterApiResponseEvent($data);
        if($this->eventDispatcher){
            $this->eventDispatcher->dispatch($event, 'knpu_lorem_ipsum.filter_api');
        }

        return $this->json($event->getData());
    }
}