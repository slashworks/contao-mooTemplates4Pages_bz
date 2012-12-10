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


/**
 * ExtendTable tl_page
 */

$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace(
    ';{tabnav_legend:hide}',
    ',pageResMoo;{tabnav_legend:hide}',
    $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']
);

/**
 * add new field
 */

$GLOBALS['TL_DCA']['tl_page']['fields']['pageResMoo'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_page']['pageResMoo'],
    'exclude'                 => true,
    'inputType'               => 'checkboxWizard',
    'options_callback'        => array('bepageAddMooTpl_bz', 'getMooTemplates'),
	'eval'                    => array('multiple'=>true, 'tl_class'=>'clr long')
);

class bepageAddMooTpl_bz extends Backend
{
    /**
     * get all moo templates wich are not already included via the layout
     * @param $varValue
     * @return array
     */
    public function getMooTemplates($varValue) {
        // Import PageSniffer helper class
        $this->import('PageThemeSniffer');

        //find the current Layout
        $curTheme = $this->PageThemeSniffer->findThemeData($varValue);

        $_layout = $curTheme->layout;
        $_theme = $curTheme->theme;

        //get the tl_layout database object
        $layoutObj = $this->Database->prepare('SELECT mootools FROM tl_layout WHERE id=?')->execute($_layout->id);

        //get all in current layout used moo templates
        $selectedLayoutMooFiles = deserialize($layoutObj->mootools);

        //get mootemplates of the layout
        $allThemeMooFiles = $this->getTemplateGroup('moo_', $_theme->id);

        // Resort
        $unusedTemplates = array_diff($allThemeMooFiles, $selectedLayoutMooFiles);

        return array_merge($unusedTemplates);
    }
}