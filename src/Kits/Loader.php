<?php


namespace Kits;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;

use pocketmine\entity\Effect;
use pocketmine\item\Item;

use pocketmine\utils\Config;
use pocketmine\utils\Random;

use pocketmine\utils\TextFormat as color;

use pocketmine\permission\Permission;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginManager;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

use pocketmine\level\sound\AnvilUseSound;
use pocketmine\level\sound\GhastSound;

use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerDropItemEvent;

class Loader extends PluginBase implements Listener{
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        
        $prefix = "§2[§6KITS§2] ";
        $prefixD = "§e>§7--------§e*§7--------§e<";
        $sound1 = $sender->getPlayer();
        
        switch($command->getName()){
            case "kit":
            
                if(isset($args[0])){
                    if($sender instanceof Player){
                    switch(strtolower($args[0])){
                        
                        case "pvp":
                            if(!$sender->hasPermission("kit.pvp.command")){
                            $sender->sendMessage("§cVocê não tem acesso a este comando!");
                            break;
                            }
                            $sender->getPlayer()->getInventory()->clearAll();
                            $sender->getPlayer()->removeAllEffects();
                            
                            $sender->getInventory()->addItem(Item::get(276, 0, 1));
                            $sender->getInventory()->addItem(Item::get(282, 0, 1));
                            
                            $sender->getInventory()->setHelmet(Item::get(306, 0, 1));
                            $sender->getInventory()->setChestplate(Item::get(307, 0, 1));
                            $sender->getInventory()->setLeggings(Item::get(308, 0, 1));
                            $sender->getInventory()->setBoots(Item::get(309, 0, 1));
                            $sender->sendMessage($prefix."§aVocê recebeu Kit §cPVP");
                            $sound1->getLevel()->addSound(new AnvilUseSound($sound1));
                            break;
                        case "viper":
                            if(!$sender->hasPermission("kit.viper.command")){
                            $sender->sendMessage("§cVocê não tem acesso a este comando!");
                            break;
                            }
                            $sender->getPlayer()->getInventory()->clearAll();
                            $sender->getPlayer()->removeAllEffects();
                            
                            $sender->getInventory()->addItem(Item::get(267, 0, 1));
                            $sender->getInventory()->addItem(Item::get(282, 0, 1));
                            $sender->getInventory()->addItem(Item::get(376, 0, 1));
                            
                            $sender->getInventory()->setHelmet(Item::get(306, 0, 1));
                            $sender->getInventory()->setChestplate(Item::get(307, 0, 1));
                            $sender->getInventory()->setLeggings(Item::get(308, 0, 1));
                            $sender->getInventory()->setBoots(Item::get(309, 0, 1));
                            $sender->sendMessage($prefix."§aVocê recebeu Kit §cVIPER");
                            $sound1->getLevel()->addSound(new AnvilUseSound($sound1));
                            break;
                        case "pyromancer":
                            if(!$sender->hasPermission("kit.pyromancer.command")){
                            $sender->sendMessage("§cVocê não tem acesso a este comando!");
                            break;
                            }
                            $sender->getPlayer()->getInventory()->clearAll();
                            $sender->getPlayer()->removeAllEffects();
                            
                            $sender->getInventory()->addItem(Item::get(267, 0, 1));
                            $sender->getInventory()->addItem(Item::get(282, 0, 1));
                            $sender->getInventory()->addItem(Item::get(259, 0, 1));
                            $sender->getInventory()->addItem(Item::get(46, 0, 5));
                            
                            $sender->getInventory()->setHelmet(Item::get(306, 0, 1));
                            $sender->getInventory()->setChestplate(Item::get(307, 0, 1));
                            $sender->getInventory()->setLeggings(Item::get(308, 0, 1));
                            $sender->getInventory()->setBoots(Item::get(309, 0, 1));
                            $sender->sendMessage($prefix."§aVocê recebeu Kit §cPYROMANCER");
                            $sound1->getLevel()->addSound(new AnvilUseSound($sound1));
                            break;
                    }       
                }
                }
                return false;
            case "kits":
                $sender->sendMessage($prefixD);
                $sender->sendMessage(" ");
                $sender->sendMessage($prefix."§a/kit <name>");
                $sender->sendMessage($prefix."§aKit PvP");
                $sender->sendMessage($prefix."§aKit Viper");
                $sender->sendMessage($prefix."§aKit Pyromancer");
                $sender->sendMessage(" ");
                $sender->sendMessage($prefixD);
        }
    
    }
    
    public function PlayerJoinEvent(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $name = $event->getPlayer()->getName();
        $prefix = "§2[§6KITS§2] ";
        $prefixD = "§e>§7--------*--------§e<";
        
        $player->getPlayer()->getInventory()->clearAll();
        
        $player->sendMessage($prefixD);
        $player->sendMessage(" ");
        $player->sendMessage($prefix."§ause §6/kits");
        $player->sendMessage(" ");
        $player->sendMessage($prefixD);
        
        
        $player->getLevel()->addSound(new AnvilUseSound($player));
        
    }
    
    public function onDropItem(PlayerDropItemEvent $event){
        if($event->getPlayer()->getInventory()->getItemInHand()->getId() == 376){
            $event->getPlayer()->sendMessage("§cVocê não pode Dropar este Item!");
            $event->setCancelled();
        }
        if($event->getPlayer()->getInventory()->getItemInHand()->getId() == 256){
            $event->getPlayer()->sendMessage("§cVocê não pode Dropar este Item!");
            $event->setCancelled();
        }
        if($event->getPlayer()->getInventory()->getItemInHand()->getId() == 46){
            $event->getPlayer()->sendMessage("§cVocê não pode Dropar este Item!");
            $event->setCancelled();
        }
    }
    
       public function onHurt(EntityDamageEvent $event){
	if($event instanceof EntityDamageByEntityEvent){
	   $damager = $event->getDamager();
			if($damager instanceof Player){
                        if($damager->getInventory()->getItemInHand()->getId() === 376){
				$event->getEntity()->addEffect(Effect::getEffect(19)->setAmplifier(0)->setDuration(80)->setVisible(true));
                                }
                                
                        }
               }
       }
       
        public function onUse(PlayerInteractEvent $event) {
            $player = $event->getPlayer();
            if(count($player->getEffects()) != 3) {
            if($event->getItem()->getID() == 282) {
                $player->setFood(20);
                $player->addEffect(Effect::getEffect(6)->setAmplifier(1)->setDuration(0)->setVisible(false));
		$player->sendPopup("§b§lSopa Tomada!");
                $player->getInventory()->removeItem(Item::get(282, 0, 1));
                $player->getInventory()->addItem(Item::get(281, 0, 1));
      }
            }
        }
        
        
        
       
       
}
