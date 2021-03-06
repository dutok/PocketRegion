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
use pocketmine\event\entity\EntityMoveEvent;
use pocketmine\entity\Human;

class PocketRegion extends PluginBase{

    public $plugin;

    private $database;

    public function onEnable(){
        @mkdir($this->getDataFolder());
        if(!file_exists($this->getDataFolder() . "regions.db")){
            $this->database = new \SQLite3($this->getDataFolder() . "regions.db", SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
            $resource = $this->getResource("sqlite3.sql");
            $this->database->exec(stream_get_contents($resource));
        }else{
            $this->database = new \SQLite3($this->getDataFolder() . "regions.db", SQLITE3_OPEN_READWRITE);
        }
        $this->getLogger()->info(TextFormat::GREEN . "PocketRegion has been enabled!");
    }

    public function onDisable(){
        $this->getLogger()->info(TextFormat::GREEN . "PocketRegion has been disabled!");
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        switch($command->getName()){
            case "define":
                if ($sender instanceof Player) {
                    if(!isset($args[1])){
                        return false;
                    }
                    $distance = (int) array_shift($args);
                    $regionName = array_shift($args);
                    $flags = "";

                    $current = $sender->getPosition();
                    $world = $current->getLevel()->getName();
                    $x = (int) $current->getX();
                    $y = (int) $current->getY();
                    $z = (int) $current->getZ();

                    $end = $current->add($sender->getDirectionVector()->multiply($distance));

                    $prepare = $this->database->prepare("INSERT INTO regions (name, flags, world, x, y, z) VALUES (:name, :flags, :world, :x, :y, :z)");
                    $prepare->bindValue(":name", $regionName, SQLITE3_TEXT);
                    $prepare->bindValue(":flags", $flags, SQLITE3_TEXT);
                    $prepare->bindValue(":world", $world, SQLITE3_TEXT);
                    $prepare->bindValue(":distance", $distance, SQLITE3_INTEGER);
                    $prepare->bindValue(":x", $x, SQLITE3_INTEGER);
                    $prepare->bindValue(":y", $y, SQLITE3_INTEGER);
                    $prepare->bindValue(":z", $z, SQLITE3_INTEGER);
                    $prepare->execute();

                    $sender->sendMessage("Region '".$regionName."' defined.");

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