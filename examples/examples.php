<?php 
require_once "vendor/autoload.php";
use \Kazoo\AuthToken\User;
use \Kazoo\SDK;

class HostileWorkEnvironment(){

    private static $account_id = "gjaflkjsljfa;sldkjfs"; 
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

	public function hire($username, $first_name, $last_name, $email, $ext, restriction){
	    $user_id = createUser($username, $first_name, $last_name, $email);
	    assignDevice($ext, $user_id);
	    $vmbox_id = createVmbox($user_id);
	    createCallflow($ext, $device_id, $vmbox_id);
	}

	public function fire($ext){
	    resetDevice($ext);
	    deleteVmbox($ext);
	    deleteUser($ext);
	    resetCallflow($ext);
	}

	private function deleteDevice(){
                        
	}
 
	private function deleteUser($user_id){
            
	}

	private function deleteVmbox($vmbox){


	}

	private function createCallflow($ext, $device_id, $vmbox_id){

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
	    $callflow->save();
	}

	private function deleteCallflow(){

	}

	private function setRestriction($device_id, $restrictions){
    	$device = $this->getAccount->device($device_id);

    	$device->save()
	}

	private function assignDevice($device_id, $owner_id, $ext){
	    $device = $this->getAccount->vmbox($vmbox_id);
	    $device->owner_id = $owner_id;
	    $device->save();
	}

	private function assignVmbox($vmbox_id, $owner_id){
	    $vmbox = $this->getAccount->vmbox($vmbox_id);
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

	private function createUser($sdk, $account_id, $user_name, $first_name, $last_name, $email){
	    $user = $this->getAccount()->vmbox();
	    $user->username = $user_name;
	    $user->first_name = $first_name;
	    $user->last_name = $last_name;
	    $user->email = $email;
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
