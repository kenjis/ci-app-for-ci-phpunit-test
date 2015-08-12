<?php

class Greeter
{
	public function greet()
	{
		$hour = date('H');

		if ($hour >= 5 && $hour < 12) {
			return 'Good morning';
		} elseif ($hour >= 12 && $hour < 18) {
			return'Good afternoon';
		} else {
			return 'Good evening';
		}
	}
}
