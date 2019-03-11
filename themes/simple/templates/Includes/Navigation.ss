<nav class="primary">
	<span class="nav-open-button">
		<object class="btn_open" data="mysite/images/open-btn.svg" type="image/svg+xml" class="logo-svg">
			<img src="mysite/images/open-btn.svg"/>
		</object>

		<object class="btn_close" data="mysite/images/close-btn.svg" type="image/svg+xml" class="logo-svg">
			<img src="mysite/images/close-btn.svg" />
		</object>
	</span>
	<ul class="parent-ul">
		<% loop $Menu(1) %>
			<li class="$LinkingMode parent-li">
				<a href="$Link" title="$Title.XML">$MenuTitle.XML</a>
				<% if $Children %>
					<ul class="dropdown">
					<% loop $Children %>
						<li class="$LinkingMode"><a href="$Link" title="$Title.XML">$MenuTitle.XML</a></li>
					<% end_loop %>
					</ul>
				<% end_if %>
			</li>
		<% end_loop %>
		<li class="parent-li">
            <a href="/#Gotaquestion" title="Contact">CONTACT</a>
		</li>
	</ul>
</nav>
