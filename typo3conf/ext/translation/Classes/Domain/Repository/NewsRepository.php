<?php
namespace In2code\Translation\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Class NewsRepository
 */
class NewsRepository extends Repository
{

    /**
     * @param string $link
     * @param int $pageId
     * @return bool
     */
    public function isExistingByLinkAndPageId(string $link, int $pageId): bool
    {
        return $this->getByLinkAndPageId($link, $pageId)->count() > 0;
    }

    /**
     * @param string $link
     * @param int $pageId
     * @return null|QueryResultInterface
     */
    public function getByLinkAndPageId(string $link, int $pageId)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()
            ->setRespectStoragePage(false)
            ->setStoragePageIds([$pageId]);
        $query->matching($query->equals('link', $link));
        return $query->execute();
    }
}
