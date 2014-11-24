<?php 
require_once "vendor/autoload.php";
use \Kazoo\AuthToken\User;
use \Kazoo\SDK;

class HostileWorkEnvironment(){

    private static $account_id = "a8b37eeeb898d78dda9f1ec011341205"; 
    private static $sdk;



    private function getSdkInstance(){
        $options = array('base_url' => 'http://192.168.56.101:8000');
        $auth_token = new User('admin', 'admin', 'sip.ing-local-dev.2600hz.com');
        $sdk = new SDK($auth_token, $options);
    }

    private function getAccountId(){
       return $this->account_id;
    }

	private function getAccount(){
		$sdk = getSdkInstance();
	    return $sdk->Account($this->getAccountId()); 
	}

	public function getDeviceCage($cage){
		$filter = array('filter_cage' => $cage);
		return $this->getAccount()->devices($filter)-getId();
	}

	public function hire($username, $first_name, $last_name, $email, $cage, restriction){
	    $user_id = createUser($username, $first_name, $last_name, $email, $cage);
	    $device_id = getDeviceCage($cage);
	    assignDevice($device_id, $user_id);
	    $vmbox_id = createVmbox($first_name, $cage, $user_id);
	    createCallflow($ext, $device_id, $vmbox_id);

	}


	public function fire($cage){
        $filter = array('filter_cage' => $cage);

		$this->getAccount()->vmboxes($filter)->remove();
		$this->getAccount()->users($filter)->remove();
		$this->getAccount()->callflows($filter)->remove();

	}

	private function createCallflow($device_id, $vmbox_id, $cage){

	    $callflow = $this->getAccount()->callflow();
	    $callflow->numbers = array($ext);
	    $flow = new stdClass();

	    $flow->module = "device";
	    $flow->data->id = $device_id;
	    $flow->data->timeout = "30";
	    $flow->data->can_call_self = false;
	    $flow->children->_->data->id = $vmbox_id;
	    $flow->children->_->module = "voicemail";
	    $flow->children->_->children = new stdClass();

	    $callflow->flow = $flow;
	    $callflow->cage = $cage;

	    $callflow->save();
	}


	private function setRestriction($device_id, $restrictions){
    	$device = $this->getAccount->device($device_id);

    	foreach ($restrictions as $key => $value){
    		$device->call_restriction->$key = $value;
    	}

    	$device->save()
	}

	private function assignDevice($device_id, $owner_id, $cage){
	    $device = $this->getAccount->vmbox($vmbox_id);
	    $device->owner_id = $owner_id;
	    $device->cage = $cage;
	    $device->save();
	}

	private function createVmbox($vm_name, $vm_number, $owner_id){  
	    $vmbox = $this->getAccount()->vmbox();
	    $vmbox->name = $vm_name;
	    $vmbox->owner_id = $owner_id;
	    $vmbox->mailbox = $vm_nmber;
	    $vmbox->cage = $vm_number;
	    $vmbox->save();

	    return $vmbox->getId();
	}

	private function createUser($user_name, $first_name, $last_name, $email, $cage){
	    $user = $this->getAccount()->vmbox();
	    $user->username = $user_name;
	    $user->first_name = $first_name;
	    $user->last_name = $last_name;
	    $user->email = $email;
	    $user->cage = $cage;
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
