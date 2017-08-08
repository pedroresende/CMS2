<?php

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class AcceptanceTester extends \Codeception\Actor
{

    use _generated\AcceptanceTesterActions;

    /**
     * @Given I am on :arg1 page
     */
    public function iAmOnPage($arg1)
    {
        $this->amOnPage($arg1);
        $this->resizeWindow(800, 600);
    }

    /**
     * @Given I fill the field :arg1 with :arg2
     */
    public function iFillTheFieldWith($arg1, $arg2)
    {
        $this->fillField($arg1, $arg2);
    }

    /**
     * @When I press the :arg1 button
     * @When I click on the :arg1 link
     */
    public function iPressTheButton($arg1)
    {
        $this->click($arg1);
    }

    /**
     * @Then I should see :arg1
     */
     public function iShouldSee($arg1)
     {
        $this->see($arg1);
     }

    /**
     * @Then I should see the :arg1 button
     */
     public function iShouldSeeTheButton($arg1)
     {
        $this->seeElement('input', ['value' => $arg1]);
     }

    /**
     * @Then I should see :arg1 on :arg2
     */
    public function iShouldSeeOn($arg1, $arg2)
    {
        $this->see($arg1, $arg2);
    }

    /**
     * @Then I should be on :arg1 page
     */
    public function iShouldBeOn($arg1)
    {
        $this->seeCurrentUrlEquals($arg1);
    }
}
