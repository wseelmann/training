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
     * @param array $settings
     * @return QueryResultInterface
     */
    public function findByFilter(array $filter, array $sorting, array $settings): QueryResultInterface
    {
        $query = $this->createQuery();
        $this->addFilterQuery($filter, $query);
        $this->addOrder($query, $sorting, $settings);
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
     * @param array $settings
     * @return void
     */
    protected function addOrder(QueryInterface $query, array $sorting, array $settings)
    {
        if ($sorting !== []) {
            $this->checkForAllowedOrderings($sorting);
            $query->setOrderings([
                $sorting['field'] => $sorting['order']
            ]);
        } else {
            $query->setOrderings([
                $settings['sorting']['field'] => $settings['sorting']['order']
            ]);
        }
    }

    /**
     * @param array $sorting
     * @return void
     */
    protected function checkForAllowedOrderings(array $sorting)
    {
        $fields = [
            'customer',
            'fromLanguage',
            'toLanguage',
            'subjectFrom',
            'subjectTo'
        ];
        if (!in_array($sorting['field'], $fields)) {
            throw new \UnexpectedValueException('Not allowed field for sorting', 1519144467);
        }
        $order = [
            'ASC',
            'DESC'
        ];
        if (!in_array($sorting['order'], $order)) {
            throw new \UnexpectedValueException('Not allowed order for sorting', 1519144526);
        }
    }
}
