<?php
namespace LeonhardBolschakow\LbOsm\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Leonhard Bolschakow <leonhard@bolschakow.de>, Leonhard Bolschakow
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use LeonhardBolschakow\LbOsm\Domain\Model\OSM;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * OSMController
 */
class OSMController extends ActionController
{
    /**
     * oSMRepository
     *
     * @var \LeonhardBolschakow\LbOsm\Domain\Repository\oSMRepository
     * @inject
     */
    protected $oSMRepository = NULL;


    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        // $oSMs = $this->oSMRepository->findAll();
        // $this->view->assign('oSMs', $oSMs);

        // DebuggerUtility::var_dump($this->settings,'Settings');
        // DebuggerUtility::var_dump($this->request,'Request');

        // $_path = ExtensionManagementUtility::extPath('lb_osm');
        $_path = ExtensionManagementUtility::siteRelPath('lb_osm');

        if($this->settings['flexForm']['MapTyp'] == 1){
            $GLOBALS['TSFE']->additionalHeaderData['lb_osm'] = '<link rel="stylesheet" type="text/css" href="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.css" media="all"><link rel="stylesheet" type="text/css" href="'.$_path.'Resources/Public/Css/Leaflet.css" media="all">';
            $GLOBALS['TSFE']->additionalFooterData['lb_osm'] = '<script src="https://npmcdn.com/leaflet@1.0.0-rc.3/dist/leaflet.js" type="text/javascript"></script><script src="'.$_path.'Resources/Public/Js/MyScriptLeaflet.js" type="text/javascript"></script>';
        }

        if($this->settings['flexForm']['MapTyp'] == 2){
            $GLOBALS['TSFE']->additionalHeaderData['lb_osm'] = '<link rel="stylesheet" type="text/css" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" media="all"><link rel="stylesheet" type="text/css" href="'.$_path.'Resources/Public/Css/Leaflet.css" media="all">';
            $GLOBALS['TSFE']->additionalFooterData['lb_osm'] = '<script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script><script src="http://maps.google.com/maps/api/js?v=3.2&sensor=false"></script><script src="'.$_path.'Resources/Public/Js/PluginsLeafetGoogle.js"></script><script src="'.$_path.'Resources/Public/Js/MyScriptLeaflet.js"></script>';
        }
    }

    /**
     * action show
     *
     * @param \LeonhardBolschakow\LbOsm\Domain\Model\OSM $oSM
     * @return void
     */
    public function showAction(\LeonhardBolschakow\LbOsm\Domain\Model\OSM $oSM)
    {
        $this->view->assign('oSM', $oSM);
    }

}
