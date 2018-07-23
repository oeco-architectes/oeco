<?php
namespace App\Models;

class MozaicLayout {

	const REQUIRED_SMALL = 10;
	const REQUIRED_HIGH = 20;
	const REQUIRED_LARGE = 30;

	const ITEM_SMALL       = 1;
	const ITEM_HIGH_TOP    = 2;
	const ITEM_HIGH_BOTTOM = -2;
	const ITEM_LARGE_LEFT  = 3;
	const ITEM_LARGE_RIGHT = -3;

	const DEFAULT_MAX_RETRIES = 100;
	const DEFAULT_PROBABILITY_LARGE = 0.33; // Takes precedence on HIGH
	const DEFAULT_PROBABILITY_HIGH = 0.5;

	var $layout   = null;
	var $accuracy = null;
	var $spaces   = null;

	/**
	 *
	 * @param int $items
	 * @param int $rows
	 * @param array $options Options:
	 *   - maxRetries       (default: DEFAULT_MAX_RETRIES)       Maximum number of retries before forgetting about filling the last row
	 *   - probabilityLarge (default: DEFAULT_PROBABILITY_LARGE) Probability of an item to be large (0=never ... 1=always)
	 *   - probabilityHigh  (default: DEFAULT_PROBABILITY_High)  Probability of an item to be high, while non large (0=never ... 1=always)
	 */
	public function __construct($items, $rows, array $options = null) {

		$MAX_RETRIES = isset($options['maxRetries']) ? $options['maxRetries'] : self::DEFAULT_MAX_RETRIES;
		if(is_array($items)) {
			$COUNT =
				  (isset($items[self::REQUIRED_SMALL]) ? $items[self::REQUIRED_SMALL] : 0)
				+ (isset($items[self::REQUIRED_HIGH])  ? $items[self::REQUIRED_HIGH] : 0)
				+ (isset($items[self::REQUIRED_LARGE]) ? $items[self::REQUIRED_LARGE] : 0);
			$PROBABILITY_LARGE = isset($items[self::REQUIRED_SMALL]) ? ($COUNT / $items[self::REQUIRED_SMALL]) : 0;
			$PROBABILITY_HIGH  = isset($items[self::REQUIRED_HIGH] ) ? ($COUNT / $items[self::REQUIRED_HIGH] ) : 0;
		}
		else {
			$COUNT = $items;
			$PROBABILITY_LARGE = isset($options['probabilityLarge']) ? $options['probabilityLarge'] : self::DEFAULT_PROBABILITY_LARGE;
			$PROBABILITY_HIGH  = isset($options['probabilityHigh'])  ? $options['probabilityHigh']  : self::DEFAULT_PROBABILITY_HIGH;
		}
		$ROWS = $rows;

		$this->spaces = -1;

		if(is_array($items)) {
			$candidate = null;
			$candidateSpaces = 0;
			$candidateAccuracy = 0;
		}

		// Retry until we have a complete layout (no spaces left)
		for($retries = 0 ; $retries < $MAX_RETRIES && (is_array($items) ? $candidateSpaces != 0 || $candidateAccuracy < 1 : $this->spaces != 0) ; $retries++) {

			//echo '==============================' . "\n";

			$remaining = $COUNT;
			if(is_array($items)) {
				$currentItems = $items;
			}

			/*
			if($retries == 0) {
				echo '$total = ' . $remaining . ', $ROWS = ' . $ROWS . "\n";
			}
			*/
			$previousIsHigh = array_fill(0, $ROWS, 0);
			$this->lines = array();

			for($line = 0 ; $remaining > 0; $line++) {

				$this->spaces = $line % 2 == 0 ? $ROWS : ($ROWS - array_sum($previousIsHigh)); // number of free cells on the line
				//echo '$previousIsHigh = [' . implode(',', $previousIsHigh) . '], $this->spaces = ' . $this->spaces . ', $remaining = ' . $remaining . "\n";

				$lastLine = $remaining <= $this->spaces;
				//if($lastLine) echo '==============================' . "\n";
				/*
				 if($line % 10 == 0) {
				echo '--------------------------------' . "\n";
				}
				*/
				$this->lines[$line] = array();

				for($row = 0 ; $row < $ROWS && $remaining > 0; $row++) {

					$lastIsHigh = $line % 2 == 1 && $previousIsHigh[$row];

					if($lastIsHigh) { // Cell is taken
						$previousIsHigh[$row] = 0;
						//echo '^  ';
						$this->lines[$line][$row] = -2; // RESULT: -2 == empty space (cause: previous line item is high)

						$high = false;
					}
					else { // Cell is free

						/**
						 * Determine if item is large
						 */
						if($lastLine) {
							$large = $remaining < $this->spaces && $row != ($ROWS - 1) && !$previousIsHigh[$row+1] // large if spaces too many (but not large if next is taken, or if last row)
							&& rand(0,100) >= 100 * $remaining / $this->spaces ; // highers chances while spaces left are too many
						}
						else {
							$shouldBeLarge =
								is_array($items)
								? rand(0,99) < 100 * ($currentItems[self::REQUIRED_LARGE] / $remaining)
								: rand(0,99) < 100 * $PROBABILITY_LARGE;
							//echo '$shouldBeLarge = ' . ($currentItems[self::REQUIRED_LARGE] / $remaining) . "\n";
							$large = $row != ($ROWS - 1) && ($line % 2 == 0 || !$previousIsHigh[$row+1]) && $shouldBeLarge; // not large if next is taken (even lines only), or if last row
						}

						/**
						 * Determine if item is high
						 */
						$shouldBeHigh =
								is_array($items)
								? rand(0,99) < 100 * ($currentItems[self::REQUIRED_HIGH] / $remaining)
								: rand(0,99) < 100 * $PROBABILITY_HIGH;
						//echo '$shouldBeHigh = ' . ($currentItems[self::REQUIRED_HIGH] / $remaining) . "\n";
						$high = !$large && ($line % 2 == 0) && !$lastLine && $shouldBeHigh; // not high if large already, or on even line, or on last line

						//echo ($high ? '2' : '1') . ($large ? '--x  ' : '  ');
						$this->lines[$line][$row] = $high ? 2 : ($large ? 3 : 1);
						if(is_array($items)) {
							     if($high)  $currentItems[self::REQUIRED_HIGH]--;
							else if($large) $currentItems[self::REQUIRED_LARGE]--;
							else            $currentItems[self::REQUIRED_SMALL]--;
						}

						if($large) {
							$this->lines[$line][$row+1] = -3; // RESULT: -3 == empty space (cause: previous item is large)
							$row++;
							$this->spaces--; // bicrement if large;
						}

						$remaining--;
						$this->spaces--;
					}
					$previousIsHigh[$row] = $high ? 1 : 0;
				}

				//echo "\n";
			}

			if(is_array($items)) {
				$accuracy = ($COUNT - abs($currentItems[self::REQUIRED_SMALL]) - abs($currentItems[self::REQUIRED_LARGE]) - abs($currentItems[self::REQUIRED_HIGH]) - 1.5 * $this->spaces) / $COUNT;
				//echo '$accuracy = ' . 100 * $accuracy . '%, $this->spaces = ' . $this->spaces . "\n";
				if($accuracy > $candidateAccuracy) {
					$candidate = $this->lines;
					$candidateAccuracy = $accuracy;
					$candidateSpaces = $this->spaces;
				}
			}

			//echo '==============================' . "\n";
		}
		if(is_array($items)) {
			//echo '$accuracy = ' . 100 * $candidateAccuracy . "\n";
			$this->lines = $candidate;
			$this->accuracy = $candidateAccuracy;
			$this->spaces = $candidateSpaces;
		}
		/*
		echo '==============================' . "\n";
		echo '$remaining = ' . $remaining . ', $this->spaces = ' . $this->spaces . ', $retries = ' . $retries . "\n";
		echo 'items = ' . print_r($items,true) . "\n";
		*/
	}

	public function getLines() {
		return $this->lines;
	}

	public function getColumns() {
		$result = array();
		foreach($this->getLines() as $i => $line) {
			foreach($line as $j => $cell) {
				if($i == 0) {
					$result[$j] = array();
				}
				$result[$j][$i] = $cell;
			}
		}
		return $result;
	}

	public function getSpacesLeft() {
		return $this->spaces;
	}

	public function getAccuracy() {
		return $this->accuracy;
	}
}
