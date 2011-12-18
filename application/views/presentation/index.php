<html>
	<head>
		<title>ONESite testing Presentation</title>
		<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css" />
		<link href="/prettify/prettify.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="/prettify/prettify.js"></script>
		<script type="text/javascript" src="/js/fancybox/jquery-1.4.3.min.js"></script>
		<script type="text/javascript" src="/js/fancybox/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<link rel="stylesheet" href="/js/fancybox/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	</head>
	<body onload="prettyPrint();">
		<script type="text/javascript">
			$(function() {
				$("a.box-img").fancybox({
					'transitionIn'	:	'elastic',
					'transitionOut'	:	'elastic',
					'speedIn'		:	600, 
					'speedOut'		:	200, 
					'overlayShow'	:	false
				});
			});
		</script>
		<div class="container">
			<h1>ONESite Testing Presentation</h1>
			<h2>
				<a href="/files/presentation.odp" title="Download Presentation">
					Download Presentation
				</a>
			</h2>
			
			<h2>
				Acceptance Testing
			</h2>
			<p>
				The first step of our tutorial is using <a href="http://cukes.info/">Cucumber</a> to manage
				our Acceptance tests, and a brief dip into BDD (Behavior Driven Design).
			</p>
			<p>
				The premise behind Cucumber is that we write tests in domain language, that is understandable
				by those in the business side of things, to ensure that our development is <em>acceptable</em>
				to all those involved.
			</p>
			<p>
				BDD says that we shall write these tests first to ensure that we are building the right thing
				and we shall then build our application against those tests. So, shall we dive right in?
			</p>
			<h3>Cucumber testing against this very page</h3>
			<p>
				So we've decided that we want to write up our really awesome testing presentation, and
				we want to write a cucumber feature to help ensure we actually write what we set
				out to write! Our feature defnintion might look like this:
			</p>
			<pre class="prettyprint lang-rb">
				Feature: Visit the Presentation Page
				  In order to share my presentation with awesome people
				  I need to make sure that the page is visible with all required info
				  
				  Scenario: Download Link Present
				    Given that I have opened "http://test.onesite.com/presentation/index"
				    When I click on the link "Download Presentation"
				    Then I download a file called "presentation.odp"
			</pre>
			<p>
				The best part about all of this, it is easy to understand. I have set up that
				I want to visit the presentation/index page, click on the link which is labeled
				"Download Presentation", I want to be presented with a file called "presentation.odp".
				Easy! So, when we run cucumber, we should be informed that we haven't written any step
				definitions.
			</p>
			<p>
				<a class="box-img" href="/img/cucumber_step_1.png">
					<img class="demo-img" src="/img/cucumber_step_1_small.png" />
				</a>
			</p>
			<p>
				Rock on. Cucumber was even nice enough to let me know what the heck I need to put into
				my presentation_steps.rb file. Let's add that, and see what cucumber gives us.
			</p>
			<p>
				<a class="box-img" href="/img/cucumber_step_2.png">
					<img class="demo-img" src="/img/cucumber_step_2_small.png" />
				</a>
			</p>
			<p>
				Excellent. We have working step definitions, even if they have nothing in them. First thing we do
				now is write the test to go and visit the presentation/index page. That step definition looks
				like this.
			</p>
			<pre class="prettyprint lang-rb">
				Given /^that I have opened "([^"]*)"$/ do |arg1|
				  visit arg1
				end
			</pre>
			<p>
				We have a problem though, we haven't written this page yet!
			</p>
			<p>
				<a class="box-img" href="/img/cucumber_step_3.png">
					<img class="demo-img" src="/img/cucumber_step_3_small.png" />
				</a>
			</p>
			<p>
				Alright, let's go ahead and make this page, and run the test again.
			</p>
			<p>
				<a class="box-img" href="/img/cucumber_step_4.png">
					<img class="demo-img" src="/img/cucumber_step_4_small.png" />
				</a>
			</p>
			<p>
				Green is good. So now we have a passing first test. Let's go ahead and
				make the step definition for the second test. We want to click on "Download
				Presentatinon". This is pretty simple in webrat.
			</p>
			<pre class="prettyprint lang-rb">
				When /^I click on the link "([^"]*)"$/ do |link_name|
				  click_link link_name
				end
			</pre>
			<p>
				The click_link method tells the mechanizer that we want to follow a link,
				and it does just that for you. So let's run cucumber again and see what happens.
			</p>
			<p>
				<a class="box-img" href="/img/cucumber_step_6.png">
					<img class="demo-img" src="/img/cucumber_step_6_small.png" />
				</a>
			</p>
			<p>
				Excellent. Cucumber was able to click our link without any problem. Finally, we have
				to ensure that we've downloaded the file with the correct name. There are several
				ways to to this, one of which involves checking the response headers, but for
				our purposes we can just check the current_url.
			</p>
			<pre class="prettyprint lang-rb">
				Then /^I download a file called "([^"]*)"$/ do |filename|
				  current_url.index(filename) != nil
				end
			</pre>
			<p>
				Okay, now that is written, how does cucumber react?
			</p>
			<p>
				<a class="box-img" href="/img/cucumber_step_7.png">
					<img class="demo-img" src="/img/cucumber_step_7_small.png" />
				</a>
			</p>
			<p>
				Everything is green! Excellent. This concludes the Acceptance testing portion of our
				tutorial.
			</p>
			<h2>
				Unit Testing
			</h2>
		</div>
	</body>
</html>