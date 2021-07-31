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
    This method returns html representation
    */
    public function htmlStatement()
    {
        
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
        
        }
        echo "<h1>Rental Record for <em>$this->name</em></h1>
        <ul>
            <li>Back to the Future - 3</li>
            <li>Office Space - 3.5</li>
            <li>The Big Lebowski - 15</li>
        <ul>
        <p>Amount owed is <em>$totalAmount</em>
        <p>You earned <em>$frequentRenterPoints</em> frequent renter points</p>";
}
}