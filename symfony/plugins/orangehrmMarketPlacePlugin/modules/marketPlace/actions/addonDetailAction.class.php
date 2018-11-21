<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 21/11/18
 * Time: 11:43 AM
 */
 class addonDetailAction extends baseAddonAction {

     public function execute($request)
     {
         var_dump($request->getParameterHolder());die;
     }
 }
