<header class="header" role="banner">
	<div class="inner">
		<div class="unit size4of4 lastUnit">
			<a href="$BaseHref" class="brand" rel="home">
				<!--
				<span class="line-container">
					<span class="logo-line line-one"></span>
					<span class="logo-line line-two"></span>
					<span class="logo-line line-three"></span>
					<span class="logo-line line-four"></span>
				</span>
				-->
				<% if $SiteConfig.Logo %>
                    <object data="$SiteConfig.Logo.URL" type="image/svg+xml" class="logo-svg">
                        <img src="$SiteConfig.Logo.URL" />
                    </object>
				<% else %>
					<% if $SiteConfig.LogoTitle %>
						$SiteConfig.LogoTitle
					<% end_if %>
				<% end_if %>
				<!--
				<h1>$SiteConfig.Title</h1>
				<% if $SiteConfig.Tagline %>
				<p>$SiteConfig.Tagline</p>
				<% end_if %>
				-->
			</a>
			<% if $SearchForm %>
				<span class="search-dropdown-icon">L</span>
				<div class="search-bar">
					$SearchForm
				</div>
			<% end_if %>
			<% include Navigation %>
		</div>
		<div class="mobile-nav">
            <ul>
				<% loop $Menu(1) %>
                    <li class="$LinkingMode"><a href="$Link" title="$Title.XML">$Title.XML</a></li>
					<% if $Children %>
						<% loop $Children %>
                        <li class="$LinkingMode"><a href="$Link" title="$Title.XML">$Title.XML</a></li>
						<% end_loop %>
					<% end_if %>
				<% end_loop %>
                <li class="parent-li">
                    <a href="/#Gotaquestion" title="Contact">Contact Us</a>
                </li>
            </ul>
            <span class="scroll-btn">
				<a>
					<span class="mouse">
						<span>
						</span>
					</span>
				</a>
			</span>
		</div>
	</div>
</header>
