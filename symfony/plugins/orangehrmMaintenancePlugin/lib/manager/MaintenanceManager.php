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
 * Class MaintenanceManager
 */
class MaintenanceManager
{

    /**
     * @param $empNumber
     * @throws Doctrine_Connection_Exception
     * @throws Doctrine_Transaction_Exception
     */
    public function purgeEmployee($empNumber)
    {
        $connection = Doctrine_Manager::getInstance()->getCurrentConnection();
        try {
            $connection->beginTransaction();
            $purgeableEntities = $this->getPurgeableEntities();
            foreach ($purgeableEntities as $purgeableEntityClassName => $purgeStrategies) {
                foreach ($purgeStrategies['PurgeStrategy'] as $strategy => $strategyInfoArray) {
                    $strategy = $this->getPurgeStrategy($purgeableEntityClassName, $strategy, $strategyInfoArray);
                    $strategy->purge($empNumber);
                }
            }
            $connection->commit();
            // @codeCoverageIgnoreStart
        } catch (Exception $e) {
            $connection->rollback();
            Logger::getLogger('maintenance')->error($e->getCode() . ' - ' . $e->getMessage(), $e);
            throw new Exception($e->getMessage(), $e->getCode(), $e);
        }
        // @codeCoverageIgnoreEnd
    }


    /**
     * @return array
     */
    public function getPurgeableEntities()
    {
        if (!isset($this->purgeableEntities)) {
            $this->purgeableEntities = sfYaml::load(realpath(dirname(__FILE__) . '/../../config/gdpr_purge_employee_strategy.yml'));
        }
        return $this->purgeableEntities['Entities'];
    }

    /**
     * @param $purgeableEntityClassName
     * @param $strategy
     * @param $strategyInfoArray
     * @return mixed
     */
    public function getPurgeStrategy($purgeableEntityClassName, $strategy, $strategyInfoArray)
    {
        $purgeStrategy = $strategy . "PurgeStrategy";
        return new $purgeStrategy($purgeableEntityClassName, $strategyInfoArray);
    }

}

