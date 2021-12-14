<?php

class AddressController extends Controller
{
    public static function selectElement(HasAddress $obj) 
    { 
        require 'View/_set_address.php';
        $addAddressView = new AddAddressView();
        $addAddress = new AddAddress($addAddressView);
        $addAddress->listener();
        if($addAddress->notNull()) { $obj->setAddress($addAddress->view->fullAddress); }
        require 'View/address_form.php';
    }
}