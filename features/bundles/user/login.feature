Feature: Login

Scenario: Check login page is accessible for anonymous
  Given I am connected with "remy" and "pass" on "/"
  Then the response status code should be 200