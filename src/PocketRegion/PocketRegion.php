<?php

namespace PocketRegion;


use pocketmine\command\CommandExecutor;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class PocketRegion extends PluginBase{

    /** @var Commands */
    protected $listener;

    public $plugin;

    public function onEnable(){
        $this->getLogger()->info(TextFormat::GREEN . "PocketRegion has been enabled!");
        $this->listener = new Commands($this);
    }

    public function onDisable(){
        $this->getLogger()->info(TextFormat::GREEN . "PocketRegion has been disabled!");
    }

} 
