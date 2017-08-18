<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/* * ***************************Includes********************************* */
require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';

class extel extends eqLogic {
	/*     * *************************Attributs****************************** */
	public static $_widgetPossibility = array('custom' => true);
	private static $_extels = null;

	/*     * ***********************Methode static*************************** */

	public static function cron($_eqlogic_id = null) {
		$eqLogics = ($_eqlogic_id !== null) ? array(eqLogic::byId($_eqlogic_id)) : eqLogic::byType('extel', true);
		foreach ($eqLogics as $extel) {
			try {
				$extel->getextelInfo();
			} catch (Exception $e) {

			}
		}
	}

	/*     * *********************Méthodes d'instance************************* */

	public function getextelInfo() {
		try{
			if ($this->getConfiguration('addr','') != '') {
				$request_http = new com_http('http://' . $this->getConfiguration('addr','') . '/?cmd=511');
				$result = json_decode(trim($request_http->exec($_timeout = 5)), true);
			}
			$data = $result['data'];
			log::add('extel','debug',print_r($data,true));
		} catch (Exception $e) {
		
		}
		$i=0;
		while ($i<6){
			$this->checkAndUpdateCmd('etat'. ($i+1), $data['switch'][$i]);
			$this->checkAndUpdateCmd('power'. ($i+1), $data['watt'][$i]);
			$this->checkAndUpdateCmd('current'. ($i+1), $data['amp'][$i]);
			$i +=1;
		}
		$this->refreshWidget();
		
	}

	public function preInsert() {
		$this->setCategory('energy', 1);
	}

	public function postSave() {
		$cmd = $this->getCmd(null, 'etat1');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('etat1');
			$cmd->setName(__('Etat1', __FILE__));
			$cmd->setIsVisible(0);
		}
		$cmd->setType('info');
		$cmd->setDisplay('generic_type', 'ENERGY_STATE');
		$cmd->setSubType('binary');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();
		$cmdid = $cmd->getId();

		$cmd = $this->getCmd(null, 'on1');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('on1');
			$cmd->setName(__('On1', __FILE__));
			$cmd->setTemplate('dashboard', 'prise');
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_ON');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->setValue($cmdid);
		$cmd->save();

		$cmd = $this->getCmd(null, 'off1');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('off1');
			$cmd->setName(__('Off1', __FILE__));
			$cmd->setTemplate('dashboard', 'prise');
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_OFF');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->setValue($cmdid);
		$cmd->save();
		
		$cmd = $this->getCmd(null, 'etat2');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('etat2');
			$cmd->setName(__('Etat2', __FILE__));
			$cmd->setIsVisible(0);
		}
		$cmd->setType('info');
		$cmd->setDisplay('generic_type', 'ENERGY_STATE');
		$cmd->setSubType('binary');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();
		$cmdid = $cmd->getId();

		$cmd = $this->getCmd(null, 'on2');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('on2');
			$cmd->setName(__('On2', __FILE__));
			$cmd->setTemplate('dashboard', 'prise');
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_ON');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->setValue($cmdid);
		$cmd->save();

		$cmd = $this->getCmd(null, 'off2');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('off2');
			$cmd->setName(__('Off2', __FILE__));
			$cmd->setTemplate('dashboard', 'prise');
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_OFF');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->setValue($cmdid);
		$cmd->save();
		
		$cmd = $this->getCmd(null, 'etat3');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('etat3');
			$cmd->setName(__('Etat3', __FILE__));
			$cmd->setIsVisible(0);
		}
		$cmd->setType('info');
		$cmd->setDisplay('generic_type', 'ENERGY_STATE');
		$cmd->setSubType('binary');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();
		$cmdid = $cmd->getId();

		$cmd = $this->getCmd(null, 'on3');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('on3');
			$cmd->setName(__('On3', __FILE__));
			$cmd->setTemplate('dashboard', 'prise');
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_ON');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->setValue($cmdid);
		$cmd->save();

		$cmd = $this->getCmd(null, 'off3');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('off3');
			$cmd->setName(__('Off3', __FILE__));
			$cmd->setTemplate('dashboard', 'prise');
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_OFF');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->setValue($cmdid);
		$cmd->save();
		
		$cmd = $this->getCmd(null, 'etat4');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('etat4');
			$cmd->setName(__('Etat4', __FILE__));
			$cmd->setIsVisible(0);
		}
		$cmd->setType('info');
		$cmd->setDisplay('generic_type', 'ENERGY_STATE');
		$cmd->setSubType('binary');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();
		$cmdid = $cmd->getId();

		$cmd = $this->getCmd(null, 'on4');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('on4');
			$cmd->setName(__('On4', __FILE__));
			$cmd->setTemplate('dashboard', 'prise');
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_ON');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->setValue($cmdid);
		$cmd->save();

		$cmd = $this->getCmd(null, 'off4');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('off4');
			$cmd->setName(__('Off4', __FILE__));
			$cmd->setTemplate('dashboard', 'prise');
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_OFF');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->setValue($cmdid);
		$cmd->save();
		
		$cmd = $this->getCmd(null, 'etat5');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('etat5');
			$cmd->setName(__('Etat5', __FILE__));
			$cmd->setIsVisible(0);
		}
		$cmd->setType('info');
		$cmd->setDisplay('generic_type', 'ENERGY_STATE');
		$cmd->setSubType('binary');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();
		$cmdid = $cmd->getId();

		$cmd = $this->getCmd(null, 'on5');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('on5');
			$cmd->setName(__('On5', __FILE__));
			$cmd->setTemplate('dashboard', 'prise');
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_ON');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->setValue($cmdid);
		$cmd->save();

		$cmd = $this->getCmd(null, 'off5');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('off5');
			$cmd->setName(__('Off5', __FILE__));
			$cmd->setTemplate('dashboard', 'prise');
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_OFF');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->setValue($cmdid);
		$cmd->save();
		
		$cmd = $this->getCmd(null, 'etat6');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('etat6');
			$cmd->setName(__('Etat6', __FILE__));
			$cmd->setIsVisible(0);
		}
		$cmd->setType('info');
		$cmd->setDisplay('generic_type', 'ENERGY_STATE');
		$cmd->setSubType('binary');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();
		$cmdid = $cmd->getId();

		$cmd = $this->getCmd(null, 'on6');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('on6');
			$cmd->setName(__('On6', __FILE__));
			$cmd->setTemplate('dashboard', 'prise');
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_ON');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->setValue($cmdid);
		$cmd->save();

		$cmd = $this->getCmd(null, 'off6');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('off6');
			$cmd->setName(__('Off6', __FILE__));
			$cmd->setTemplate('dashboard', 'prise');
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_OFF');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->setValue($cmdid);
		$cmd->save();

		$cmd = $this->getCmd(null, 'power1');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('power1');
			$cmd->setIsVisible(1);
			$cmd->setIsHistorized(1);
			$cmd->setName(__('Puissance1', __FILE__));
			$cmd->setUnite('W');
			$cmd->setTemplate('dashboard', 'line');
		}
		$cmd->setType('info');
		$cmd->setSubType('numeric');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();

		$cmd = $this->getCmd(null, 'current1');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('current1');
			$cmd->setUnite('mA');
			$cmd->setIsVisible(1);
			$cmd->setName(__('Courant1', __FILE__));
			$cmd->setTemplate('dashboard', 'line');
		}
		$cmd->setType('info');
		$cmd->setSubType('numeric');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();

		$cmd = $this->getCmd(null, 'power2');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('power2');
			$cmd->setIsVisible(1);
			$cmd->setIsHistorized(1);
			$cmd->setName(__('Puissance2', __FILE__));
			$cmd->setUnite('W');
			$cmd->setTemplate('dashboard', 'line');
		}
		$cmd->setType('info');
		$cmd->setSubType('numeric');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();

		$cmd = $this->getCmd(null, 'current2');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('current2');
			$cmd->setUnite('mA');
			$cmd->setIsVisible(1);
			$cmd->setName(__('Courant2', __FILE__));
			$cmd->setTemplate('dashboard', 'line');
		}
		$cmd->setType('info');
		$cmd->setSubType('numeric');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();

		$cmd = $this->getCmd(null, 'power3');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('power3');
			$cmd->setIsVisible(1);
			$cmd->setIsHistorized(1);
			$cmd->setName(__('Puissance3', __FILE__));
			$cmd->setUnite('W');
			$cmd->setTemplate('dashboard', 'line');
		}
		$cmd->setType('info');
		$cmd->setSubType('numeric');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();

		$cmd = $this->getCmd(null, 'current3');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('current3');
			$cmd->setUnite('mA');
			$cmd->setIsVisible(1);
			$cmd->setName(__('Courant3', __FILE__));
			$cmd->setTemplate('dashboard', 'line');
		}
		$cmd->setType('info');
		$cmd->setSubType('numeric');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();

		$cmd = $this->getCmd(null, 'power4');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('power4');
			$cmd->setIsVisible(1);
			$cmd->setIsHistorized(1);
			$cmd->setName(__('Puissance4', __FILE__));
			$cmd->setUnite('W');
			$cmd->setTemplate('dashboard', 'line');
		}
		$cmd->setType('info');
		$cmd->setSubType('numeric');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();

		$cmd = $this->getCmd(null, 'current4');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('current4');
			$cmd->setUnite('mA');
			$cmd->setIsVisible(1);
			$cmd->setName(__('Courant4', __FILE__));
			$cmd->setTemplate('dashboard', 'line');
		}
		$cmd->setType('info');
		$cmd->setSubType('numeric');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();

		$cmd = $this->getCmd(null, 'power5');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('power5');
			$cmd->setIsVisible(1);
			$cmd->setIsHistorized(1);
			$cmd->setName(__('Puissance5', __FILE__));
			$cmd->setUnite('W');
			$cmd->setTemplate('dashboard', 'line');
		}
		$cmd->setType('info');
		$cmd->setSubType('numeric');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();

		$cmd = $this->getCmd(null, 'current5');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('current5');
			$cmd->setUnite('mA');
			$cmd->setIsVisible(1);
			$cmd->setName(__('Courant5', __FILE__));
			$cmd->setTemplate('dashboard', 'line');
		}
		$cmd->setType('info');
		$cmd->setSubType('numeric');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();
		
		$cmd = $this->getCmd(null, 'power6');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('power6');
			$cmd->setIsVisible(1);
			$cmd->setIsHistorized(1);
			$cmd->setName(__('Puissance6', __FILE__));
			$cmd->setUnite('W');
			$cmd->setTemplate('dashboard', 'line');
		}
		$cmd->setType('info');
		$cmd->setSubType('numeric');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();

		$cmd = $this->getCmd(null, 'current6');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('current6');
			$cmd->setUnite('mA');
			$cmd->setIsVisible(1);
			$cmd->setName(__('Courant6', __FILE__));
			$cmd->setTemplate('dashboard', 'line');
		}
		$cmd->setType('info');
		$cmd->setSubType('numeric');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();
		
		$cmd = $this->getCmd(null, 'onall');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('onall');
			$cmd->setIsVisible(0);
			$cmd->setName(__('OnTous', __FILE__));
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_ON');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();

		$cmd = $this->getCmd(null, 'offall');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('offall');
			$cmd->setIsVisible(0);
			$cmd->setName(__('OffTous', __FILE__));
		}
		$cmd->setTemplate('mobile', 'prise');
		$cmd->setType('action');
		$cmd->setDisplay('generic_type', 'ENERGY_OFF');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();

		$cmd = $this->getCmd(null, 'refresh');
		if (!is_object($cmd)) {
			$cmd = new extelCmd();
			$cmd->setLogicalId('refresh');
			$cmd->setIsVisible(1);
			$cmd->setName(__('Rafraichir', __FILE__));
		}
		$cmd->setType('action');
		$cmd->setSubType('other');
		$cmd->setEqLogic_id($this->getId());
		$cmd->save();
	}
	
	public function toHtml($_version = 'dashboard') {
		$replace = $this->preToHtml($_version);
 		if (!is_array($replace)) {
 			return $replace;
  		}
		$version = jeedom::versionAlias($_version);
		if ($this->getDisplay('hideOn' . $version) == 1) {
			return '';
		}
		foreach ($this->getCmd() as $cmd) {
			if ($cmd->getType() == 'info') {
				$value = $cmd->execCmd();
				$replace['#' . $cmd->getLogicalId() . '_history#'] = '';
				$replace['#' . $cmd->getLogicalId() . '#'] = $value == '' ? 0 : $value;
				$replace['#' . $cmd->getLogicalId() . '_id#'] = $cmd->getId();
				$replace['#' . $cmd->getLogicalId() . '_collectDate#'] = $cmd->getCollectDate();
				if ($cmd->getIsHistorized() == 1) {
					$replace['#' . $cmd->getLogicalId() . '_history#'] = 'history cursor';
				}
			} else {
				$replace['#' . $cmd->getLogicalId() . '_id#'] = $cmd->getId();
			}
		}
		return $this->postToHtml($_version, template_replace($replace, getTemplate('core', $version, '6power', 'extel')));
	}
}

class extelCmd extends cmd {
	/*     * *************************Attributs****************************** */

	/*     * ***********************Methode static*************************** */

	/*     * *********************Methode d'instance************************* */

	public function execute($_options = null) {
		$eqLogic = $this->getEqlogic();
		if ($this->getLogicalId() == 'refresh') {
			return extel::cron($eqLogic->getId());
		}
		$output = substr($this->getLogicalId(),0,2) == 'on' ? '1' : '0';
		$port = substr($this->getLogicalId(),-1) == 'l' ? '0' : substr($this->getLogicalId(),-1);
		try{
			if ($eqLogic->getConfiguration('addr','') != '') {
				$request_http = new com_http('http://' . $eqLogic->getConfiguration('addr','') . '/?cmd=200&json={"port":' . $port . ',"state":' . $output . '}');
				log::add('extel','debug','http://' . $eqLogic->getConfiguration('addr','') . '/?cmd=200&json={"port":' . $port . ',"state":' . $output . '}');
				$result = json_decode(trim($request_http->exec($_timeout = 5)), true);
			}
		} catch (Exception $e) {
		
		}
		$eqLogic->getextelInfo();
	}

	/*     * **********************Getteur Setteur*************************** */
}

