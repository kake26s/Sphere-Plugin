<?php

namespace main;

#plugin & eventlistener & player
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
#item
use pocketmine\item\Item;
#level
use pocketmine\level\Level;
#vector
use pocketmine\math\Vector3;
#particle
use pocketmine\level\particle\FlameParticle;
#event
use pocketmine\event\player\PlayerInteractEvent;

class Main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getLogger()->info('読み込まれました');
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onPlayerInteract(PlayerInteractEvent $e){
		$pl = $e->getPlayer();
		$itemid = $pl->getItemInHand()->getid();
		if($itemid == 280){ //stick
			$amW = 18;
			$amY = 18; //一線に表示するパーティクルの個数

			$size = 3;

			$x = $pl->getX();
			$y = $pl->getY() + 1;
			$z = $pl->getZ();

			for($i = 0; $i <= 360; $i += $amW){
				for($j = -90; $j <= 90; $j += $amY){
					$mX = -sin($i * pi()/180) * cos($j * pi()/180);
					$mY = -sin($j * pi()/180);
					$mZ = cos($i * pi()/180) * cos($j * pi()/180);

					$cX = $mX * $size + $x;
					$cY = $mY * $size + $y;
					$cZ = $mZ * $size + $z;

					$ver = new Vector3($cX, $cY, $cZ);
					$pl->getLevel()->addParticle(new FlameParticle($ver));
				}
			}
		}
	}
}