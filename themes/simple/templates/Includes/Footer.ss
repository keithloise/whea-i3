<footer class="footer" role="contentinfo">
	<div class="inner">
		<div class="unit size4of4 lastUnit">
			<div class="footer-block">
				<div class="clearfix">
					<div class="unit size1of2 left-align">
						<div class="footer-logo">
							<% if $SiteConfig.FooterLogo %>
								<object data="$SiteConfig.FooterLogo.URL" type="image/svg+xml">
									<img src="$SiteConfig.FooterLogo.URL" />
								</object>
							<% end_if %>
							<object data="mysite/images/WaitemataLogo.svg" type="image/svg+xml">
								<img src="mysite/images/WaitemataLogo.svg" />
							</object>
						</div>
					</div>
					<div class="unit size1of2 right-align">
						<div class="footer-icons">
							<% if $SiteConfig.SocialNetworkItems %>
								<% loop $SiteConfig.SocialNetworkItems %>
									<i class="fab $IconClass"></i>
								<% end_loop %>
							<% end_if %>
                        </div>
					</div>
                </div>
			</div>
		</div>
	</div>
</footer>