<div class="content-container unit size3of4 lastUnit">
	<article>
		<div class="clearfix">
			<div class="content">
				<div class="default-content">
					<div class="unit size3of5 wow animated fadeIn">
						<div class="default-page">
							<h1 class="pageblock-title"><strong>$Title</strong></h1>
							<% if $Content || $CustomScript.RAW %>
								<div class="page-content">
									$Content
									$CustomScript.RAW
								</div>
							<% end_if %>
						</div>
					</div>
                </div>
				<% if $CategoryItems %>
					<div class="pagecategory-container unit size1of1">
						<div class="default-page">
							<div class="category-selector-container">
								<!--
								<label for="category-selector-btn" >Select a category:</label>
								<button id="category-selector-btn" class="left-align category-btn"><span><% loop $CategoryItems %><% if $First %>$Title<% end_if %><% end_loop %></span><object data="mysite/images/arrow-down.svg" type="image/svg+xml"><img src="mysite/images/arrow-down.svg" /></object></button>
								<ul id="category_selector" class="category-selector">
									<% loop $CategoryItems %>
										<li data-value="$Title">$Title</li>
									<% end_loop %>
								</ul>

								<div class="judges-container">
									<div class="judges-result clearfix">
									</div>
								</div>
								-->
                                <div class="judges-container">
									<% loop $CategoryItems %>
										<div class="judges-result clearfix">
											<% if $Judges %>
											<h3 class="pageblock-title">$Title</h3>
												<% loop $Judges %>
													<div class="unit size1of2 center-align">
														<div class="judge-profile">
															<% if $ProfileImage %>
																<img src="$ProfileImage.URL">
															<% else %>
                                                                <img src="assets/Uploads/default-prof.jpg">
															<% end_if %>
															<h3 class="judge-name">$Title</h3>
															<% if $Position %>
																<p>$Position</p>
															<% end_if %>
														</div>
													</div>
												<% end_loop %>
											<% end_if %>
										</div>
									<% end_loop %>
								</div>
							</div>
						</div>
					</div>
				<%  end_if %>
				<% if $VisibleBlocks %>
					<% loop $VisibleBlocks %>
						<div class="pageblock-container clearfix" id="$blockID($Title)">
							<% if $ShowTitle %>
								<% if $Title %>
									<h2 class="pageblock-container-title wow animated fadeInUp">$Title</h2>
								<% end_if %>
							<% end_if %>
							<% if $VisibleItems %>
								<% loop $VisibleItems %>
									<div class="pageblock<% if $Width %> unit $Width<% end_if %><% if $BlockAlign %> $BlockAlign<% end_if %><% if $Animate != "(Select one)" %> wow animated $Animate<% end_if %>" style="<% if $Height %>height: {$Height}px;<% end_if %>">
										<% if $Image %>
										   <img src="$Image.URL" class="content-image">
										<% end_if %>
										<% if $ContentIcon %>
											<% if $SVGImage %>
												<object class="content-icon" data="$SVGImage.URL" type="image/svg+xml">
													<img src="$SVGImage.URL" />
												</object>
											<% end_if %>
										<% end_if %>
										<% if $Content %>
											$Content
										<% end_if %>
										<% if not $ContentIcon %>
											<% if $SVGImage %>
												<object data="$SVGImage.URL" type="image/svg+xml">
													<img src="$SVGImage.URL" />
												</object>
											<% end_if %>
										<% end_if %>
									</div>
								<% end_loop %>
							<% end_if %>
						</div>
					<% end_loop %>
				<% end_if %>
			</div>
		</div>
		</article>
	<% if $Form || $ComementsForm %>
        <div class="default-page">
			<h1 class="pageblock-title"><strong>$Title</strong></h1>
			$Form
			$CommentsForm
        </div>
	<% end_if %>

</div>