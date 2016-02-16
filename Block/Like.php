<?php 

namespace Keyreal\Like2buy\Block;

class Like extends \Magento\Catalog\Block\Product\View\AbstractView {


    protected $_dataHelper;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Stdlib\ArrayUtils $arrayUtils,
        array $data = [],
        \Keyreal\Like2buy\Helper\Data $dataHelper
    ) {
        $this->_dataHelper = $dataHelper;
        parent::__construct($context, $arrayUtils, $data);
    }

    public function getAppId()
    {
        return $this->_dataHelper->getAppId();
    }

    public function getControllerUrl()
    {
        return $this->getUrl('like2buy/fb/liked', ['_secure' => $this->getRequest()->isSecure()]);
    }

    public function getPageUrl()
    {
        return $this->_dataHelper->getPageUrl();
    }

    public function getIsLiked()
    {
        return $this->_dataHelper->getIsLiked();
    }
}