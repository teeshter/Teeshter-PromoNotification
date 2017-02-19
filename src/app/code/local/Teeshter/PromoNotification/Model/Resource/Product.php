<?php

/**
 * Model resource product
 *
 * @category    Teeshter
 * @package     Teeshter_PromoNotification
 * @author      teeshter
 */
class Teeshter_PromoNotification_Model_Resource_Product extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Read DB adapter
     *
     * @var Magento_Db_Adapter_Pdo_Mysql
     */
    private $_readAdapter;


    protected function _construct()
    {
        $this->_readAdapter = Mage::getSingleton('core/resource')->getConnection('core_read');
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
        $select = $this->_readAdapter->select()
            ->from(array('sfo' => 'sales_flat_order'),
                array()
            )
            ->join(array('sfoi' => 'sales_flat_order_item'),
                'sfo.entity_id = sfoi.order_id',
                array(
                    'total' => 'SUM(sfoi.qty_ordered)',
                )
            )
            ->where('sfo.store_id = ?', $storeId)
            ->where('sfoi.product_id = ?', $productId);

        $total = (int)$this->_readAdapter->fetchOne($select);

        return $total;
    }
}
