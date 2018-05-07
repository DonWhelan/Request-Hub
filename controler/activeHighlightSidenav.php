<?php

    /*
     * sets the active highlight on the side nave based on what is in the URL
     */
     
    $url =  $_SERVER['REQUEST_URI'];
    $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
    
    $dashboardActive = "";
    $inboxActive = "";
    $requestsActive = "";
    $cAndEActive = "";
    $customersActive = "";
    $teamsActive = "";
    $reposrtsActive = "";
    $reposrtsProfile = "";
    
    if (strpos($escaped_url, 'dashboard') !== false) {
        $dashboardActive = 'active';
    }
    if (strpos($escaped_url, 'inbox') !== false) {
        $inboxActive = 'active';
    }
    if (strpos($escaped_url, 'request') !== false) {
        $requestsActive = 'active';
    }
    if (strpos($escaped_url, 'create-edit') !== false) {
        $cAndEActive = 'active';
    }
    if (strpos($escaped_url, 'customers') !== false) {
        $customersActive = 'active';
    }
    if (strpos($escaped_url, 'team') !== false) {
        $teamsActive = 'active';
    }
    if (strpos($escaped_url, 'reports') !== false) {
        $reposrtsActive = 'active';
    }
    if (strpos($escaped_url, 'profile') !== false) {
        $reposrtsProfile = 'active';
    }
?>