<?php

namespace mmui;

use pocketmine\plugin\PluginBase;
use pocketmine\Player; 
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\level\particle\DestroyBlockParticle;
use pocketmine\level\particle\{DustParticle, FlameParticle, FloatingTextParticle, EntityFlameParticle, CriticalParticle, ExplodeParticle, HeartParticle, LavaParticle, MobSpawnParticle, SplashParticle};
use pocketmine\event\player\PlayerMoveEvent;

class Main extends PluginBase implements Listener {
	
	public $plugin;
	public function onEnable(){
		$this->getLogger()->info("Mine MenuUI");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");	
	}
	
	public function onCommand(CommandSender $sender, Command $command, String $label, array $args) : bool {
        switch($command->getName()){
            case "mmui":
            $this->FormClan($sender);
            return true;
        }
        return true;
	}
	
	 public function FormClan($sender){
        $formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $formapi->createSimpleForm(function(Player $sender, $data){
          $result = $data;
          if($result === null){
          }
          switch($result){
              case 0:
              $sender->addTitle("§b§lMine §aMenu§dUI");
              case 1:
			        $command = "sell hand";
              $this->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 2:
              $command = "sell all";
              $this->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 3:
              $command = "shop";
              $this->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 4:
              $command = "enchant;
              break;
              case 5:
              $command = "ceshop";
              $this->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 6:
              $command = "hub";
              $this->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
              case 7:
              $command = "im";
              $this->getServer()->getCommandMap()->dispatch($sender, $command);
              break;
          }
        });
        $config = $this->getConfig();
        $name = $sender->getName();
        $form->setTitle("§b§lMine §aMenu§dUI");
		$form->addButton("§cBack");
		$form->addButton("§l§dSell Hand\n§r§funtuk menjual item yang ada di tanganmu");
		$form->addButton("§l§aSell All\n§r§funtuk menjual 1 jenis item langsung semua");
		$form->addButton("§l§bShop\n§r§funtuk membeli item");
        $form->addButton("§l§eEnchant\n§r§funtuk enchant item mu");
		$form->addButton("§l§aCE Shop\n§r§funtuk enchant item mu dengan enchant spesial");
		$form->addButton("§l§dHub\n§r§funtuk kembali ke lobby");
		$form->addButton("§l§bInfo Mine\n§r§finfo tentang mine");
        $form->sendToPlayer($sender);
	}
	
	public function Create($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$result = $data[0];
			if($result === null){
				return true;
			}
			$cmd = "f create $data[0]";
			$this->getServer()->getCommandMap()->dispatch($player, $cmd);
		});
		$form->setTitle("§bunknow 404");
		$form->addInput("§bInput Your Factions Name");
		$form->sendToPlayer($player);
	}
	
	public function Invite($player){
		$formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $formapi->createCustomForm(function(Player $player, $data){
			$result = $data[0];
			if($result === null){
				return true;
			}
			$cmd = "f invite $data[0]";
			$this->getServer()->getCommandMap()->dispatch($player, $cmd);
		});
		$form->setTitle("§bunknow 404");
		$form->addInput("§einvite Player");
		$form->sendToPlayer($player);
	}
}
