<?php
trait Brake {
	public function brake() : void {
		echo "Unlike a lot of Burqueños, I stop for red lights" . PHP_EOL;
	}
}

class Vehicle {
	protected $plateNo;

	public function __construct(string $newPlateNo) {
		try {
			$this->setPlateNo($newPlateNo);
		} catch(\InvalidArgumentException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	public function getPlateNo() : string {
		return($this->plateNo);
	}

	public function setPlateNo(string $newPlateNo) : void {
		$newPlateNo = filter_var($newPlateNo, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		$newPlateNo = strtoupper(trim($newPlateNo));

		if(preg_match("/^[A-Z]{3}\d{3}$/", $newPlateNo) !== 1) {
			throw(new \InvalidArgumentException("bad plate number - ABQ PD is on the way"));
		}

		$this->plateNo = $newPlateNo;
	}
}

class ParadeFloat extends Vehicle {
	use Brake;

	protected $isGettingAwayVerySlowly;

	public function __construct($newIsGettingAwayVerySlowly, string $newPlateNo) {
		try {
			parent::__construct($newPlateNo);
			$this->setIsGettingAwayVerySlowly($newIsGettingAwayVerySlowly);
		} catch(\InvalidArgumentException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	public function getIsGettingAwayVerySlowly() : bool {
		return($this->isGettingAwayVerySlowly);
	}

	public function setIsGettingAwayVerySlowly($newIsGettingAwayVerySlowly) : void {
		$newIsGettingAwayVerySlowly = filter_var($newIsGettingAwayVerySlowly, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

		if($newIsGettingAwayVerySlowly === null) {
			throw(new InvalidArgumentException("unable to determine if he's getting away"));
		}

		$this->isGettingAwayVerySlowly = $newIsGettingAwayVerySlowly;
	}
}





