			<div class="row">
				{formlabel label="Test scope"}
					{forminput}
					<select name="where">
						<option value="all">{tr}All packages{/tr}</option>
						{*<option value="all_active">{tr}Active packages{/tr}</option>*}
						{* Add all packages here *}
					</select>
					{/forminput}
			</div>

			<div class="row">
				{formlabel label="Show passes" }
				{forminput}
					<input type="checkbox" name="show_passes" value="n" />
				{/forminput}
			</div>

			<div class="row submit">
				<input type="submit" name="test" value="{tr}Test{/tr}" />
			</div>
			<div class="clear"></div>

