<?php

class mgrnotificationsCustomerCreateProcessor extends modObjectCreateProcessor
{
    public $classKey = 'customers';
    public $languageTopics = array('mgrnotifications:default');
    public $defaultSortField = 'id';
    public $objectType = 'mgrnotifications.customer';

    /**
     * Override in your derivative class to do functionality before the fields are set on the object
     *
     * @return boolean
     */

    public function beforeSet()
    {
        $string = "mgrnotifications+" . $this->getProperty("Name") . "r8drXD33xsBVUt46w2PRBLv5XTUKhCCdB5TF9DeTpqpeW";
        $this->setProperty('API_key', md5($string));

        return parent::beforeSet();
    }

    /**
     * Override in your derivative class to do functionality before save() is run
     *
     * @return boolean
     */
    public function beforeSave()
    {

        return parent::beforeSave();
    }

    /**
     * Override in your derivative class to do functionality after save() is run
     *
     * @return boolean
     */
    public function afterSave()
    {

        return true;
    }

}

return 'mgrnotificationsCustomerCreateProcessor';