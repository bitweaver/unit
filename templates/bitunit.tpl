{strip}
<div class="floaticon">{bithelp}</div>
<div class="display bitunit">
	<div class="header"><h1>{tr}Select test scope{/tr}</h1></div>
	<div class="body">
		{form legend="bitUnit Test" method="get" ipackage=bitunit ifile="index.php"}

		{include file="bitpackage:bitunit/testbox_inc.tpl"}
		{/form}
{/strip}
		{if $test}
{strip}
			{* Generate test results here *}
			{* Right now we will only generate the test directories
	
			{* The test directories should probably be in  dropdown list above }
			<table>
				<tr><th">Test filenames</th></tr>
				{foreach key=key item=item from=$tests}
					<tr><td>{$key}</td><td>{$item}</td></tr>
				{/foreach}
			</table>
			{**}
{/strip}
			<p class="{if ($testFailCount > 0) || ($testExceptionCount > 0)}error{else}success{/if}">
				{$testCaseProgress}/{$testCaseCount} {tr}test cases complete:{/tr}
				<strong>{$testPassCount}</strong> {tr}passes{/tr},
				<strong>{$testFailCount}</strong> {tr}fails and{/tr}
				<strong>{$testExceptionCount}</strong> {tr}exceptions{/tr}
			</p>
{strip}

			<table>
				<tr><th>Verdict</th><th>Test Description</th><th>Number of testcases</th></tr>
				{foreach key=key1 item=item1 from=$testResults}
					{if $item1[0] == TestName}
						<tr class="odd"><td></td><td>{$item1[1]}</td><td>{$item1[2]}</td></tr>
					{elseif $item1[0] == TestHeader}
						{*<tr class="odd"> <td></td><td>{$item1[1]}</td><td>{$item1[2]}</td></tr>*}
					{elseif $item1[0] == TestFooter}
						<tr class="odd"><td></td><td>{$item1[1]}</td><td>{$item1[2]}</td></tr>
					{elseif $item1[0] == TestGroupStart}
						<tr class="odd"><td></td><td>{$item1[1]}</td><td>{$item1[2]}</td></tr>
					{elseif $item1[0] == TestStart}
						<tr class="odd"><td></td><td>{$item1[1]}</td><td>{$item1[2]}</td></tr>
					{elseif $item1[0] == TestPass}
						<tr class="even">
							<td class="success">Pass</td>
							<td class="success">{$item1[1]}</td>
							<td class="success">{$item1[2]}</td>
						</tr>
					{elseif $item1[0] == TestFail}
						<tr class="even">
							<td class="error">Fail</td>
							<td class="error">{$item1[1]}</td>
							<td class="success">{$item1[3]}</td>
							{*<td class="error">{$item2}</td> Array ()*}
						</tr>
					{elseif $item1[0] == TestException}
						<tr class="even">
							<td class="error">Exception</td>
							<td class="error">{$item1[1]}</td>
							<td class="success">{$item1[3]}</td>
							{*<td class="error">{$item2}</td> Array ()*}
						</tr>
					{/if}
				{/foreach}
		      	</table>
{/strip}
		{/if}


		<h2>About bitUnit, an integration of simpletest into bitweaver</h2>
		<div class="content">
			This package is an integration of simpletest into bitweaver. Simpletest
			is an unit test framwork used to automatically test software to
			write high quality software and avoid
			regression. You can read the simpletest manual at
			<a href='http://simpletest.sourceforge.net'> http://simpletest.sourceforge.net</a>
		</div>

		<div class="content">
			The simpletest manual should be a good start to get you going. 
			There are some differences. The bitweaaver integration releives
			you from inserting the testcases into groups manually
			(i.e. the <strong>Group test</strong> chapter in the simpletest
			manual does not apply).
			Instead bitUnit identifes files that exists in directories named
			<em>test</em>. When a <em>test</em> directory is found <em>.php</em>
			files that starts with <em>test</em> are added to the test suite.
		</div>

		<div class="content">
			Everything else you need to know should be documeted in the simpletest
			manual. To get you started with writing unit test there is a
			methodology example for jUnit at
			<a href='http://junit.sourceforge.net/doc/testinfected/testing.htm'>
			http://junit.sourceforge.net/doc/testinfected/testing.htm</a>.
		</div>
		<div class="content">
			Only downside is that the example is in Java and the testingframework is
			jUnit - but it should give you a feel for how to construct your testcases.
		</div>
		<div class="content">
			There is also a <a href='http://www.bitweaver.org/wiki/index.php?page=bitunit'>bitUnit</a>
			page at the bitweaver website.
		</div>
	</div> <!-- div class="body" -->
</div> <!-- div class="display bitunit" -->

