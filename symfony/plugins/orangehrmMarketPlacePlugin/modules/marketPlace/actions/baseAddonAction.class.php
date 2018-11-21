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

/**
 * Class baseAddonAction
 */
class baseAddonAction extends sfAction
{
    private $marcketplaceService = null;

    /**
     * @param sfRequest $request
     * @return mixed|void
     */
    public function execute($request)
    {
    }

    /**
     * @return MarketplaceService|null
     */
    public function getMarcketplaceService()
    {
        if (!isset($this->marcketplaceService)) {
            $this->marcketplaceService = new MarketplaceService();
        }
        return $this->marcketplaceService;
    }

    /**
     * @return array
     */
    public function getInstalledAddons()
    {
        $installedAddons = $this->getMarcketplaceService()->getInstalledAddonIds();
        return $installedAddons;
    }

    /**
     * @return array
     */
    public function getAddons()
    {
        $linc = array(
            "desc" => "/public/index.php/api/v1/addon/1/detail",
            "file" => "/public/index.php/api/v1/addon/1/file"
        );
        $output = array(
            [
                "id" => 1,
                "name" => "addon1",
                "title" => "Addon title 1",
                "summary" => "summery for addon 1",
                "icon" => "icon_url",
                "date" => "2018-12-01T00:00:00+13:00",
                "links" => $linc
            ],
            [
                "id" => 2,
                "name" => "addon1",
                "title" => "Addon title 2",
                "summary" => "summery for addon 2",
                "icon" => "icon_url",
                "date" => "2018-12-01T00:00:00+13:00",
                "links" => $linc
            ],
            [
                "id" => 3,
                "name" => "addon1",
                "title" => "Addon title 3",
                "summary" => "summery for addon 3",
                "icon" => "icon_url",
                "date" => "2018-12-01T00:00:00+13:00",
                "links" => $linc
            ],
            [
                "id" => 4,
                "name" => "addon1",
                "title" => "Addon title 4",
                "summary" => "summery for addon 4",
                "icon" => "icon_url",
                "date" => "2018-12-01T00:00:00+13:00",
                "links" => $linc
            ],
            [
                "id" => 5,
                "name" => "addon1",
                "title" => "Addon title 5",
                "summary" => "summery for addon 5",
                "icon" => "icon_url",
                "date" => "2018-12-01T00:00:00+13:00",
                "links" => $linc
            ],
            [
                "id" => 6,
                "name" => "addon1",
                "title" => "Addon title 6",
                "summary" => "summery for addon 6",
                "icon" => "icon_url",
                "date" => "2018-12-01T00:00:00+13:00",
                "links" => $linc
            ]
        );
        return $output;
    }
}
