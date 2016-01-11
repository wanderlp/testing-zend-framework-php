<?php
/**
 *
 * Nuevo módulo "Customer" para asociarlo al proyecto
 * El ModuleManager llama a las funciones getAutoLoaderConfig y getConfig automáticamente.
 *
 */
 
namespace Customer;

use Zend\ModuleManager\Feature\AutoLoaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Customer\Model\Customer;
use Customer\Model\CustomerTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module implements AutoLoaderProviderInterface, ConfigProviderInterface
{
    public function getAutoLoaderConfig()
    {
        return array(
          'Zend\Loader\ClassMapAutoloader' => array(
              __DIR__ . 'autoload_classmap.php'
          ),
          'Zend\Loader\StandardAutoloader' => array(
              'namespaces' => array(
                  __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
              )
          )  
        );
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return array(
             'factories' => array(
                 'Customer\Model\CustomerTable' =>  function($sm) {
                     $tableGateway = $sm -> get('CustomerTableGateway');
                     $table = new CustomerTable($tableGateway);
                     return $table;
                 },
                 'CustomerTableGateway' => function ($sm) {
                     $dbAdapter = $sm -> get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype -> setArrayObjectPrototype(new Customer());
                     return new TableGateway('customer', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
    }
}