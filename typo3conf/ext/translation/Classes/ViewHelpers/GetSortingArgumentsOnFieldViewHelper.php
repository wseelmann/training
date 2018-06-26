<?php
declare(strict_types=1);
namespace In2code\Translation\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class GetSortingArgumentsOnFieldViewHelper
 */
class GetSortingArgumentsOnFieldViewHelper extends AbstractViewHelper
{

    /**
     * @return void
     */
    public function initializeArguments()
    {
        $this->registerArgument('field', 'string', 'Any fieldname to sort by', true);
    }

    /**
     * @return array
     */
    public function render(): array
    {
        $array = [
            'sorting' => [
                'field' => $this->arguments['field'],
                'order' => $this->getOrderForField($this->arguments['field'])
            ]
        ];
        return $array;
    }

    /**
     * @param string $field
     * @return string
     */
    protected function getOrderForField(string $field): string
    {
        $order = 'DESC';
        $arguments = GeneralUtility::_GP('tx_translation_pi1');
        if (!empty($arguments['sorting']['field']) && $arguments['sorting']['field'] === $field
            && $arguments['sorting']['order'] === 'DESC') {
            $order = 'ASC';
        }
        return $order;
    }
}
