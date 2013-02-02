<?php
/** This file is part of KCFinder project
  *
  *      @desc Browser calling script
  *   @package KCFinder
  *   @version 2.3
  *    @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
  */
$domains = array (
      'logical-admin-dev.cybacat.com',
      'http://localhost/alphaworkwear-direct',
);

// foreach($domains as $domain) {
//     if(!strstr($_SERVER['HTTP_REFERER'],$domain)) {
//         //echo "You do not have permission to access this section of the site.";
//     } else {
//         require "core/autoload.php";
//         $browser = new browser();
//         $browser->action();
//         //break; # seems to cause an error!?!?
//     }
// }

        require "core/autoload.php";
        $browser = new browser();
        $browser->action();
?>