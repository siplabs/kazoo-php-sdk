<?php

namespace Kazoo\Tests\Siplabs;

use \Exception;
use \Kazoo\Tests\Common\FunctionalTest;
use \stdClass;

class MyTest extends FunctionalTest
{

   public function testCbConnectivity() {
        $connectivity = $this->getSDK()->Account()->Connectivity();
        $connectivity->account = new stdClass();
        $connectivity->DIDs_Unassigned = new stdClass();
        $connectivity->account->trunks = 0;
        $connectivity->account->inbound_trunks = 0;
        $connectivity->account->auth_realm='il12345';
        $connectivity->billing_account_id=$this->getSDK()->Account()->getId();
        $connectivity->servers =  array();
        $connectivity->save();
 
        $connectivity->account->auth_realm='il123';
        $connectivity->save();
        $conn=$connectivity->fetch();
        $this->assertEquals($conn->account->auth_realm,"il123");
        //if ($conn->account->auth_realm=="il123") {print_r("Good cb_connectivity");}
        $connectivity->remove();
   }
}
