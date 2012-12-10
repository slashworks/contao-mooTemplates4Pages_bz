<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Joe Ray Gregory @borowiakziehe KG 2012
 * @author     Joe Ray Gregory @borowiakziehe KG
 * @package    pageAddMooTpl_bz
 * @license    LGPL
 * @filesource
 */

class PageAddMooTpl_bz extends Frontend
{
    /**
     * Hook into the generatePage Hook
     * @param Database_Result $objPage
     * @param Database_Result $objLayout
     * @param PageRegular $objPageRegular
     */
    public function addResToFE(Database_Result $objPage, Database_Result $objLayout, PageRegular $objPageRegular)
    {
        //check if there is some moo templates that should be load
        if($objPage->pageResMoo)
        {
            $mooTemplates = deserialize($objPage->pageResMoo);
            $this->_generateMooTemplates($mooTemplates);
        }
    }

    /**
     * Generates the mootemplates for this page
     * @param $mooTemplates
     */
    private function _generateMooTemplates($mooTemplates)
    {
        foreach($mooTemplates as $tpl)  {
            $generate = new FrontendTemplate($tpl);
            $GLOBALS['TL_MOOTOOLS'][] = $generate->parse();
        }
    }
}