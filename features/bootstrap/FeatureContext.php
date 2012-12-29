<?php

namespace features\bootstrap\Context;

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use \Behat\MinkExtension\Context\MinkContext;

use \Behat\Behat\Event\ScenarioEvent,
    \Behat\Behat\Event\SuiteEvent;

use \Symfony\Component\Process\Process;

use \Symfony\Component\EventDispatcher\Event;

use \features\bootstrap\Assert;

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
    private static $parameters = [];

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

    private static function runCommand($cmd, $silent = false)
    {
        $p = new Process($cmd, null, null, null, 300);

        try {
            $p->run(function ($type, $buffer) use ($silent) {
                if (true === $silent) {
                    return;
                }

                if ('err' === $type) {
                    echo 'ERR > ';
                }

                echo $buffer;
            });
        } catch (\RuntimeException $e) {
            echo '<error>There was an error while running this process : ' . $e->getMessage() . '</error>';
        }

        return $p;
    }

    /** @BeforeSuite */
    public static function init(SuiteEvent $event)
    {
        static::$parameters = $event->getContextParameters();

        if (isset(static::$parameters['reset_database'], static::$parameters['environment']) && true === static::$parameters['reset_database']) {
            static::runCommand('sh ' . __DIR__ . '/../../../bin/create_database.sh ' . static::$parameters['environment'] . ' --ansi');
            static::runCommand('rm -rf ' . __DIR__ . '/../../../app/cache/*');
        }
    }

    /** @AfterScenario */
    public function stopOnFailureScenario(Event $e)
    {
        if (isset(static::$parameters['stop_on_failure']) && true === static::$parameters['stop_on_failure'] && 4 === $e->getResult()) {
            throw new \Exception('A failure occured, and as the "stop-on-failure" ' .
                                'parameter is set to true, the test will now be halted');
        }
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
