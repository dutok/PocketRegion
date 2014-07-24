<?php
/**
 * User: Michael Leahy
 * Date: 7/22/14
 * Time: 5:25 PM
 */

namespace PocketRegion;


use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\level\Position;
use Space;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class PocketRegion extends PluginBase{

    public $plugin;

    public function onEnable(){
        $this->getLogger()->info(TextFormat::GREEN . "PocketRegion has been enabled!");
    }

    public function onDisable(){
        $this->getLogger()->info(TextFormat::GREEN . "PocketRegion has been disabled!");
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        switch($command->getName()){
            case "pos1":
                if ($sender instanceof Player) {
                    $level = trim(strtolower($sender->getLevel()->getName()));
                    $x = (int) $sender->x;
                    $y = (int) $sender->y;
                    $z = (int) $sender->z;

                    $sender->sendMessage($level . " and " . $x . " and " . $y . " and " . $z);
                    return true;
                }
                else {
                    $sender->sendMessage("You must be in-game to use this command.");
                    return true;
                }
                break;
            default:
                return false;
        }
    }

} 