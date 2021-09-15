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
require_once __DIR__  . '/../../../../core/php/core.inc.php';


//log::add('networks', 'error', 'Ma log');
//message::add('networks', 'Description ' , 'action' . $this->getId());
//throw new Exception(__('L\'adresse IP ne peut être vide', __FILE__));

class visonicpowerlink3 extends eqLogic {
    /*     * *************************Attributs****************************** */
    
  /*
   * Permet de définir les possibilités de personnalisation du widget (en cas d'utilisation de la fonction 'toHtml' par exemple)
   * Tableau multidimensionnel - exemple: array('custom' => true, 'custom::layout' => false)
	public static $_widgetPossibility = array();
   */
    
    /*     * ***********************Methode static*************************** */

    /*
     * Fonction exécutée automatiquement toutes les minutes par Jeedom*/
      public static function cron() {
		  
		  foreach (self::byType('visonicpowerlink3', true) as $equipement) { //parcours tous les équipements actifs du plugin
			$cmd = $equipement->getCmd(null, 'refreshPartial'); //retourne la commande "refresh" si elle existe
			if (!is_object($cmd)) { //Si la commande n'existe pas
				continue; //continue la boucle
			}
			$cmd->execCmd(); //la commande existe on la lance
		}
      }
     

    /*
     * Fonction exécutée automatiquement toutes les 5 minutes par Jeedom
      public static function cron5() {
      }
     */

    /*
     * Fonction exécutée automatiquement toutes les 10 minutes par Jeedom
      public static function cron10() {
      }
     */
    
    /*
     * Fonction exécutée automatiquement toutes les 15 minutes par Jeedom*/
      public static function cron15() {
		foreach (self::byType('visonicpowerlink3', true) as $equipement) { //parcours tous les équipements actifs du plugin
			$cmd = $equipement->getCmd(null, 'refresh'); //retourne la commande "refreshAll" si elle existe
			if (!is_object($cmd)) { //Si la commande n'existe pas
				continue; //continue la boucle
			}
			$cmd->execCmd(); //la commande existe on la lance
			
			
		}
      }
     
    
    /*
     * Fonction exécutée automatiquement toutes les 30 minutes par Jeedom
      public static function cron30() {
      }
     */
    
    /*
     * Fonction exécutée automatiquement toutes les heures par Jeedom
      public static function cronHourly() {
      }
     */

    /*
     * Fonction exécutée automatiquement tous les jours par Jeedom
      public static function cronDaily() {
      }
     */



    /*     * *********************Méthodes d'instance************************* */
    
 // Fonction exécutée automatiquement avant la création de l'équipement 
    public function preInsert() {
        
    }

 // Fonction exécutée automatiquement après la création de l'équipement 
    public function postInsert() {
        
    }

 // Fonction exécutée automatiquement avant la mise à jour de l'équipement 
    public function preUpdate() {
        
    }

 // Fonction exécutée automatiquement après la mise à jour de l'équipement 
    public function postUpdate() {
        $cmd = $this->getCmd(null, 'refresh'); // Searching refresh
		if (is_object($cmd)) { // call refresh
			$cmd->execCmd();
		}
    }

 // Fonction exécutée automatiquement avant la sauvegarde (création ou mise à jour) de l'équipement 
    public function preSave() {
        
    }

 // Fonction exécutée automatiquement après la sauvegarde (création ou mise à jour) de l'équipement 
    public function postSave() {
		
		
	
		// Partition 1 : state
		$part1State = $this->getCmd(null, 'part1State');
		if (!is_object($part1State)) {
			$part1State = new visonicpowerlink3Cmd();
			$part1State->setName(__('Partition 1 - état', __FILE__));
		}
		$part1State->setLogicalId('part1State');
		$part1State->setEqLogic_id($this->getId());
		$part1State->setType('info');
		$part1State->setSubType('string');
		$part1State->save();
		
		// Partition 1 : memoryBit
		$part1Memory = $this->getCmd(null, 'part1Memory');
		if (!is_object($part1Memory)) {
			$part1Memory = new visonicpowerlink3Cmd();
			$part1Memory->setName(__('Partition 1 - mémoire alarme', __FILE__));
		}
		$part1Memory->setLogicalId('part1Memory');
		$part1Memory->setEqLogic_id($this->getId());
		$part1Memory->setType('info');
		$part1Memory->setSubType('binary');
		$part1Memory->save();
			
		// Partition 1 : readyBit
		$part1Ready = $this->getCmd(null, 'part1Ready');
		if (!is_object($part1Ready)) {
			$part1Ready = new visonicpowerlink3Cmd();
			$part1Ready->setName(__('Partition 1 - prête', __FILE__));
		}
		$part1Ready->setLogicalId('part1Ready');
		$part1Ready->setEqLogic_id($this->getId());
		$part1Ready->setType('info');
		$part1Ready->setSubType('binary');
		$part1Ready->save();
		
		// Partition 1 : alertBit
		$part1Alert = $this->getCmd(null, 'part1Alert');
		if (!is_object($part1Alert)) {
			$part1Alert = new visonicpowerlink3Cmd();
			$part1Alert->setName(__('Partition 1 - alerte', __FILE__));
		}
		$part1Alert->setLogicalId('part1Alert');
		$part1Alert->setEqLogic_id($this->getId());
		$part1Alert->setType('info');
		$part1Alert->setSubType('binary');
		$part1Alert->save();
		
		// Partition 1 : troubleBit
		$part1Trouble = $this->getCmd(null, 'part1Trouble');
		if (!is_object($part1Trouble)) {
			$part1Trouble = new visonicpowerlink3Cmd();
			$part1Trouble->setName(__('Partition 1 - trouble', __FILE__));
		}
		$part1Trouble->setLogicalId('part1Trouble');
		$part1Trouble->setEqLogic_id($this->getId());
		$part1Trouble->setType('info');
		$part1Trouble->setSubType('binary');
		$part1Trouble->save();
		
		// Partition 1 : fireBit
		$part1Fire = $this->getCmd(null, 'part1Fire');
		if (!is_object($part1Fire)) {
			$part1Fire = new visonicpowerlink3Cmd();
			$part1Fire->setName(__('Partition 1 - Feu', __FILE__));
		}
		$part1Fire->setLogicalId('part1Fire');
		$part1Fire->setEqLogic_id($this->getId());
		$part1Fire->setType('info');
		$part1Fire->setSubType('binary');
		$part1Fire->save();
		
		
		// Partition 2 : state
		$part2State = $this->getCmd(null, 'part2State');
		if (!is_object($part2State)) {
			$part2State = new visonicpowerlink3Cmd();
			$part2State->setName(__('Partition 2 - état', __FILE__));
		}
		$part2State->setLogicalId('part2State');
		$part2State->setEqLogic_id($this->getId());
		$part2State->setType('info');
		$part2State->setSubType('string');
		$part2State->save();
		
		// Partition 2 : memoryBit
		$part2Memory = $this->getCmd(null, 'part2Memory');
		if (!is_object($part2Memory)) {
			$part2Memory = new visonicpowerlink3Cmd();
			$part2Memory->setName(__('Partition 2 - mémoire alarme', __FILE__));
		}
		$part2Memory->setLogicalId('part2Memory');
		$part2Memory->setEqLogic_id($this->getId());
		$part2Memory->setType('info');
		$part2Memory->setSubType('binary');
		$part2Memory->save();
		
		// Partition 2 : readyBit
		$part2Ready = $this->getCmd(null, 'part2Ready');
		if (!is_object($part2Ready)) {
			$part2Ready = new visonicpowerlink3Cmd();
			$part2Ready->setName(__('Partition 2 - prête', __FILE__));
		}
		$part2Ready->setLogicalId('part2Ready');
		$part2Ready->setEqLogic_id($this->getId());
		$part2Ready->setType('info');
		$part2Ready->setSubType('binary');
		$part2Ready->save();
		
		// Partition 2 : alertBit
		$part2Alert = $this->getCmd(null, 'part2Alert');
		if (!is_object($part2Alert)) {
			$part2Alert = new visonicpowerlink3Cmd();
			$part2Alert->setName(__('Partition 2 - alerte', __FILE__));
		}
		$part2Alert->setLogicalId('part2Alert');
		$part2Alert->setEqLogic_id($this->getId());
		$part2Alert->setType('info');
		$part2Alert->setSubType('binary');
		$part2Alert->save();
		
		// Partition 2 : troubleBit
		$part2Trouble = $this->getCmd(null, 'part2Trouble');
		if (!is_object($part2Trouble)) {
			$part2Trouble = new visonicpowerlink3Cmd();
			$part2Trouble->setName(__('Partition 2 - trouble', __FILE__));
		}
		$part2Trouble->setLogicalId('part2Trouble');
		$part2Trouble->setEqLogic_id($this->getId());
		$part2Trouble->setType('info');
		$part2Trouble->setSubType('binary');
		$part2Trouble->save();
		
		// Partition 2 : fireBit
		$part2Fire = $this->getCmd(null, 'part2Fire');
		if (!is_object($part2Fire)) {
			$part2Fire = new visonicpowerlink3Cmd();
			$part2Fire->setName(__('Partition 2 - Feu', __FILE__));
		}
		$part2Fire->setLogicalId('part2Fire');
		$part2Fire->setEqLogic_id($this->getId());
		$part2Fire->setType('info');
		$part2Fire->setSubType('binary');
		$part2Fire->save();
		
		
		
		// Partition 3 : state
		$part3State = $this->getCmd(null, 'part3State');
		if (!is_object($part3State)) {
			$part3State = new visonicpowerlink3Cmd();
			$part3State->setName(__('Partition 3 - état', __FILE__));
		}
		$part3State->setLogicalId('part3State');
		$part3State->setEqLogic_id($this->getId());
		$part3State->setType('info');
		$part3State->setSubType('string');
		$part3State->save();
				
		// Partition 3 : memoryBit
		$part3Memory = $this->getCmd(null, 'part3Memory');
		if (!is_object($part3Memory)) {
			$part3Memory = new visonicpowerlink3Cmd();
			$part3Memory->setName(__('Partition 3 - mémoire alarme', __FILE__));
		}
		$part3Memory->setLogicalId('part3Memory');
		$part3Memory->setEqLogic_id($this->getId());
		$part3Memory->setType('info');
		$part3Memory->setSubType('binary');
		$part3Memory->save();
		
		// Partition 3 : readyBit
		$part3Ready = $this->getCmd(null, 'part3Ready');
		if (!is_object($part3Ready)) {
			$part3Ready = new visonicpowerlink3Cmd();
			$part3Ready->setName(__('Partition 3 - prête', __FILE__));
		}
		$part3Ready->setLogicalId('part3Ready');
		$part3Ready->setEqLogic_id($this->getId());
		$part3Ready->setType('info');
		$part3Ready->setSubType('binary');
		//->setOrder(1);
		$part3Ready->save();
		
		// Partition 3 : alertBit
		$part3Alert = $this->getCmd(null, 'part3Alert');
		if (!is_object($part3Alert)) {
			$part3Alert = new visonicpowerlink3Cmd();
			$part3Alert->setName(__('Partition 3 - alerte', __FILE__));
		}
		$part3Alert->setLogicalId('part3Alert');
		$part3Alert->setEqLogic_id($this->getId());
		$part3Alert->setType('info');
		$part3Alert->setSubType('binary');
		$part3Alert->save();
		
		// Partition 3 : troubleBit
		$part3Trouble = $this->getCmd(null, 'part3Trouble');
		if (!is_object($part3Trouble)) {
			$part3Trouble = new visonicpowerlink3Cmd();
			$part3Trouble->setName(__('Partition 3 - trouble', __FILE__));
		}
		$part3Trouble->setLogicalId('part3Trouble');
		$part3Trouble->setEqLogic_id($this->getId());
		$part3Trouble->setType('info');
		$part3Trouble->setSubType('binary');
		$part3Trouble->save();
		
		// Partition 3 : fireBit
		$part3Fire = $this->getCmd(null, 'part3Fire');
		if (!is_object($part3Fire)) {
			$part3Fire = new visonicpowerlink3Cmd();
			$part3Fire->setName(__('Partition 3 - Feu', __FILE__));
		}
		$part3Fire->setLogicalId('part3Fire');
		$part3Fire->setEqLogic_id($this->getId());
		$part3Fire->setType('info');
		$part3Fire->setSubType('binary');
		$part3Fire->save();
		
		
		
		// BatteryLevel
		$batteryLevel = $this->getCmd(null, 'batteryLevel');
		if (!is_object($batteryLevel)) {
			$batteryLevel = new visonicpowerlink3Cmd();
			$batteryLevel->setName(__('Niveau de la batterie', __FILE__));
		}
		$batteryLevel->setLogicalId('batteryLevel');
		$batteryLevel->setEqLogic_id($this->getId());
		$batteryLevel->setType('info');
		$batteryLevel->setSubType('numeric');
		$batteryLevel->setUnite('%');
		$batteryLevel->save();
		
		
		// Low battery
		$batteryLow = $this->getCmd(null, 'batteryLow');
		if (!is_object($batteryLow)) {
			$batteryLow = new visonicpowerlink3Cmd();
			$batteryLow->setName(__('Batterie faible', __FILE__));
		}
		$batteryLow->setLogicalId('batteryLow');
		$batteryLow->setEqLogic_id($this->getId());
		$batteryLow->setType('info');
		$batteryLow->setSubType('binary');
		$batteryLow->save();
		
		// AC Trouble
		$acTrouble = $this->getCmd(null, 'acTrouble');
		if (!is_object($acTrouble)) {
			$acTrouble = new visonicpowerlink3Cmd();
			$acTrouble->setName(__('Problème d\'alimentation', __FILE__));
		}
		$acTrouble->setLogicalId('acTrouble');
		$acTrouble->setEqLogic_id($this->getId());
		$acTrouble->setType('info');
		$acTrouble->setSubType('binary');
		$acTrouble->save();
		
		
		// Communication failure
		$communicationFailure = $this->getCmd(null, 'communicationFailure');
		if (!is_object($communicationFailure)) {
			$communicationFailure = new visonicpowerlink3Cmd();
			$communicationFailure->setName(__('Problème de communication', __FILE__));
		}
		$communicationFailure->setLogicalId('communicationFailure');
		$communicationFailure->setEqLogic_id($this->getId());
		$communicationFailure->setType('info');
		$communicationFailure->setSubType('binary');
		$communicationFailure->save();
		
		// Jamming trouble
		$jammingTrouble = $this->getCmd(null, 'jammingTrouble');
		if (!is_object($jammingTrouble)) {
			$jammingTrouble = new visonicpowerlink3Cmd();
			$jammingTrouble->setName(__('Problème de brouillage', __FILE__));
		}
		$jammingTrouble->setLogicalId('jammingTrouble');
		$jammingTrouble->setEqLogic_id($this->getId());
		$jammingTrouble->setType('info');
		$jammingTrouble->setSubType('binary');
		$jammingTrouble->save();
		
		// Line failure
		$lineFailure = $this->getCmd(null, 'lineFailure');
		if (!is_object($lineFailure)) {
			$lineFailure = new visonicpowerlink3Cmd();
			$lineFailure->setName(__('Problème sur la ligne réseau', __FILE__));
		}
		$lineFailure->setLogicalId('lineFailure');
		$lineFailure->setEqLogic_id($this->getId());
		$lineFailure->setType('info');
		$lineFailure->setSubType('binary');
		$lineFailure->save();		
		
		// Fuse trouble
		$fuseTrouble = $this->getCmd(null, 'fuseTrouble');
		if (!is_object($fuseTrouble)) {
			$fuseTrouble = new visonicpowerlink3Cmd();
			$fuseTrouble->setName(__('Problème de fusible', __FILE__));
		}
		$fuseTrouble->setLogicalId('fuseTrouble');
		$fuseTrouble->setEqLogic_id($this->getId());
		$fuseTrouble->setType('info');
		$fuseTrouble->setSubType('binary');
		$fuseTrouble->save();
		
		
		
		// Refresh
		$refresh = $this->getCmd(null, 'refresh');
		if (!is_object($refresh)) {
			$refresh = new visonicpowerlink3Cmd();
			$refresh->setName(__('Rafraichir', __FILE__));
		}
		$refresh->setEqLogic_id($this->getId());
		$refresh->setLogicalId('refresh');
		$refresh->setType('action');
		$refresh->setSubType('other');
		$refresh->save();
		
		
		
		// Désarmement
		$disarmPart1 = $this->getCmd(null, 'disarmPart1');
		if (!is_object($disarmPart1)) {
			$disarmPart1 = new visonicpowerlink3Cmd();
			$disarmPart1->setName(__('Désarmer partition 1', __FILE__));
		}
		$disarmPart1->setEqLogic_id($this->getId());
		$disarmPart1->setLogicalId('disarmPart1');
		$disarmPart1->setType('action');
		$disarmPart1->setSubType('other');
		$disarmPart1->setIsVisible(0);
		$disarmPart1->save();
				
		$disarmPart2 = $this->getCmd(null, 'disarmPart2');
		if (!is_object($disarmPart2)) {
			$disarmPart2 = new visonicpowerlink3Cmd();
			$disarmPart2->setName(__('Désarmer partition 2', __FILE__));
		}
		$disarmPart2->setEqLogic_id($this->getId());
		$disarmPart2->setLogicalId('disarmPart2');
		$disarmPart2->setType('action');
		$disarmPart2->setSubType('other');
		$disarmPart2->setIsVisible(0);
		$disarmPart2->save();
		
		$disarmPart3 = $this->getCmd(null, 'disarmPart3');
		if (!is_object($disarmPart3)) {
			$disarmPart3 = new visonicpowerlink3Cmd();
			$disarmPart3->setName(__('Désarmer partition 3', __FILE__));
		}
		$disarmPart3->setEqLogic_id($this->getId());
		$disarmPart3->setLogicalId('disarmPart3');
		$disarmPart3->setType('action');
		$disarmPart3->setSubType('other');
		$disarmPart3->setIsVisible(0);
		$disarmPart3->save();
		
		$disarmAllParts = $this->getCmd(null, 'disarmAllParts');
		if (!is_object($disarmAllParts)) {
			$disarmAllParts = new visonicpowerlink3Cmd();
			$disarmAllParts->setName(__('Désarmer toutes les partitions', __FILE__));
		}
		$disarmAllParts->setEqLogic_id($this->getId());
		$disarmAllParts->setLogicalId('disarmAllParts');
		$disarmAllParts->setType('action');
		$disarmAllParts->setSubType('other');
		$disarmAllParts->setIsVisible(0);
		$disarmAllParts->save();
		
		
		
		// Armement total
		$armAwayPart1 = $this->getCmd(null, 'armAwayPart1');
		if (!is_object($armAwayPart1)) {
			$armAwayPart1 = new visonicpowerlink3Cmd();
			$armAwayPart1->setName(__('Armer total partition 1', __FILE__));
		}
		$armAwayPart1->setEqLogic_id($this->getId());
		$armAwayPart1->setLogicalId('armAwayPart1');
		$armAwayPart1->setType('action');
		$armAwayPart1->setSubType('other');
		$armAwayPart1->setIsVisible(0);
		$armAwayPart1->save();
		
		$armAwayPart2 = $this->getCmd(null, 'armAwayPart2');
		if (!is_object($armAwayPart2)) {
			$armAwayPart2 = new visonicpowerlink3Cmd();
			$armAwayPart2->setName(__('Armer total partition 2', __FILE__));
		}
		$armAwayPart2->setEqLogic_id($this->getId());
		$armAwayPart2->setLogicalId('armAwayPart2');
		$armAwayPart2->setType('action');
		$armAwayPart2->setSubType('other');
		$armAwayPart2->setIsVisible(0);
		$armAwayPart2->save();
		
		$armAwayPart3 = $this->getCmd(null, 'armAwayPart3');
		if (!is_object($armAwayPart3)) {
			$armAwayPart3 = new visonicpowerlink3Cmd();
			$armAwayPart3->setName(__('Armer total partition 3', __FILE__));
		}
		$armAwayPart3->setEqLogic_id($this->getId());
		$armAwayPart3->setLogicalId('armAwayPart3');
		$armAwayPart3->setType('action');
		$armAwayPart3->setSubType('other');
		$armAwayPart3->setIsVisible(0);
		$armAwayPart3->save();
		
		$armAwayAllParts = $this->getCmd(null, 'armAwayAllParts');
		if (!is_object($armAwayAllParts)) {
			$armAwayAllParts = new visonicpowerlink3Cmd();
			$armAwayAllParts->setName(__('Armer total toutes les partitions', __FILE__));
		}
		$armAwayAllParts->setEqLogic_id($this->getId());
		$armAwayAllParts->setLogicalId('armAwayAllParts');
		$armAwayAllParts->setType('action');
		$armAwayAllParts->setSubType('other');
		$armAwayAllParts->setIsVisible(0);
		$armAwayAllParts->save();
		
		
		
		// Armement partiel
		$armHomePart1 = $this->getCmd(null, 'armHomePart1');
		if (!is_object($armHomePart1)) {
			$armHomePart1 = new visonicpowerlink3Cmd();
			$armHomePart1->setName(__('Armer partiel partition 1', __FILE__));
		}
		$armHomePart1->setEqLogic_id($this->getId());
		$armHomePart1->setLogicalId('armHomePart1');
		$armHomePart1->setType('action');
		$armHomePart1->setSubType('other');
		$armHomePart1->setIsVisible(0);
		$armHomePart1->save();
		
		$armHomePart2 = $this->getCmd(null, 'armHomePart2');
		if (!is_object($armHomePart2)) {
			$armHomePart2 = new visonicpowerlink3Cmd();
			$armHomePart2->setName(__('Armer partiel partition 2', __FILE__));
		}
		$armHomePart2->setEqLogic_id($this->getId());
		$armHomePart2->setLogicalId('armHomePart2');
		$armHomePart2->setType('action');
		$armHomePart2->setSubType('other');
		$armHomePart2->setIsVisible(0);
		$armHomePart2->save();
		
		$armHomePart3 = $this->getCmd(null, 'armHomePart3');
		if (!is_object($armHomePart3)) {
			$armHomePart3 = new visonicpowerlink3Cmd();
			$armHomePart3->setName(__('Armer partiel partition 3', __FILE__));
		}
		$armHomePart3->setEqLogic_id($this->getId());
		$armHomePart3->setLogicalId('armHomePart3');
		$armHomePart3->setType('action');
		$armHomePart3->setSubType('other');
		$armHomePart3->setIsVisible(0);
		$armHomePart3->save();
		
		$armHomeAllParts = $this->getCmd(null, 'armHomeAllParts');
		if (!is_object($armHomeAllParts)) {
			$armHomeAllParts = new visonicpowerlink3Cmd();
			$armHomeAllParts->setName(__('Armer partiel toutes les partitions', __FILE__));
		}
		$armHomeAllParts->setEqLogic_id($this->getId());
		$armHomeAllParts->setLogicalId('armHomeAllParts');
		$armHomeAllParts->setType('action');
		$armHomeAllParts->setSubType('other');
		$armHomeAllParts->setIsVisible(0);
		$armHomeAllParts->save();

		
		
		log::add('visonicpowerlink3', 'debug', 'postSave end');
    }

 // Fonction exécutée automatiquement avant la suppression de l'équipement 
    public function preRemove() {
        
    }

 // Fonction exécutée automatiquement après la suppression de l'équipement 
    public function postRemove() {
        
    }

    /*
     * Non obligatoire : permet de modifier l'affichage du widget (également utilisable par les commandes)
      public function toHtml($_version = 'dashboard') {

      }
     */

    /*
     * Non obligatoire : permet de déclencher une action après modification de variable de configuration
    public static function postConfig_<Variable>() {
    }
     */

    /*
     * Non obligatoire : permet de déclencher une action avant modification de variable de configuration
    public static function preConfig_<Variable>() {
    }
     */

    /*     * **********************Getteur Setteur*************************** */
	
	
	/*     * **********************Méthodes perso**************************** */
	
	// Error code for a non registred client
	const NOT_REGISTRED_ERROR = '-32001';
	const PORT_DEFAUT = "8181";
	
	
	public function registerClient() {
		log::add('visonicpowerlink3', 'debug', 'registerClient - Begin');
		
		$ipAlarme = $this->getConfiguration("ipAlarme");
		$port = $this->getConfiguration("port", PORT_DEFAUT);
		$ipJeedom = $this->getConfiguration("ipJeedom");
		$codeAlarme = $this->getConfiguration("codeAlarme");
		
	  $curl = curl_init();
	  //$curl=prepareJsonRpcCall("PmaxService/getPanelStatuses", $curl);


	  curl_setopt_array($curl, array(
		CURLOPT_PORT => $port,
		CURLOPT_URL => "http://".$ipAlarme.":".$port."/remote/json-rpc", 
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "{\n\t\"params\": [\"".$ipJeedom."\", ".$codeAlarme.", \"user\"],\n\t\"jsonrpc\": \"2.0\",\n\t\"method\": \"PmaxService/registerClient\", \n\t\"id\":11\n}",
		CURLOPT_HTTPHEADER => array(
		  "Content-Type: application/json"
		),
	  ));




	  $response = curl_exec($curl);
	  


	  //log::add('visonicpowerlink3', 'debug', 'getPanelState - response : '.$response);

	  curl_close($curl);

	   if ($response === false || strpos($response, 'error') !== false) {

			if ($response === false) {
				$err = curl_error($curl);
				log::add('visonicpowerlink3', 'error', 'registerClient - Error curl : '.$err);
			} 
			else {
				log::add('visonicpowerlink3', 'error', 'registerClient - Error in response : '.$response);
			}
		}
/*
	  else {
		  
	  }
		*/

		log::add('visonicpowerlink3', 'debug', 'registerClient - End');
	}
	
	
	public function setPanelState($state, $partId) {

		log::add('visonicpowerlink3', 'debug', 'setPanelState - Begin');
		log::add('visonicpowerlink3', 'infos', 'setPanelState : '.$state." - Partition : ".$partId);
		
		$ipAlarme = $this->getConfiguration("ipAlarme");
		$port = $this->getConfiguration("port", PORT_DEFAUT);
		$codeAlarme = $this->getConfiguration("codeAlarme");
/*		
		$autorisationUsageCodeArmentDesarmement = $this->getConfiguration("autorisationUsageCodeArmentDesarmement");

		$autorisationUtilisationCode = false;

		if ($autorisationUsageCodeArmentDesarmement == "1") {
			$autorisationUtilisationCode = true;
			$codeAlarme = $this->getConfiguration("codeAlarme");
		}
		else {
			$codeAlarme = $this->getEqLogic().getMessage();
		}
		*/
	  $curl = curl_init();
	  //$curl=prepareJsonRpcCall("PmaxService/setPanelStatuses", $curl);


	  curl_setopt_array($curl, array(
		CURLOPT_PORT => $port,
		CURLOPT_URL => "http://".$ipAlarme.":".$port."/remote/json-rpc", 
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "{\n\t\"params\": [\"".$codeAlarme."\",\"".$state."\",".$partId.",true,true],\n\t\"jsonrpc\": \"2.0\",\n\t\"method\": \"PmaxService/setPanelState\", \n\t\"id\":12\n}",
		CURLOPT_HTTPHEADER => array(
		  "Content-Type: application/json"
		),
	  ));
	  
	  


	  $response = curl_exec($curl);
	  


	  //log::add('visonicpowerlink3', 'debug', 'setPanelState - response : '.$response);

	  curl_close($curl);

	   if ($response === false || strpos($response, 'error') !== false) {

			if ($response === false) {
				$err = curl_error($curl);
				log::add('visonicpowerlink3', 'error', 'setPanelState - Error curl : '.$err);
			} 
			else {
				log::add('visonicpowerlink3', 'error', 'setPanelState - Error in response : '.$response);
			}
		}

//	  else {
		  
//	  }
		

		log::add('visonicpowerlink3', 'debug', 'setPanelState - End');
	}
	
	
	public function getPanelState() {
		
		log::add('visonicpowerlink3', 'debug', 'getPanelState - Begin');
		
		$ipAlarme = $this->getConfiguration("ipAlarme");
		$port = $this->getConfiguration("port", PORT_DEFAUT);
		
	  $curl = curl_init();
	  //$curl=prepareJsonRpcCall("PmaxService/getPanelStatuses", $curl);

	  curl_setopt_array($curl, array(
		CURLOPT_PORT => $port,
		CURLOPT_URL => "http://".$ipAlarme.":".$port."/remote/json-rpc", 
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "{\n\t\"params\": null,\n\t\"jsonrpc\": \"2.0\",\n\t\"method\": \"PmaxService/getPanelStatuses\", \n\t\"id\":1\n}",
		CURLOPT_HTTPHEADER => array(
		  "Content-Type: application/json"
		),
	  ));

	  $response = curl_exec($curl);
	  $err = curl_error($curl);

	  //log::add('visonicpowerlink3', 'debug', 'getPanelState - response : '.$response);

	  curl_close($curl);

	   if ($err || strpos($response, 'error') !== false) {

			if ($err != '') {
				log::add('visonicpowerlink3', 'error', 'getPanelStatuses - Error curl : '.$err);
			}
			else if (strpos($response, NOT_REGISTRED_ERROR) != false) {
				// TODO : gérer le non enregistré !!!
				log::add('visonicpowerlink3', 'error', 'getPanelStatuses - Client not registred');
			}
			else {
				log::add('visonicpowerlink3', 'error', 'getPanelStatuses - Error in response : '.$response);
			}
		}

	  else {
		//log::add('visonic', 'debug', 'getPanelStatuses - réponse :'.$response);

		$res=json_decode($response);
		$status = $res->{'result'}->{'statuses'};
		
		// Set values
		$this->checkAndUpdateCmd('batteryLow', $status->{'lowBattery'});
		$this->checkAndUpdateCmd('acTrouble', $status->{'acTrouble'});
		$this->checkAndUpdateCmd('communicationFailure', $status->{'communicationFailure'});
		$this->checkAndUpdateCmd('jammingTrouble', $status->{'jammingTrouble'});
		$this->checkAndUpdateCmd('lineFailure', $status->{'lineFailure'});
		$this->checkAndUpdateCmd('fuseTrouble', $status->{'fuseTrouble'});


		// Etat de chaque partition
		for ($i=0 ; $i < count($res->{'result'}->{'partitions'}) && $i < 3 ; $i++) {

			$val = $res->{'result'}->{'partitions'}[$i];
			$indicePart=$val->{'partition'}-1;

			// Partition - state
			$this->checkAndUpdateCmd('part'.($indicePart+1).'State', $val->{'state'});
			
			$status = $val->{'statuses'};
			$this->checkAndUpdateCmd('part'.($indicePart+1).'Memory', $status->{'memoryBit'});
			$this->checkAndUpdateCmd('part'.($indicePart+1).'Ready', $status->{'readyBit'});
			$this->checkAndUpdateCmd('part'.($indicePart+1).'Alert', $status->{'alertBit'});
			$this->checkAndUpdateCmd('part'.($indicePart+1).'Trouble', $status->{'troubleBit'});
			$this->checkAndUpdateCmd('part'.($indicePart+1).'Fire', $status->{'fireBit'});
		}	
	
		log::add('visonicpowerlink3', 'debug', 'getPanelState - End');
		
		}
	}
	
	
	
	public function getBatteryLevel() {
		
		
		log::add('visonicpowerlink3', 'debug', 'getBatteryLevel - Begin');
		
		$ipAlarme = $this->getConfiguration("ipAlarme");
		$port = $this->getConfiguration("port", PORT_DEFAUT);
		
		$curl = curl_init();
		
		// Todo : paramètrs pour time outs et max redirection
		curl_setopt_array($curl, array(
		CURLOPT_PORT => $port,
		CURLOPT_URL => "http://".$ipAlarme.":".$port."/remote/json-rpc", 
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "{\n\t\"params\": null,\n\t\"jsonrpc\": \"2.0\",\n\t\"method\": \"PmaxService/getBatteryLevel\", \n\t\"id\":1\n}",
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json"
		),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err || strpos($response, 'error') !== false) {

			if ($err != '') {
				log::add('visonicpowerlink3', 'error', 'getBatteryLevel - Error curl : '.$err);
			}
			else if (strpos($response, NOT_REGISTRED_ERROR) != false) {
				// TODO : gérer le non enregistré !!!
				log::add('visonicpowerlink3', 'error', 'getBatteryLevel - Client not registred');
			}
			else {
				log::add('visonicpowerlink3', 'error', 'getBatteryLevel - Error in response : '.$response);
			}
		}
		else {
			//log::add('visonicpowerlink3', 'debug', 'getBatteryLevel - response : '.$response);
			
			$res=json_decode($response);
			$val=json_decode($res->{'result'});
			
			$this->batteryStatus($val); // set jeedom battery level
			$this->checkAndUpdateCmd('batteryLevel', $val);
		}
		
		
		log::add('visonicpowerlink3', 'debug', 'getBatteryLevel - End');
	}
	
	
	
	

} // End of class

class visonicpowerlink3Cmd extends cmd {
    /*     * *************************Attributs****************************** */
    
    /*
      public static $_widgetPossibility = array();
    */
    
    /*     * ***********************Methode static*************************** */


    /*     * *********************Methode d'instance************************* */

    /*
     * Non obligatoire permet de demander de ne pas supprimer les commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
      public function dontRemoveCmd() {
      return true;
      }
     */

  // Exécution d'une commande  
     public function execute($_options = array()) {
		$eqlogic = $this->getEqLogic();
		switch ($this->getLogicalId()) { 
			
			case 'refresh': // Refresh all
				$eqlogic->registerClient();
				$eqlogic->getPanelState();
				$eqlogic->getBatteryLevel();
				
			break;
			
			case 'refreshPartial': // Refresh panel state
				$eqlogic->getPanelState();
			break;
			
			// Disarm
			case 'disarmPart1':
				$eqlogic->setPanelState("DISARM", 1);
				$eqlogic->getPanelState();
			break;
			
			case 'disarmPart2':
				$eqlogic->setPanelState("DISARM", 2);
				$eqlogic->getPanelState();
			break;

			case 'disarmPart3':
				$eqlogic->setPanelState("DISARM", 3);
				$eqlogic->getPanelState();
			break;

			case 'disarmAllParts':
				$eqlogic->setPanelState("DISARM", 1);
				$eqlogic->setPanelState("DISARM", 2);
				$eqlogic->setPanelState("DISARM", 3);
				$eqlogic->getPanelState();
			break;


			// Arm away (not at home)
			case 'armAwayPart1':
				$eqlogic->setPanelState("AWAY", 1);
				$eqlogic->getPanelState();
			break;
			
			case 'armAwayPart2':
				$eqlogic->setPanelState("AWAY", 2);
				$eqlogic->getPanelState();
			break;

			case 'armAwayPart3':
				$eqlogic->setPanelState("AWAY", 3);
				$eqlogic->getPanelState();
			break;

			case 'armAwayAllParts':
				$eqlogic->setPanelState("AWAY", 1);
				$eqlogic->setPanelState("AWAY", 2);
				$eqlogic->setPanelState("AWAY", 3);
				$eqlogic->getPanelState();
			break;
			
			
			
			// Arm home
			case 'armHomePart1':
				$eqlogic->setPanelState("HOME", 1);
				$eqlogic->getPanelState();
			break;
			
			case 'armHomePart2':
				$eqlogic->setPanelState("HOME", 2);
				$eqlogic->getPanelState();
			break;

			case 'armHomePart3':
				$eqlogic->setPanelState("HOME", 3);
				$eqlogic->getPanelState();
			break;

			case 'armHomeAllParts':
				$eqlogic->setPanelState("HOME", 1);
				$eqlogic->setPanelState("HOME", 2);
				$eqlogic->setPanelState("HOME", 3);
				$eqlogic->getPanelState();
			break;
			
		}
     }

    /*     * **********************Getteur Setteur*************************** */
}


