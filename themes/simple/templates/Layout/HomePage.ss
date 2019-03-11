<div class="content-container unit size3of4 lastUnit">
    <div class="content">
        <% if $Content %>
            <div class="intro-content<% if $PageBlockContainers %> intro-margin<% end_if %>  wow animated fadeInUp">
                $Content
                $CustomScript.RAW
            </div>
        <% end_if %>
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
                                        <object data="$SVGImage.URL" type="image/svg+xml">
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