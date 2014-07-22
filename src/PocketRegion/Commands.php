<?php

namespace PocketRegion;

use pocketmine\event\Listener;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\level\Position;

class Commands implements Listener{

    public function __construct(PocketRegion $plugin){
        $this->plugin = $plugin;
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        switch($command->getName()){
            case "pos1":
                if ($sender instanceof Player) {
                    $level = trim(strtolower($sender->getLevel()->getName()));
                    $x = (int) $sender->x;
                    $y = (int) $sender->y;
                    $z = (int) $sender->z;

                    $pos = new Position($x, $y, $z, $level);

                    $sender->sendMessage($level, " and ", $x, " and ", $y, " and ", $z);
                    return true;
                }
                else {
                    $sender->sendMessage("You must be in-game to use this command.");
                }
                break;
            default:
                return false;
        }
    }

}