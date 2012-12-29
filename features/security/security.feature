Feature: Search
  In order to see if the security firewall works correctly
  We test access some url and see the stats code

  Scenario: Anonymous try to access to the home
    Given I am on "/"
    Then the response status code should be 200
    And I should be on "/login"

  Scenario: Anonymous try to access to the login page
    Given I am on "/login"
    Then the response status code should be 200

  Scenario: Anonymous try to access to the create account page
    Given I am on "/create-account"
    Then the response status code should be 200