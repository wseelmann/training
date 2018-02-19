<?php
namespace In2code\Translation\Controller;

/***
 *
 * This file is part of the "translation" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018 Alex Kellne <alexander.kellner@in2code.de>, in2code GmbH
 *
 ***/

/**
 * TransController
 */
class TransController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * transRepository
     *
     * @var \In2code\Translation\Domain\Repository\TransRepository
     * @inject
     */
    protected $transRepository = null;

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $trans = $this->transRepository->findAll();
        $this->view->assign('trans', $trans);
    }
}
