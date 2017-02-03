<?php 
$I = new AcceptanceTester($scenario);

// opens front page
$I->amOnPage('/');
$I->see('a great website');
$I->see('login');

$I->amOnPage('/login');
$I->seeInCurrentUrl('/login');

$I->submitForm('#login', [
    'username' => 'user',
    'password' => 'user'
]);

$I->seeInCurrentUrl('/admin');
