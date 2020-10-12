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


class mgrnotificationsNotificationRetrieveProcessor extends modObjectGetListProcessor {
    public $classKey = 'notifications';
    public $languageTopics = array('mgrnotifications:default');
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'DESC';

    /**
     * {@inheritDoc}
     * @return mixed
     */
    public function process() {
        $url = $this->modx->getOption('mgrnotifications_service_url', null);
        $token = $this->modx->getOption('mgrnotifications_client_key', null);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "token: $token",
                "Content-Type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $http_status = (string) curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);

        if ($http_status !== "200"){
            return $this->failure("http status " . $http_status . " : " . $error);
        } else {
            $objects = json_decode($response, true);
            return $this->outputArray($objects,count($objects));
        }
    }

}
return 'mgrnotificationsNotificationRetrieveProcessor';










