<?php
/**
 * Processor file for mgrnotifications extra
 *
 * Copyright 2020 by Sinisa Vrhovac https://github.com/mantastudio/
 * Created on 28-09-2020
 *
 * mgrnotifications is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * mgrnotifications is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * mgrnotifications; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package mgrnotifications
 * @subpackage processors
 */

/* @var $modx modX */


class mgrnotificationsNotificationGetlistProcessor extends modObjectGetListProcessor {
    public $classKey = 'notifications';
    public $languageTopics = array('mgrnotifications:default');
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';


    /**
     * Can be used to adjust the query prior to the COUNT statement
     *
     * @param xPDOQuery $c
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c) {
        $c->leftJoin('customers', 'customers', array('`notifications`.`Customer_id` = `customers`.`id`'));
        $c->select([
            '`notifications`.`id` AS `id`',
            '`notifications`.`Customer_id` AS `Customer_id`',
            '`customers`.`Name` AS `Name`',
            '`notifications`.`Title` AS `Title`',
            '`notifications`.`Message` AS `Message`',
            '`notifications`.`Class` AS `Class`',
            '`notifications`.`Published` AS `Published`',
            '`notifications`.`Created` AS `Created`',
            '`notifications`.`Expiry` AS `Expiry`',
            '`notifications`.`Author` AS `Author`',
            '`notifications`.`First_delivery` AS `First_delivery`',
            '`notifications`.`Last_delivery` AS `Last_delivery`'
        ]);

        $query = $this->getProperty('query');
        if(!empty($query)) {
            $c->andCondition(array(
                'Title:LIKE' => '%'.$query.'%',
                'OR:Message:LIKE' => '%'.$query.'%',
                'OR:Class:LIKE' => '%'.$query.'%'
            ));
        }

        return $c;
    }
}
return 'mgrnotificationsNotificationGetlistProcessor';
