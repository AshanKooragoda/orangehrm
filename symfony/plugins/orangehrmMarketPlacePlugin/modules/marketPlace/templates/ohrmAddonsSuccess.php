<?php
/**
 * OrangeHRM is a comprehensive Human Resource Management (HRM) System that captures
 * all the essential functionalities required for any enterprise.
 * Copyright (C) 2006 OrangeHRM Inc., http://www.orangehrm.com
 *
 * OrangeHRM is free software; you can redistribute it and/or modify it under the terms of
 * the GNU General Public License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * OrangeHRM is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA 02110-1301, USA
 */
use_stylesheet(plugin_web_path('orangehrmMarketPlacePlugin', 'css/ohrmAddons.css'));
?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<div class="box">
    <div class="head">
        <h1 id="menu">OrangeHRM Addons</h1>
    </div>
    <div class="inner">
        <?php foreach ($addonList as $addon) { ?>
            <div class="row">
                <div class="inner container" id="addonHolder">
                    <div id="column" class="image">
                        <img class="circle" src="
                        <?php echo plugin_web_path("orangehrmMarketPlacePlugin", "images/SampleJPGImage_500kbmb.jpg"); ?>"/>
                    </div>
                    <div id="column" class="details">
                        <div class="row">
                            <label id="title">Addon title : </label>
                            <label><?php echo __($addon['title']); ?></label>
                        </div>
                        <div class="row">
                            <label id="title">Summary : </label>
                            <label><?php echo __($addon['summary']); ?></label>
                        </div>
                        <div class="row">
                            <label id="title">Released Date: </label>
                            <label><?php echo __($addon['date']); ?></label>
                        </div>
                    </div>
                    <div id="column" class="button">
                        <input type="button" name="Submit" class="btnInstall" id="btn1" value="<?php
                        $ins = $sf_data->getRaw("installedAddons");
                        if (in_array($addon['id'], $ins)) {
                            echo __("Uninstall");
                        } else {
                            echo __("Install");
                        } ?>"/>
                        <input type="button" name="Submit" class="btnDetail" id="btn2"
                               value="<?php echo __('Detail'); ?>"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container"></div>
            </div>
        <?php } ?>
    </div>
</div>

