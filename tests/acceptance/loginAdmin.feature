Feature: loginAdmin
  In order to login into admin interface
  As a user
  I need to have ROLE_ADMIN permissions

  Scenario: try login into admin interface with incorrect credentials
    Given I am on "/admin/login" page
    And I fill the field "_username" with "xpto"
    And I fill the field "_password" with "xpto"
    When I press the "Log in" button
    Then I should see "Invalid credentials."

  Scenario: try to login into admin interface with correct permissiones
    Given I am on "/admin/login" page
    And I fill the field "_username" with "admin"
    And I fill the field "_password" with "admin"
    When I press the "Log in" button
    Then I should see "Dashboard"
