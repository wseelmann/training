<?php
namespace In2code\Translation\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class RssRepository
 */
class RssRepository
{
    /**
     * @param string $url
     * @return array
     */
    public function getRssProperties(string $url): array
    {
        $feed = [];
        $rss = GeneralUtility::getUrl($url);
        $xml = simplexml_load_string($rss, null, LIBXML_NOCDATA);
        $items = $this->convertXmlToArray($xml->channel);
        foreach ($items as $item) {
            $feed[] = [
                'title' => $item['title'],
                'description' => $item['description'],
                'link' => $item['link'],
                'date' => $item['pubDate']
            ];
        }
        return $feed;
    }

    /**
     * @param \SimpleXMLElement[] $xml
     * @return array
     */
    protected function convertXmlToArray($xml): array
    {
        $json = json_encode($xml);
        $array = json_decode($json, true);
        return $array['item'];
    }
}
