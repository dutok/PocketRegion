<?php
/**
 * User: Michael Leahy
 * Date: 7/22/14
 * Time: 5:25 PM
 */

namespace PocketRegion;


use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class PocketRegion extends PluginBase{
    public function onEnable(){
        $this->getLogger()->info(TextFormat::GREEN . "PocketRegion has been enabled!");
    }

    public function onDisable(){
        $this->getLogger()->info(TextFormat::GREEN . "PocketRegion has been disabled!");
    }

} 