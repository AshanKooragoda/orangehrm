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
 * Class AuthenticateVerifyServiceTest
 * @group maintenance
 */
class MaintenanceServiceTest extends PHPUnit_Framework_TestCase
{
    protected $fixture;
    private $maintenanceService;

    /**
     *
     */
    protected function setUp()
    {
        $this->maintenanceService = new MaintenanceService();
        $this->fixture = sfConfig::get('sf_plugins_dir') . '/orangehrmMaintenancePlugin/test/fixtures/EmployeeDaoWithDeletedEmployee.yml';
        TestDataService::populate($this->fixture);
    }

    /**
     * @return EmployeeService
     */
    public function getEmployeeService()
    {
        if (!isset($this->employeeService)) {
            $this->employeeService = new EmployeeService();
        }
        return $this->employeeService;
    }

    /**
     * @throws DaoException
     */
    public function testReplaceEntityValues()
    {
        $employeeNum = 1;
        $matchByValuesArray = array(
            "empNumber" => 1
        );
        $entityClassName = 'Employee';
        $fieldValueArray = array(
            'firstName' => 'Purge',
            'lastName' => 'Purge',
            'middleName' => '',
            'nickName' => '',
        );
        $employee1 = $this->getEmployeeService()->getEmployee($employeeNum);
        $this->assertEquals($employee1->getFirstName(), 'Kayla');
        $this->assertEquals($employee1->getLastName(), 'Abbey');
        $this->assertEquals($employee1->getMiddleName(), 'T');
        $this->assertEquals($employee1->getNickName(), 'viki');

        $this->maintenanceService->replaceEntityValues($entityClassName, $fieldValueArray, $matchByValuesArray);
        $data = $this->getEmployeeService()->getEmployee($employeeNum);

        $this->assertEquals($data->getFirstName(), 'Purge');
        $this->assertEquals($data->getLastName(), 'Purge');
        $this->assertEquals($data->getMiddleName(), '');
        $this->assertEquals($data->getNickName(), '');
    }

    /**
     * @throws DaoException
     */
    public function testRemoveEntities (){
        $employeeNum = 1;
        $matchByValuesArray = array(
            "empNumber" => 1
        );
        $entityClassName = 'Employee';
        $employee1 = $this->getEmployeeService()->getEmployee($employeeNum);
        $this->assertEquals($employee1->getFirstName(), 'Kayla');
        $this->assertEquals($employee1->getLastName(), 'Abbey');
        $this->assertEquals($employee1->getMiddleName(), 'T');
        $this->assertEquals($employee1->getNickName(), 'viki');

        $this->maintenanceService->removeEntities($entityClassName, $matchByValuesArray);
        $data = $this->getEmployeeService()->getEmployee($employeeNum);
        $this->assertEquals($data, null);
    }

    /**
     *
     */
    public function testGetPurgeEmployeeList(){
        $data = $this->maintenanceService->getPurgeEmployeeList();
        $this->assertEquals(gettype($data), 'object');
    }
}
