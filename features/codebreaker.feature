Feature: Codebreaker

  Scenario: Getting one hyphen when only one guess in wrong place
    Given the secret is set to "1234"
    When I take the guess "9881"
    Then I should get the output "-" in red


  Scenario: Getting two yellow plusses when two guesses in correct places
    Given the secret is set to "1234"
    When I take the guess "1256"
    Then I should get the output "++" in yellow
