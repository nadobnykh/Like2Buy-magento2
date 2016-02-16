<?php

namespace Keyreal\Like2buy\Controller\Fb;

class Liked extends \Magento\Framework\App\Action\Action
{
    protected $_dataHelper;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Keyreal\Like2buy\Helper\Data $dataHelper
    ) {
        $this->_dataHelper = $dataHelper;
        parent::__construct($context);
    }

    public function execute()
    {
        echo json_encode(array('result' => $this->_dataHelper->getIsLiked()));
    }
}