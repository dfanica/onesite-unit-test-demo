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
	<p>
		Right. So say we have some super awesome code, and we want to use PHPUnit to test it. For
		this example we'll be building a simple string library which we can use in corrolation with
		our shiny laravel framework. So let's start by making a method to get the vowels from a 
		given string.
	</p>
	<pre class="prettyprint lang-php">
		class StringMeth
		{
			/**
			 * Returns only the vowels in the given string.
			 * 
			 * @param string $string
			 * 
			 * @return string
			 */
			public static function getVowels($string)
			{
				$vowels = preg_replace("/[^aeiou]/i", '', $string);
				
				return $vowels;
			}
		}
	</pre>
	<p>
		It's a pretty simple method, and we're fairly certain that it will work. Let us go ahead
		and write a quick unit test to ensure that it does what we think it will do.
	</p>
	<pre class="prettyprint lang-php">
		require_once dirname(__FILE__) . "/../application/libraries/stringmeth.php";

		class StringMethTest extends PHPUnit_Framework_TestCase
		{
			
			public function testStripConsonants()
			{
				$string = "Hello";
				$vowels = 'eo';
				
				$this->assertEquals(StringMeth::getVowels($string), $vowels);
			}
		}
	</pre>
	<p>
		Something you should note, ideally you would have an autoloader to load everything you need,
		but for our simple test I'll just be using requires. Now, what happens when we
		run this test?
	</p>
	<p>
		<a class="box-img" href="/img/phpunit_1.png">
			<img class="demo-img" src="/img/phpunit_1_small.png" />
		</a>
	</p>
	<p>
		That's about what we expected, the test was simple and it passed. Now, suppose we decide that
		we want getVowels to return an array of vowels, instead of a string. So we change the method
		to do that.
	</p>
	<pre class="prettyprint lang-php">
		public static function getVowels($string)
		{
			$vowels = preg_replace("/[^aeiou]/i", '', $string);
			
			return preg_split('//', $vowels, -1, PREG_SPLIT_NO_EMPTY);
		}
	</pre>
	<p>
		Well, the problem here is what happens when we re-run the unit tests.
	</p>
	<p>
		<a class="box-img" href="/img/phpunit_2.png">
			<img class="demo-img" src="/img/phpunit_2_small.png" />
		</a>
	</p>
	<p>
		I'll bet you expected this one, the unit test now failes because we changed what
		it was expecting. Let's fix the test.
	</p>
	<pre class="prettyprint lang-php">
		public function testStripConsonants()
		{
			$string = "Hello";
			$vowels = array(
				'e',
				'o',
			);
			
			$this->assertEquals(StringMeth::getVowels($string), $vowels);
		}
	</pre>
	<p>
		Our test now passes. Sweet. Let's do something a bit more complicated. We now want a method
		which takes the string that it is given, hyphenates between words, and makes the whole
		thing lowercase. Basically, turning it into a url slug. here is the method and
		our corresponding unit test.
	</p>
	<pre class="prettyprint lang-php">
		/**
		 * Takes the string and changes spaces into hyphens, and lowercases
		 * the whole thing.
		 * 
		 * @param String $string
		 * 
		 * @return string
		 */
		public static function slugify($string)
		{
			$replaces = preg_replace("/ /", '-', $string);
			
			return strtolower($replaces);
		}
		
		public function testSlugify()
		{
			$string = "Cookies are delicious";
			$expected = 'cookies-are-delicious';
			
			$this->assertEquals(StringMeth::slugify($string), $expected);
		}
	</pre>
	<p>
		So let's run our test and see what happens!
	</p>
	<p>
		<a class="box-img" href="/img/phpunit_3.png">
			<img class="demo-img" src="/img/phpunit_3_small.png" />
		</a>
	</p>
	<p>
		Rock! So our slugify method is perfect, right? Not even close. Let's write another
		assertion in that test to see what happens if we do something different.
	</p>
	<pre class="prettyprint lang-php">
		$string = "Hi Mom! I like muffins!";
		$expected = 'hi-mom-i-like-muffins';
		
		$this->assertEquals(StringMeth::slugify($string), $expected);
	</pre>
	<p>
		Running the unit test reveals something we didn't quite anticipate before.
	</p>
	<p>
		<a class="box-img" href="/img/phpunit_4.png">
			<img class="demo-img" src="/img/phpunit_4_small.png" />
		</a>
	</p>
	<p>
		Crap! We forgot to account for special characters. Let's fix that in our string method.
	</p>
	<pre class="prettyprint lang-php">
		public static function slugify($string)
		{
			$string = preg_replace('/[^a-zA-Z0-9 ]/', '', $string);
			$replaces = preg_replace("/ /", '-', $string);
			
			return strtolower($replaces);
		}
	</pre>
	<p>
		Alright, rerunning our assertions, we can see that the tests now pass properly.
	</p>
	<p>
		<a class="box-img" href="/img/phpunit_5.png">
			<img class="demo-img" src="/img/phpunit_5_small.png" />
		</a>
	</p>
	<p>
		There's still one more snag we haven't considered. What would happen if we ran the following unit test?
	</p>
	<pre class="prettyprint lang-php">
		$string = "Hey there   billy, I like cheese.  ";
		$expected = "hey-there-billy-i-like-cheese";
		
		$this->assertEquals(StringMeth::slugify($string), $expected);
	</pre>
	<p>
		Yeah, you probably guessed that it didn't work out so well:
	</p>
	<p>
		<a class="box-img" href="/img/phpunit_6.png">
			<img class="demo-img" src="/img/phpunit_6_small.png" />
		</a>
	</p>
	<p>
		Right, forgot to account for extra whitespace. Let's fix that.
	</p>
	<pre class="prettyprint lang-php">
		public static function slugify($string)
		{
			$string = trim($string);
			$string = preg_replace('/[^a-zA-Z0-9 ]/', '', $string);
			$replaces = preg_replace("/ +/", '-', $string);
			
			return strtolower($replaces);
		}
	</pre>
	<p>
		Excellent, now we rerun the tests and it works just fine.
	</p>
	<p>
		<a class="box-img" href="/img/phpunit_7.png">
			<img class="demo-img" src="/img/phpunit_7_small.png" />
		</a>
	</p>
	<p>
		Now we've seen that this is not a particularly intensive method, but it could have several things
		go unexpected with it. Because we have unit tests to ensure that everything goes correctly, we 
		have made a fairly bullet-proof method without having to test it on a live site. Also, we can
		ensure that the method will continue to work through future iterations of code completion.
	</p>
	<p>
		Of course, this is a small drop in the bucket. When you have a large application, there are many
		things that can go wrong, and you have database entries to contend with. However, it is a
		valuable use of time to ensure that nothing breaks from iteration to iteration.
	</p>
	<h3>Additional Resources</h3>
	<ul>
		<li>
			<a href="http://www.phpunit.de/manual/3.5/en/writing-tests-for-phpunit.html">
				PHPUnit
			</a> - The Unit Testing Framework for PHP
		</li>
		<li>
			<a href="http://cukes.info/">
				Cucumber
			</a> - BDD tool in the first half of this example
		</li>
		<li>
			<a href="http://laravel.com/docs/start/libraries">
				Laravel
			</a> - The framework used to build this example.
		</li>
	</ul>
</div>