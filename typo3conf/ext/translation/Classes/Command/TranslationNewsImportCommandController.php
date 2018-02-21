<?php
declare(strict_types=1);
namespace In2code\Translation\Command;

use In2code\Translation\Domain\Repository\RssRepository;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

/**
 * Class TranslationNewsImportCommandController
 */
class TranslationNewsImportCommandController extends CommandController
{

    /**
     * CommandController for RSS import
     *
     * @param string $url URL to import RSS from
     * @return void
     */
    public function importCommand(string $url = 'https://www.evs-translations.com/blog/feed/')
    {
        $rssRepository = $this->objectManager->get(RssRepository::class);
        $items = $rssRepository->getRssProperties($url);

        $message = 'Successfully imported!';
        $this->addMessage($message, 'Success');
        $this->outputLine($message);
    }

    /**
     * @param $message
     * @param string $title
     * @param int $severity
     * @return void
     */
    protected function addMessage($message, $title = '', $severity = FlashMessage::OK)
    {
        $message = GeneralUtility::makeInstance(
            FlashMessage::class,
            $message,
            $title,
            $severity
        );
        $flashMessageService = $this->objectManager->get(FlashMessageService::class);
        $messageQueue = $flashMessageService->getMessageQueueByIdentifier();
        $messageQueue->enqueue($message);
    }
}
