<?php
/**
 * @category    Scandiweb
 * @author      Scandiweb <info@scandiweb.com>
 * @copyright   Copyright (c) 2017 Scandiweb, Inc (http://scandiweb.com)
 * @license     http://opensource.org/licenses/OSL-3.0 The Open Software License 3.0 (OSL-3.0)
 */

namespace Scandiweb\Cronhealth\Cron;

use Exception;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\HTTP\Adapter\Curl;
use Magento\Framework\Logger\Monolog;
use Zend_Uri;

/**
 * Class SendPing
 *
 * @package Scandiweb\Cronhealth\Cron
 */
class SendPing
{
    /**
     * @var ScopeConfigInterface
     */
    protected $storeConfig;

    /**
     * @var Curl
     */
    protected $curlClient;

    /**
     * @var Monolog
     */
    protected $logger;

    public function __construct(
        ScopeConfigInterface $storeConfig,
        Curl $curl,
        Monolog $logger
    ) {
        $this->storeConfig = $storeConfig;
        $this->curlClient = $curl;
        $this->logger = $logger;
    }

    /**
     * Cron entry point
     */
    public function execute()
    {
        if ($this->storeConfig->getValue('cronhealth/general/enabled')) {
            $pingUrl = $this->storeConfig->getValue('cronhealth/general/ping_url');
            if (Zend_Uri::check($pingUrl)) {
                try {
                    $this->curlClient->setConfig(['timeout' => 5]);
                    $this->curlClient->write('GET', $pingUrl);
                    $this->curlClient->read();
                } catch (Exception $e) {
                    $this->logger->addError($e->getMessage());
                }
            }
        }
    }

}
