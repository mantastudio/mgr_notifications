<?php
/**
 * notification_module snippet for mgrnotifications extra
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
 */

/**
 * Description
 * -----------
 * [[+description]]
 *
 * Variables
 * ---------
 * @var $modx modX
 * @var $scriptProperties array
 *
 * @package mgrnotifications
 **/

$modx->addPackage('mgrnotifications',MODX_CORE_PATH.'components/mgrnotifications/model/');
if ($modx->lexicon) {
    $modx->lexicon->load('mgrnotifications:default');
}

$headers = apache_request_headers();
$contact = $modx->getOption("default_message_cointact", null, '');
$customer = $modx->getObject('customers', array(
    'API_key' => $headers['Token'],
    'Status' => 1,
));

if ($customer){
    $query = $modx->newQuery('notifications');
    $query->where(array('Customer_id' => $customer->get('id'), 'Published' => 1));
    $query->sortby('Created','DESC');
    $query->limit(1);

    $notification = $modx->getObject('notifications', $query);

    if ($notification){
        $data = array();
        if ( is_null($notification->get('Expiry')) || time() < strtotime($notification->get('Expiry')) ){
            $data[] = array(
                'Title' => $notification->get('Title'),
                'Message' => $notification->get('Message') . ' ' . $contact,
                'Class' => $notification->get('Class'),
            );
            if ( is_null($notification->get('First_delivery')) ){
                $notification->set('First_delivery', date("Y-m-d H:i:s"));
            }
            $notification->set('Last_delivery', date("Y-m-d H:i:s"));
            $notification->save();
            return json_encode($data);
        }else{
            $notification->set('Published', 0);
            $notification->save();
        }
    }
}
http_response_code(404);
return;