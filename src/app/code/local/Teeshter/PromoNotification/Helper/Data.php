<?php

/**
 * Default helper
 *
 * @category    Teeshter
 * @package     Teeshter_PromoNotification
 * @author      teeshter
 */
class Teeshter_PromoNotification_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * XML path to promo notification activation
     */
    const XML_PATH_PROMONOTIFICATION_IS_ACTIVE = 'promonotification/general/is_active';

    /**
     * XML path to email sender address
     */
    const XML_PATH_EMAIL_SENDER_FROM_ADDRESS = 'trans_email/ident_custom1/email';

    /**
     * XML path to email sender name
     */
    const XML_PATH_EMAIL_SENDER_FROM_NAME = 'trans_email/ident_custom1/name';

    /**
     * XML path to email receiver address
     */
    const XML_PATH_EMAIL_RECEIVER_TO_ADDRESS = 'trans_email/ident_custom2/email';

    /**
     * XML path to email receiver name
     */
    const XML_PATH_EMAIL_RECEIVER_TO_NAME = 'trans_email/ident_custom2/name';

    /**
     * Promotion notification email template
     */
    const PROMO_NOTIFICATION_EMAIL_TEMPLATE = 'promo_notification_email_template';


    /**
     * Checks if module is active
     *
     * @return bool Whether active or not
     */
    public function isModuleActive()
    {
        return Mage::getStoreConfig(self::XML_PATH_PROMONOTIFICATION_IS_ACTIVE);
    }

    /**
     * Sends transactional email
     *
     * @param array $emailBodyData The email body data
     */
    public function sendTransactionalEmail($emailBodyData)
    {
        $emailTemplate = Mage::getModel('core/email_template')->loadDefault(self::PROMO_NOTIFICATION_EMAIL_TEMPLATE);
        $emailTemplate->setSenderEmail(Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER_FROM_ADDRESS));
        $emailTemplate->setSenderName(Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER_FROM_NAME));
        $emailTemplate->send(Mage::getStoreConfig(self::XML_PATH_EMAIL_RECEIVER_TO_ADDRESS), Mage::getStoreConfig(self::XML_PATH_EMAIL_RECEIVER_TO_NAME), $emailBodyData);
    }
}
