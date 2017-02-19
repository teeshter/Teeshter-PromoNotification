<?php

/**
 * Model product
 *
 * @category    Teeshter
 * @package     Teeshter_PromoNotification
 * @author      teeshter
 */
class Teeshter_PromoNotification_Model_Product extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('teeshter_promonotification/product');
    }

    /**
     * Gets the total quantity ordered
     *
     * @param int $storeId The store id
     * @param int $productId The product id
     *
     * @return int The total
     */
    public function getTotalQtyOrdered($storeId, $productId)
    {
        return $this->_getResource()->getTotalQtyOrdered($storeId, $productId);
    }
}
