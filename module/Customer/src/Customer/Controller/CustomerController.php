<?php

/*
 *
 * Mi nuevo controller para gestionar los clientes
 *
 */
 
 namespace Customer\Controller;
 
 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Customer\Model\Customer;
 use Customer\Form\CustomerForm;
 
 class CustomerController extends AbstractActionController
 {
     protected $customerTable;
     
     public function getCustomerTable()
     {
         if (!$this -> customerTable)
         {
             $sm = $this -> getServiceLocator();
             $this -> customerTable = $sm -> get('Customer\Model\CustomerTable');
         }
         return $this -> customerTable;
     }
     
     public function indexAction()
     {
         return new ViewModel(array(
             'customers' => $this -> getCustomerTable() -> fetchAll()
         ));
     }
     
     public function addAction()
     {
         $form = new CustomerForm();
         $form -> get('submit') -> setValue('Add');

         $request = $this -> getRequest();
         if ($request -> isPost()) {
             $customer = new Customer();
             $form -> setInputFilter($customer -> getInputFilter());
             $form -> setData($request -> getPost());

             if ($form -> isValid()) {
                 $customer -> exchangeArray($form -> getData());
                 $this -> getCustomerTable() -> saveCustomer(0, $customer);

                 // Redirecciona a la lista completa de clientes
                 return $this -> redirect() -> toRoute('customer');
             }
             else {
                 $messages = $form -> getMessages();
             }
         }
         return array('form' => $form);
     }
     
     public function editAction()
     {
         $id = (int) $this -> params() -> fromRoute('id', 0);
         if (!$id) {
             return $this -> redirect() -> toRoute('customer', array(
                 'action' => 'add'
             ));
         }

         // Obtiene el registro por idcustomer
         try {
             $customer = $this -> getCustomerTable() -> getCustomer($id);
         }
         catch (\Exception $ex) {
             return $this -> redirect() -> toRoute('customer', array('action' => 'index'));
         }

         $form = new CustomerForm();
         $form -> bind($customer);
         $form -> get('submit') -> setAttribute('value', 'Save');

         $request = $this -> getRequest();
         if ($request -> isPost()) {
             $form -> setInputFilter($customer -> getInputFilter());
             $form -> setData($request -> getPost());

             if ($form -> isValid()) {
                 $this -> getCustomerTable() -> saveCustomer($id, $customer);

                 // Redirecciona a la lista completa de clientes luego de guardar los cambios
                 return $this -> redirect() -> toRoute('customer');
             }
             else {
                 $messages = $form -> getMessages();
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
             'customer' => $customer
         );
     }
     
     public function deleteAction()
     {
         $id = (int) $this -> params() -> fromRoute('id', 0);
         if (!$id)
         {
            return $this -> redirect() -> toRoute('customer');
         }
         
         $request = $this -> getRequest();
         if ($request -> isPost())
         {
             $del = $request -> getPost('del', 'No');
             if ($del == 'Yes')
             {
                 //$id = (int) $request -> getPost('id');
                 $this -> getCustomerTable() -> deleteCustomer($id);
                 
                 // Redirecciona a la lista de clientes luego de eliminar
                 return $this -> redirect() -> toRoute('customer');
             }
             else
             {
                 // Redirecciona a la lista porque el usuario no confirmo
                 return $this -> redirect() -> toRoute('customer');
             }
         }
         
         return array(
             'id'       => $id,
             'customer' => $this -> getCustomerTable() -> getCustomer($id)
         );
     }
     
     public function searchAction()
     {
         $form = new CustomerForm();
         echo "entro aqui";
         return array('form' => $form);
     }
 }