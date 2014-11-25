<?php 
require_once "../vendor/autoload.php";
use \Kazoo\AuthToken\User;
use \Kazoo\SDK;

class HostileWorkEnvironment
{

    //TODO: get own account_id, 
    //private static $account_id = "a8b37eeeb898d78dda9f1ec011341205";
    private static $sdk;

    private function getKazoo(){
        if (is_null(self::$sdk)){
        	$options = array('base_url' => 'http://10.26.0.127:8000');
        	$auth_token = new User('admin', 'admin', 'sip.test.2600hz.com');
        	self::$sdk = new SDK($auth_token, $options);
        }

        return self::$sdk; 
    }



    public function hire($username, $first_name, $last_name, $email, $cage, $restriction){
        $user_id = createUser($username, $first_name, $last_name, $email, $cage);
        $device_id = getDeviceCage($cage);
        assignDevice($device_id, $user_id);
        setRestriction($device_id, $restrictions);
        $vmbox_id = createVmbox($first_name, $cage, $user_id);
        createCallflow($ext, $device_id, $vmbox_id);
    }


    public function fire($cage){
        $filter = array('filter_cage' => $cage);

        $this->getKazoo()->vmboxes($filter)->remove();
        $this->getKazoo()->users($filter)->remove();
        $this->getKazoo()->callflows($filter)->remove();
    }

    private function createUser($user_name, $first_name, $last_name, $email, $cage){
        $user = $this->getKazoo()->vmbox();

        $user->username = $user_name;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->cage = $cage;
        $user->save();

        return $user->getId();
    }

    public function getDeviceCage($cage){
        $filter = array('filter_cage' => $cage);
        
        return $this->getKazoo()->devices($filter)-getId();
    }

    private function assignDevice($device_id, $owner_id, $cage){
        $device = $this->getKazoo()->vmbox($vmbox_id);

        $device->owner_id = $owner_id;
        $device->cage = $cage;
        $device->save();
    }

    private function setRestriction($device_id, $restrictions){
        $device = $this->getKazoo()->device($device_id);

        foreach ($restrictions as $key => $value){
            $device->call_restriction->$key = $value;
        }

        $device->save();
    }

    private function createVmbox($vm_name, $vm_number, $owner_id){  
        $vmbox = $this->getKazoo()->vmbox();

        $vmbox->name = $vm_name;
        $vmbox->owner_id = $owner_id;
        $vmbox->mailbox = $vm_nmber;
        $vmbox->cage = $vm_number;
        $vmbox->save();

        return $vmbox->getId();
    }

    private function createCallflow($device_id, $vmbox_id, $cage){
        $callflow = $this->getKazoo()->callflow();
        $flow = new stdClass();

        $flow->module = "device";
        $flow->data->id = $device_id;
        $flow->data->timeout = "30";
        $flow->data->can_call_self = false;
        $flow->children->_->data->id = $vmbox_id;
        $flow->children->_->module = "voicemail";
        $flow->children->_->children = new stdClass();

        $callflow->numbers = array($ext);
        $callflow->flow = $flow;
        $callflow->cage = $cage;
        $callflow->save();
    }


// Code below should be moved elsewhere, but kept, since they are good examples.

    public function createDevice($number){
        $device = $this->getKazoo()->Account()->Device();
        $device->name = (string) $number;
        $device->cage = $number; 
        $device->save();

        return $device->getId();
    }

    public function createAccount($sdk, $account_name) {
        $account = $this->getKazoo()->Account();
        $account = $sdk->Account(null);
        $account->name = $account_name;
        $account->save();

        return $account->getId();
    }
}
