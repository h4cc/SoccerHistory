Feature: Login

  Scenario: Searching for a page that does exist
    Given I am on "/login"
    Then the response status code should be 200

  Scenario: Searching for a page that does exist
    Given I am connected with "remy" and "pass" on "/"
    Then I should see "remy"