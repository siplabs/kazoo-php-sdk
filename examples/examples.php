<?php 
require_once "vendor/autoload.php";
use \Kazoo\AuthToken\User;
use \Kazoo\SDK;

$options = array('base_url' => 'http://192.168.56.101:8000');
$auth_token = new User('admin', 'admin', 'sip.ing-local-dev.2600hz.com');

$sdk = new SDK($auth_token, $options);

$account_id = createAccount($sdk, "fuckyousean6");
$user_id = createUser($sdk, $account_id, "usersean", "first", "last");
$device_id = createDevice($sdk, $account_id, "dev_name");
assignDevice($sdk, $account_id, $device_id, $user_id);
$vmbox_id = createVmbox($sdk, $account_id, "vmbox", "1111");
assignVmbox($sdk, $account_id, $vmbox_id, $user_id);




function deleteDevice(){

}

function deleteUser(){

}

function deleteVmbox(){

}

function createCallflow(){

}

function deleteCallflow(){

}


function newHire($sdk, $username, $first_name, $last_name, $email, $ext, restriction){
    createUser($sdk, $username, $first_name, $last_name, $email);
    assignDevice($sdk, )
    createVmbox();
    createCallflow();

}

function newFire(){
    resetDevice();
    deleteVmbox();
    deleteUser();
    resetCallflow();

}


function setRestriction($sdk, $restriction){


}




function assignDevice($sdk, $account_id, $device_id, $owner_id, $ext){

    $device = $sdk->Account($account_id)->device($device_id);
    $device->owner_id = $owner_id;
    $device->save();

}

function assignVmbox($sdk, $account_id, $vmbox_id, $owner_id){

    $vmbox = $sdk->Account($account_id)->vmbox($vmbox_id);
    $vmbox->owner_id = $owner_id;
    $vmbox->save();

}

function createVmbox($sdk, $account_id, $vm_name, $vm_number, $owner_id){

    $vmbox = $sdk->Account($account_id)->vmbox();
    $vmbox->name = $vm_name;
    $vmbox->owner_id = $owner_id;
    $vmbox->mailbox = $vm_nmber;
    $vmbox->save();

    return $vmbox->getId();
}

function getAccount(){

    return $sdk->Account($account_id)
}



function createUser($sdk, $account_id, $user_name, $first_name, $last_name){

    $user = $sdk->Account($account_id)->user();
    $user->username = $user_name;
    $user->first_name = $first_name;
    $user->last_name = $last_name;
    $user->save();

    return $user->getId();
}

function createDevice($sdk, $account_id, $device_name){

    $device = $sdk->Account($account_id)->device();
    $device->name = $device_name;
    $device->save();

    return $device->getId();
}

function createAccount($sdk, $account_name) {

    $account = $sdk->Account(null);
    $account->name = $account_name;
    $account->save();

    return $account->getId();

}