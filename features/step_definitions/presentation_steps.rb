Given /^that I have opened "([^"]*)"$/ do |arg1|
  visit arg1
end

When /^I click on the link "([^"]*)"$/ do |link_name|
  click_link link_name
end

Then /^I download a file called "([^"]*)"$/ do |filename|
  current_url.index(filename) != nil
end