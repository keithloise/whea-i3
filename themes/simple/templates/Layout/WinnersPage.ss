<div class="content-container unit size3of4 lastUnit">
    <article>
        <div class="clearfix">
            <div class="content">
                <div class="default-content">
                    <div class="unit size3of5 wow animated fadeIn">
                        <div class="default-page">
                            <h1 class="pageblock-title"><strong>$Title</strong></h1>
                            <div class="page-content">
                                $Content
                                $CustomScript.RAW
                            </div>
                        </div>
                    </div>
                </div>
                <% if $WinnerItems %>
                    <div class="unit size1of1">
                        <div class="default-page">
                            <div class="filter-container" style="display:none;">
                                <div class="filters">
                                    <div class="selected-filters"></div>
                                    <btn class="filter-all">Filter By <object data="mysite/images/arrow-down.svg" type="image/svg+xml"><img src="mysite/images/arrow-down.svg" /></object></btn>
                                    <ul class="filter-selector">
                                    </ul>
                                </div>
                            </div>
                            <div class="box-container clearfix">
                                <% loop $WinnerItems %>
                                    <div class="unit size1of3" data-filters="{$Category},{$EntryType},{$Year}">
                                        <div class="box-content">
                                        $Content
                                        </div>
                                    </div>
                                <% end_loop %>
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