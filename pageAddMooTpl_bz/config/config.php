<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jrgregory
 * Date: 05.12.12
 * Time: 16:02
 * To change this template use File | Settings | File Templates.
 */

$GLOBALS['TL_HOOKS']['generatePage'][] = array('PageAddMooTpl_bz', 'addResToFE');