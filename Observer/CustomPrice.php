<?php

/**
 * @Author: Ngo Quang Cuong
 * @Date:   2017-06-25 13:26:41
 * @Last Modified by:   nquangcuong
 * @Last Modified time: 2017-06-25 13:28:14
 * @website: http://giaphugroup.com
 */

namespace PHPCuong\Customer\Observer;

use Magento\Framework\Event\ObserverInterface;

class CustomPrice implements ObserverInterface
{
    /**
     * Handler for 'checkout_cart_product_add_after' event.
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $item = $observer->getEvent()->getData('quote_item');
        $item = ($item->getParentItem() ? $item->getParentItem() : $item);
        $price = $item->getProduct()->getPriceInfo()->getPrice('final_price')->getValue();
        $new_price = $price - ($price * 50 / 100); //discount the price of the product to 50%
        $item->setCustomPrice($new_price);
        $item->setOriginalCustomPrice($new_price);
        $item->getProduct()->setIsSuperMode(true);
    }
}
