<?php
declare(strict_types=1);
namespace In2code\Translation\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class IsTooOldViewHelper
 */
class IsTooOldViewHelper extends AbstractViewHelper
{

    /**
     * @return void
     */
    public function initializeArguments()
    {
        $this->registerArgument('tstamp', \DateTime::class, 'Changedate as DateTime', true);
    }

    /**
     * @return bool
     */
    public function render(): bool
    {
        /** @var \DateTime $changeDate */
        $changeDate = $this->arguments['tstamp'];
        return (time() - $changeDate->getTimestamp()) > 31536000;
    }
}
