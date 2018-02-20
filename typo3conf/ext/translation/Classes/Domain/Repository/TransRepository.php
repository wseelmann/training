<?php
namespace In2code\Translation\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Class TransRepository
 */
class TransRepository extends Repository
{

    /**
     * @param array $filter
     * @return QueryResultInterface
     */
    public function findByFilter(array $filter)
    {
        $query = $this->createQuery();

        if ($filter !== []) {
            $logicalOr = [
                $query->like('customer', '%' . $filter['searchword'] . '%'),
                $query->like('fromLanguage', '%' . $filter['searchword'] . '%'),
                $query->like('toLanguage', '%' . $filter['searchword'] . '%'),
                $query->like('subjectFrom', '%' . $filter['searchword'] . '%'),
                $query->like('subjectTo', '%' . $filter['searchword'] . '%')
            ];
            $query->matching(
                $query->logicalOr($logicalOr)
            );
        }

        return $query->execute();
    }
}
