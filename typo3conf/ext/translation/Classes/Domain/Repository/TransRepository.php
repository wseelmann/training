<?php
namespace In2code\Translation\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Class TransRepository
 */
class TransRepository extends Repository
{

    /**
     * @param array $filter
     * @param array $sorting
     * @return QueryResultInterface
     */
    public function findByFilter(array $filter, array $sorting): QueryResultInterface
    {
        $query = $this->createQuery();
        $this->addFilterQuery($filter, $query);
        $this->addOrder($query, $sorting);
        return $query->execute();
    }

    /**
     * @param array $filter
     * @param QueryInterface $query
     * @return void
     */
    protected function addFilterQuery(array $filter, QueryInterface $query)
    {
        if ($this->isAnyFilterSet($filter)) {
            $logicalAnd = [];
            if (!empty($filter['searchword'])) {
                $logicalOr = [
                    $query->like('customer', '%' . $filter['searchword'] . '%'),
                    $query->like('fromLanguage', '%' . $filter['searchword'] . '%'),
                    $query->like('toLanguage', '%' . $filter['searchword'] . '%'),
                    $query->like('subjectFrom', '%' . $filter['searchword'] . '%'),
                    $query->like('subjectTo', '%' . $filter['searchword'] . '%')
                ];
                $logicalAnd[] = $query->logicalOr($logicalOr);
            }
            if (!empty($filter['from'])) {
                $logicalAnd[] = $query->equals('fromLanguage', $filter['from']);
            }
            $query->matching($query->logicalAnd($logicalAnd));
        }
    }

    /**
     * @param array $filter
     * @return bool
     */
    protected function isAnyFilterSet(array $filter): bool
    {
        return !empty($filter['searchword']) || !empty($filter['from']);
    }

    /**
     * @param QueryInterface $query
     * @param array $sorting
     * @return void
     */
    protected function addOrder(QueryInterface $query, array $sorting)
    {
        if ($sorting !== []) {
            $query->setOrderings([
                $sorting['field'] => $sorting['order']
            ]);
        } else {
            $query->setOrderings([
                'subjectFrom' => QueryInterface::ORDER_ASCENDING,
                'subjectTo' => QueryInterface::ORDER_ASCENDING
            ]);
        }
    }
}
