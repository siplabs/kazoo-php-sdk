<?php 
require_once "vendor/autoload.php";
use \Kazoo\AuthToken\User;
use \Kazoo\SDK;

class HostileWorkEnvironment(){
        private static $account_id = "gjaflkjsljfa;sldkjfs"; 
        private static $sdk;
      
        private function getSdk(){
            $options = array('base_url' => 'http://192.168.56.101:8000');
            $auth_token = new User('admin', 'admin', 'sip.ing-local-dev.2600hz.com');
            $sdk = new SDK($auth_token, $options);
        }       
 
        private function getAccountId(){
           return $this->account_id;
        }

	private function getAccount(){
	    return $sdk->Account($this->getAccountId()); 
	}

	public function hire($username, $first_name, $last_name, $email, $ext, restriction){
	    $user_id = createUser($username, $first_name, $last_name, $email);
	    assignDevice($ext, $user_id);
	    $vmbox_id = createVmbox($user_id);
	    createCallflow($user_id, $vmbox);
	}

	public function fire($ext){
	    resetDevice($ext);
	    deleteVmbox($ext);
	    deleteUser($ext);
	    resetCallflow($ext);
	}

	private function deleteDevice(){
                        
	}
 
	private function deleteUser(){
            
	}

	private function deleteVmbox(){

	}

	private function createCallflow(){

	}

	private function deleteCallflow(){

	}

	private function setRestriction($sdk, $restriction){
             

	}

	private function assignDevice($device_id, $owner_id, $ext){
	    $device = $this->account->vmbox($vmbox_id);
	    $device->owner_id = $owner_id;
	    $device->save();
	}

	private function assignVmbox($vmbox_id, $owner_id){
	    $vmbox = $this->account->vmbox($vmbox_id);
	    $vmbox->owner_id = $owner_id;
	    $vmbox->save();
	}

	private function createVmbox($vm_name, $vm_number, $owner_id){  
	    $vmbox = $this->getAccount()->vmbox();
	    $vmbox->name = $vm_name;
	    $vmbox->owner_id = $owner_id;
	    $vmbox->mailbox = $vm_nmber;
	    $vmbox->save();

	    return $vmbox->getId();
	}

	private function createUser($sdk, $account_id, $user_name, $first_name, $last_name){
	    $user = $this->getAccount()->vmbox();
	    $user->username = $user_name;
	    $user->first_name = $first_name;
	    $user->last_name = $last_name;
	    $user->save();

	    return $user->getId();
	}

        private function createDevice($device_name){
	    $device = $this->getAccount();
	    $device->name = $device_name;
	    $device->save();

	    return $device->getId();
	}

	private function createAccount($sdk, $account_name) {
            $account = $this->getAccount();
	    $account = $sdk->Account(null);
	    $account->name = $account_name;
	    $account->save();

	    return $account->getId();
	}
}
