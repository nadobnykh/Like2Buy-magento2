<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Keyreal\Like2buy\Helper;

/**
 * Contact base helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_PAGE_URL = 'keyreal/like2buy/page_url_fb';

    protected $_scopeConfig;
    protected $_fb;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Facebook\Facebook $fb
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->_fb = $fb;
        parent::__construct($context);
    }

    public function getAppId()
    {
        return $this->_fb->getApp()->getId();
    }

    public function getPageUrl()
    {
        return $this->_scopeConfig->getValue(
            self::XML_PATH_PAGE_URL,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getIsLiked()
    {
        $pageUrl = $this->getPageUrl();

        try {
            $pageName = $this->getPageNameByUrl($pageUrl, true);
            $resp = $this->getGraphBody($pageName);
            $id = isset($resp['id']) ? $resp['id'] : null;
            $resp = $this->getGraphBody('/me/likes/'.$id);
            if(isset($resp['data']) && !empty($resp['data'])) return true;
            return false;
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            print_r($e->getMessage());
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            print_r($e->getMessage());
        }
        return false;
    }

    public function getGraphBody($uri)
    {
        $response = $this->_fb->get($uri);
        return $response->getDecodedBody();
    }

    public function getPageNameByUrl($urlCandidate)
    {
        $urlCandidate = trim($urlCandidate);
        $urlCandidate = trim($urlCandidate, '/');
        $urlCandidate = str_replace('https://', '', $urlCandidate);
        $urlCandidate = str_replace('http://', '', $urlCandidate);
        $urlCandidate = str_replace('www.', '', $urlCandidate);
        $urlCandidate = str_replace('facebook.com/', '', $urlCandidate);
        return $urlCandidate;
    }


}
