<?php

declare(strict_types=1);

namespace skh6075\MessageTime;

use pocketmine\event\EventPriority;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\network\mcpe\protocol\TextPacket;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

final class Loader extends PluginBase{
	public function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvent(DataPacketSendEvent::class, function(DataPacketSendEvent $event): void{
			foreach($event->getPackets() as $packet){
				if($packet instanceof TextPacket && $packet->type === TextPacket::TYPE_RAW){
					$packet->message .= " " . TextFormat::DARK_GRAY . "(" . date("A h:i") . ")";
				}
			}
		}, EventPriority::MONITOR, $this, false);
	}
}