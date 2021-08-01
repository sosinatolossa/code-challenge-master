<?php

require_once('Movie.php');
require_once('Rental.php');
require_once('Customer.php');

$rental1 = new Rental(
    new Movie(
        'Back to the Future',
        Movie::CHILDRENS
    ), 4
);

$rental2 = new Rental(
    new Movie(
        'Office Space',
        Movie::REGULAR
    ), 3
);

$rental3 = new Rental(
    new Movie(
        'The Big Lebowski',
        Movie::NEW_RELEASE
    ), 5
);

$rental4 = new Rental(
    new Movie(
        'The Texas Chainsaw Massacre',
        Movie::HORROR
    ), 6
);

$rental5 = new Rental(
    new Movie(
        'Avatar',
        Movie::SCIFI
    ), 7
);

$customer = new Customer('Joe Schmoe');

$customer->addRental($rental1);
$customer->addRental($rental2);
$customer->addRental($rental3);
$customer->addRental($rental4);
$customer->addRental($rental5);

echo $customer->statement();
echo $customer->htmlStatement();