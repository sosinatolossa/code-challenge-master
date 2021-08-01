<?php

class Customer
{
    /**
     * @var string
     */
    private $name; //constructor one

    /**
     * @var Rental[]
     */
    private $rentals; //constructor two

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->rentals = [];
    }

    /**
     * @return string
     * This functions returns string of a person's name
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @param Rental $rental
     * This function takes in $rental that is Rental object type and 
     * adds each object in the rentals array
     */
    public function addRental(Rental $rental)
    {
        $this->rentals[] = $rental;
    }

    /**
     * @return string
     */

    var $totalAmount = 0; //initial total amount is 0
    var $frequentRenterPoints = 0; //initial frequentRenterPoints is 0
    
    public function statement()
    {
        
        $result = 'Rental Record for ' . $this->name() . PHP_EOL; //using the name that name() function returns

        foreach ($this->rentals as $rental) { //for each rental in rentals array
            $thisAmount = 0; //initial amount is 0

            switch($rental->movie()->priceCode()) { //based on the 
                case Movie::REGULAR: //case: if the movie is regular
                    $thisAmount += 2; //increment $thisAmount by 2
                    if ($rental->daysRented() > 2) { //if the movie is rented for more than 2 days
                        $thisAmount += ($rental->daysRented() - 2) * 1.5; // increment $thisAmount again by the result of => subtract 2 then multiply result by 1.5
                    }
                    break;
                case Movie::NEW_RELEASE: //case: if the movie is new
                    $thisAmount += $rental->daysRented() * 3; //multiply the amount of days the movie is rented then add that to $thisAmount
                    break;
                case Movie::CHILDRENS: //case: if the movie is for children
                    $thisAmount += 1.5; //increment $thisAmount by 1.5
                    if ($rental->daysRented() > 3) { //if days of rent is greater than 3
                        $thisAmount += ($rental->daysRented() - 3) * 1.5; //subtract 3 from daysRented then multiply by 1.5 then add the result to $thisAMount
                    }
                    break;
            }

            $totalAmount += $thisAmount; //finally add $thisAmount to $totalAmount

            $frequentRenterPoints++;
            if ($rental->movie()->priceCode() === Movie::NEW_RELEASE && $rental->daysRented() > 1) {
                $frequentRenterPoints++;
            }

            $result .= "\t" . str_pad($rental->movie()->name(), 30, ' ', STR_PAD_RIGHT) . "\t" . $thisAmount . PHP_EOL;
        }

        $result .= 'Amount owed is ' . $totalAmount . PHP_EOL;
        $result .= 'You earned ' . $frequentRenterPoints . ' frequent renter points' . PHP_EOL;

        return $result;
    }

    /*
    This method returns html
    */
    public function htmlStatement()
    {
        echo "\n";
        echo "<h1>Rental Record for <em>$this->name</em></h1>";

        echo "\n<ul>";
        foreach ($this->rentals as $rental) { 
            $thisAmount = 0; 

            switch($rental->movie()->priceCode()) { 
                case Movie::REGULAR: 
                    $thisAmount += 2; 
                    if ($rental->daysRented() > 2) { 
                        $thisAmount += ($rental->daysRented() - 2) * 1.5; 
                    }
                    break;
                case Movie::NEW_RELEASE:
                    $thisAmount += $rental->daysRented() * 3;
                    break;
                case Movie::CHILDRENS: 
                    $thisAmount += 1.5; 
                    if ($rental->daysRented() > 3) { 
                        $thisAmount += ($rental->daysRented() - 3) * 1.5; 
                    }
                    break;
                case Movie::SCIFI: //case SCIFI
                    $thisAmount += 3; //increment $thisAmount by 3
                    if ($rental->daysRented() > 3) { //if days rented is greater than 3
                        $thisAmount += ($rental->daysRented() + 3) * .5; //add another 3 to $thisAmount then multiply it by .5
                    }
                    break;
                    case Movie::HORROR: //case HORROR
                        $thisAmount += 1; //increment $thisAmount by 1
                        if ($rental->daysRented() > 4) { //if days rented is greater than 4
                            $thisAmount += ($rental->daysRented()); //don't change anything
                        }
                        break;
            }

            $totalAmount += $thisAmount;
            $frequentRenterPoints++;
            if ($rental->movie()->priceCode() === Movie::NEW_RELEASE && $rental->daysRented() > 1) {
                $frequentRenterPoints++;
            }
            echo "\n \t <li>" . str_pad($rental->movie()->name(), 2) . " - " . $thisAmount . "</li>";   
        
        }
        echo "\n</ul>";
        echo "\n<p>Amount owed is <em>$totalAmount</em> \n<p>You earned <em>$frequentRenterPoints</em> frequent renter points</p>";
}
}