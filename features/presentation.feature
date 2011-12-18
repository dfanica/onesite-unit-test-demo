Feature: Visit the Presentation Page
  In order to share my presentation with awesome people
  I need to make sure that the page is visible with all required info
  
  Scenario: Download Link Present
    Given that I have opened "http://test.onesite.com/presentation/index"
    When I click on the link "Download Presentation"
    Then I download a file called "presentation.odp"
