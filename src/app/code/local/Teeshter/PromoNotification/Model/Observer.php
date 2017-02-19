<?php

/**
 * Model observer
 *
 * @category    Teeshter
 * @package     Teeshter_PromoNotification
 * @author      teeshter
 */
class Teeshter_PromoNotification_Model_Observer
{
    /**
     * XML path to promo product id
     */
    const XML_PATH_PROMONOTIFICATION_PROMO_PRODUCT_ID = 'promonotification/general/promo_product_id';

    /**
     * Checks the promo item set for all stores to see how many were ordered
     */
    public function checkAllStoresPromoItemTotalQtyOrdered()
    {
        if (Mage::helper('teeshter_promonotification')->isModuleActive()) {
            $stores = Mage::app()->getStores();

            foreach ($stores as $store) {
                $this->_checkSingleStorePromoItemTotalQtyOrdered($store);
            }
        }
    }

    /**
     * Checks the promo item set for a single store to see how many were ordered
     *
     * @param Mage_Core_Model_Store $store The store
     */
    private function _checkSingleStorePromoItemTotalQtyOrdered($store)
    {
        Mage::app()->setCurrentStore($store->getId());

        $productId = Mage::getStoreConfig(self::XML_PATH_PROMONOTIFICATION_PROMO_PRODUCT_ID);

        $emailBodyData = array(
            'store_name' => $store->getName(),
            'product_id' => $productId,
            'error' => 'none',
        );

        try {
            $totalQtyOrdered = Mage::getModel('teeshter_promonotification/product')
                ->getTotalQtyOrdered($store->getId(), $productId);

            $emailBodyData['total_qty_ordered'] = $totalQtyOrdered;
        } catch (Mage_Core_Exception $e) {
            $emailBodyData['error'] = $e->getMessage();
        } finally {
            Mage::helper('teeshter_promonotification')->sendTransactionalEmail($emailBodyData);
        }
    }
}
