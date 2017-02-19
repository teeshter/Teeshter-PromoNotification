<?php

/**
 * Model config backend product id
 *
 * @category    Teeshter
 * @package     Teeshter_PromoNotification
 * @author      teeshter
 */
class Teeshter_PromoNotification_Model_Config_Backend_Productid extends Mage_Core_Model_Config_Data
{
    /**
     * Checks if the entered product id belongs to a product
     *
     * @throws Mage_Core_Exception
     */
    protected function _beforeSave()
    {
        $productId = $this->getValue();
        $product = Mage::getModel('catalog/product')->load($productId);

        if (!$product->getId()) {
            Mage::throwException('Please enter a valid product id');
        }

        parent::_beforeSave();
    }
}
