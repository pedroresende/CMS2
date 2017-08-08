Feature: lostPasswordAdmin
  In order to be able to recover password of the admin interface
  As a user
  I need to be able to access the Reset Password page

  Scenario: try click on "Lost your password ?" link
    Given I am on "/admin/login" page
    When I click on the "Lost your password?" link
    Then I should be on "/admin/resetting/request" page
    And I should see the "Reset password" button

  Scenario: try click on "Back" link
    Given I am on "/admin/resetting/request" page
    When I click on the "Back" link
    Then I should be on "/admin/login" page
    And I should see "Login"

  Scenario: try click on "Reset Password" button
    Given I am on "/admin/resetting/request" page
    And I fill the field "username" with "dummy"
    When I press the "Reset password" button
    Then I should see "An email has been sent. It contains a link you must click to reset your password."
    And I should see "Note: You can only request a new password once within 2 hours."
    And I should see "If you don't get an email check your spam folder or try again."
