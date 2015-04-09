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

   public function testCbWebhook() {
       $wh = $this->getSDK()->Account()->Webhook();
       $wh->name = 'friendly name';
       $wh->uri = 'http://localhost';
       $wh->http_verb = 'get';
       $wh->hook = 'all';
       $wh->save();

       $wh->http_verb = 'post';
       $wh->save();

       $test = $wh->fetch();
       $this->assertEquals($test->http_verb, 'post');

       $wh->remove();
   }

   public function testCbConferences() {
       $conf = $this->getSDK()->Account()->Conference();
       $conf->name = 'friendly name';
       $conf->save();

       $conf->name = 'not name';
       $conf->save();

       $test = $conf->fetch();
       $this->assertEquals($test->name, 'not name');

       $conf->remove();
   }

   public function testCbMenu() {
       $menu = $this->getSDK()->Account()->Menu();
       $menu->name = 'friendly name';
       $menu->save();

       $menu->name = 'not name';
       $menu->save();

       $test = $menu->fetch();
       $this->assertEquals($test->name, 'not name');

       $menu->remove();
   }

   public function testCallflow() {
       $cb = $this->getSDK()->Account()->Callflow();
       $cb->flow = array('module' => 'simple', 'data' => new stdClass());
       $cb->numbers = array('+'.rand(1, 1000000));
       $cb->save();

       $cb->flow->name = 'not simple';
       $cb->save();

       $test = $cb->fetch();
       $this->assertEquals($test->flow->name, 'not simple');

       $cb->remove();
   }

   public function testUserV1() {
       $user = $this->getSDK()->Account()->User();
       $user->first_name = 'simple';
       $user->last_name = 'last';
       $user->save();

       $user->first_name = 'first';
       $user->save();

       $test=$user->fetch();
       $this->assertEquals($test->first_name, 'first');

       $user->remove();
   }

   public function testFaxboxes() {
       $fb = $this->getSDK()->Account()->Faxbox();
       $fb->name = 'simple';
       $fb->numbers = array('+438931212' => new stdClass());
       $fb->save();

       $fb->name = 'not simple';
       $fb->save();

       $test = $fb->fetch();
       $this->assertEquals($test->name, 'not simple');

       $fb->remove();
   }
}
