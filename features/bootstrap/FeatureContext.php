<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use \Behat\MinkExtension\Context\MinkContext;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * Connects the user
     *
     * @When /^I am connecting with "(?P<user>(?:[^"]|\\")*)" and "(?P<pass>(?:[^"]|\\")*)"$/
     *
     * @param string $user username to log in
     * @param string $pass username's password
     */
    public function iAmConnectingWithAnd($user, $pass)
    {
        $this->fillField('username', $user);
        $this->fillField('password', $pass);
        $this->pressButton('login');
    }

    /**
     * Connects the user on an url
     *
     * @Given /^I am connected with "(?P<user>(?:[^"]|\\")*)" and "(?P<pass>(?:[^"]|\\")*)" on "(?P<url>.+)"/
     *
     * @param string $user username to log in
     * @param string $pass username's password
     * @param string $url  url to visit
     */
    public function iAmConnectedWithAndOn($user, $pass, $url)
    {
        $this->visit('/login');
        $this->iAmConnectingWithAnd($user, $pass);
        $this->visit($url);
    }
}
