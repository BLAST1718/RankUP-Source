<?php

namespace MulkiAqi192\RankUP;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

use onebone\economyapi\EconomyAPI;

class main extends PluginBase implements Listener {

	public function onEnable(){

	}

	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {

		switch($cmd->getName()){
			case "rankup":
			 if($sender instanceof Player){
			 	$this->rank($sender);
			 }
		}
	return true;
	}

	public function rank($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$papi = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
		$crank = $papi->getUserDataMgr()->getGroup($player)->getName();
		$money = EconomyAPI::getInstance()->myMoney($player);
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
					$papi = $this->getServer()->getPluginManager()->getPlugin("PurePerms");
					$warrior = $papi->getGroup("Warrior");
					$knight = $papi->getGroup("Knight");
					$king = $papi->getGroup("King");
					$emperor = $papi->getGroup("Emperor");
					$dragon = $papi->getGroup("DRAGON");
					$guest = $papi->getGroup("Guest");
					$crank = $papi->getUserDataMgr()->getGroup($player)->getName();
					$money = EconomyAPI::getInstance()->myMoney($player);
					if($crank == "Guest"){
						if($money > 5000){
							EconomyAPI::getInstance()->reduceMoney($player, "5000");
							$ppapi->setGroup($player, $warrior);
							$player->sendMessage("§bYour rank has been upgraded to §6Warrior");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money == 5000){
							EconomyAPI::getInstance()->reduceMoney($player, "5000");
							$papi->setGroup($player, $warrior);
							$player->sendMessage("§bYour rank has been upgraded to §6Warrior");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money < 5000){
							$player->sendMessage("§cYou dont have enough money!");
							return true;
						}
					}
					if($crank == "Warrior"){
						if($money > 10000){
							EconomyAPI::getInstance()->reduceMoney($player, "10000");
							$papi->setGroup($player, $knight);
							$player->sendMessage("§bYour rank has been upgraded to §6Knight");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money == 10000){
							EconomyAPI::getInstance()->reduceMoney($player, "10000");
							$papi->setGroup($player, $knight);
							$player->sendMessage("§bYour rank has been upgraded to §6Knight");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money < 10000){
							$player->sendMessage("§cYou dont have enough money!");
							return true;
						}
					}
					if($crank == "Knight"){
						if($money > 15000){
							EconomyAPI::getInstance()->reduceMoney($player, "15000");
							$papi->setGroup($player, $king);
							$player->sendMessage("§bYour rank has been upgraded to §6King");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money == 15000){
							EconomyAPI::getInstance()->reduceMoney($player, "15000");
							$papi->setGroup($player, $king);
							$player->sendMessage("§bYour rank has been upgraded to §6King");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money < 15000){
							$player->sendMessage("§cYou dont have enough money!");
							return true;
						}
					}
					if($crank == "King"){
						if($money > 20000){
							EconomyAPI::getInstance()->reduceMoney($player, "20000");
							$papi->setGroup($player, $emperor);
							$player->sendMessage("§bYour rank has been upgraded to §6Emperor");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money == 20000){
							EconomyAPI::getInstance()->reduceMoney($player, "20000");
							$papi->setGroup($player, $emperor);
							$player->sendMessage("§bYour rank has been upgraded to §6Emperor");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money < 20000){
							$player->sendMessage("§cYou dont have enough money!");
							return true;
						}
					}
					if($crank == "Emperor"){
						if($money > 50000){
							EconomyAPI::getInstance()->reduceMoney($player, "50000");
							$papi->setGroup($player, $dragon);
							$player->sendMessage("§bYour rank has been upgraded to §6DRAGON");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money == 50000){
							EconomyAPI::getInstance()->reduceMoney($player, "50000");
							$papi->setGroup($player, $dragon);
							$player->sendMessage("§bYour rank has been upgraded to §6DRAGON");
							$player->addTitle("§bUpgraded!", "§6Your rank has been upgraded!");
							return true;
						}
						if($money < 50000){
							$player->sendMessage("§cYou dont have enough money!");
							return true;
						}
					}
					if($crank == "DRAGON"){
						$player->sendMessage("§cYou already have the higher rank!");
						return true;
					}
				break;

				case 1:

				break;
			}
		});
		$form->setTitle("§l§bRank§6UP");
		$form->setContent("§aWelcome to §bRank§6UP\n§bYour rank §7[§e" . $crank . "§7]\n§bYour money: §e$" . $money . "");
		$form->addButton("§bUpgrade Rank");
		$form->addButton("Close");
		$form->sendToPlayer($player);
		return $form;
	}

}
