<?php
namespace In2code\Translation\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Class CustomerRepository
 */
class CustomerRepository extends Repository
{

    /**
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAll()
    {
        return parent::findAll();

        // Example how to change default settings
        //$query = $this->createQuery();
        //$query->getQuerySettings()
        //    ->setRespectStoragePage(false)
        //    ->setStoragePageIds([1,2])
        //    ->setIgnoreEnableFields(true)
        //    ->setEnableFieldsToBeIgnored(['hidden']);
        //$query->setOrderings(['title' => QueryInterface::ORDER_ASCENDING]);
        //return $query->execute();
    }
}
