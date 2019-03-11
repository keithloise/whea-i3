jQuery.noConflict();
(function($) {
	$(document).ready(function() {
		/* removes text from search form on focus and replaces it on unfocus - if text is entered then it does not get replaced with default on unfocus */
		$('#SearchForm_SearchForm_action_results').val('L');
		var searchField = $('#SearchForm_SearchForm_Search');
		var default_value = searchField.val();
		searchField.focus(function() {
			$(this).addClass('active');
			if(searchField.val() == default_value) {
				searchField.val('');
			}
		});
		searchField.blur(function() {
			  if(searchField.val() == '') {
					searchField.val(default_value);
			  }
		});

		if (!$.browser.msie || ($.browser.msie && (parseInt($.browser.version, 10) > 8))) {
			var searchBarButton = $("span.search-dropdown-icon");
			var searchBar = $('div.search-bar');
			var menuButton = $("span.nav-open-button");
			var menu = $('.header .primary .parent-ul');
			var mobile = false;
			var changed = false;

			$('body').append('<div id="media-query-trigger"></div>');

			function menuWidthCheck() {
				var header_w = $('header .inner').width();
				var elements_w = menu.width() + $('.brand').width();

				if ((header_w < elements_w) || ($(window).width() <= 1150)) {
					$('body').addClass('tablet-nav');
				}
				else {
					$('body').removeClass('tablet-nav');
				}

				let mobile_old = mobile;

				$('#media-query-trigger').css('visibility') == 'hidden' ? mobile == false : mobile == true;
                mobile_old != mobile ? changed == true : changed == false;
			}

			menuWidthCheck();

			$(window).resize(function() {
				menuWidthCheck();

				if (!mobile) {
					menu.show();
					searchBar.show();
				}
				else {
					if (changed) {
						menu.hide();
						searchBar.hide();
					}
				}
			});

			/* toggle navigation and search in mobile view */
			searchBarButton.click(function() {
				menu.slideUp();
				searchBar.slideToggle(200);
			});

			menuButton.click(function() {
				searchBar.slideUp();
				menu.slideToggle(200);
			});
		}
    });

    document.addEventListener("DOMContentLoaded", function() {
        //pageBlockSizeNormal();
        categorySelector();
        categorySelected();
        otherSettings();
        getJudges();
        populateFilters();

        openFilter();
        filterPastWinners();
    });

    function pageBlockSizeNormal() {
        let maxHeight = -1, elemHeight, width = $(window).width(),
            categoryDiv = $('#TheCategories .pageblock');
        elemHeight = categoryDiv.map(function () {
            return $(this).height();
        }).get();

        maxHeight = (Math.max.apply(null, elemHeight) + 100);
        categoryDiv.each(function() {
            width > 1024 ? $(this).height() < maxHeight ? $(this).height(maxHeight) : '' : $(this).css('height','auto');
        });
    }

    function pageBlockSize() {
        let maxHeight = -1, elemHeight, width = $(window).width(),
            categoryDiv = $('#TheCategories .pageblock');
        elemHeight = categoryDiv.map(function () {
            return $(this).height();
        }).get();

        maxHeight = (Math.max.apply(null, elemHeight));
        categoryDiv.each(function() {
            width > 1024 ? $(this).height() < maxHeight ? $(this).height(maxHeight) : '' : $(this).css('height','auto');
        });
    }

    function boxSize() {
        let box_unitDiv = $('.box-container .unit .box-content'),
            maxHeight   = -1, elemHeight, width = $(window).width(),
            titleHeight, titleMaxHeight;

        elemHeight = box_unitDiv.map(function () {
            return $(this).height();
        }).get();

        titleHeight = box_unitDiv.find('.pageblock-title').map(function () {
            return $(this).height();
        });

        titleMaxHeight =  (Math.max.apply(null, titleHeight) + 25);
        box_unitDiv.find('.pageblock-title').each(function () {
            width > 650 ? $(this).height() < titleMaxHeight ? [$(this).height(titleMaxHeight),$(this).css({'display' : 'table-cell','vertical-align': 'middle','width' : '100%'})] : '' : $(this).css('height','auto');
        });

        //maxHeight = (Math.max.apply(null, elemHeight) + 50);
        /*
        box_unitDiv.each(function() {
            width > 650 ? $(this).height() < maxHeight ? $(this).height(maxHeight) : '' : $(this).css('height','auto');
        });
        */
    }

    function populateFilters() {
        let categoryArray = [], yearArray = [], entryTypeArray = [], splitValue,
            data_filters, data_category, data_year, data_entryType, item = $('.box-container .unit'),
            filters_container = $('.filters ul'), categoryFlag = false, entryTypeFlag = false, yearFlag = false,
            button_filters = $('.selected-filters');

        item.each(function() {
            data_filters = $(this).data('filters');
            splitValue = data_filters.split(',');

            data_category  = splitValue[0];
            data_entryType = splitValue[1];
            data_year      = splitValue[2];

            categoryArray.indexOf(data_category) == -1 ? categoryArray.push(data_category) : '';
            entryTypeArray.indexOf(data_entryType) == -1 ? entryTypeArray.push(data_entryType) : '';
            yearArray.indexOf(data_year) == -1 ? yearArray.push(data_year) : '';
        });

        categoryArray.length > 0 ? [filters_container.append('<li class="filter-header">Categories</li>'), categoryFlag = true] : '';
        categoryFlag ?
            $.each(categoryArray, function(index, value){
             filters_container.append('<li class="filter-child categories" data-value="'+ value +'">'+ value +'</li>')
            }) : '';

        entryTypeArray.length > 0 ? [filters_container.append('<li class="filter-header">Entry Type</li>'), entryTypeFlag = true] : '';
        entryTypeFlag ?
            $.each(entryTypeArray, function(index, value){
                filters_container.append('<li class="filter-child entry_type" data-value="'+ value +'">'+ value +'</li>')
            }) : '';

        yearArray.length > 0 ? [filters_container.append('<li class="filter-header">Year</li>'), yearFlag = true] : '';
        yearFlag ?
            $.each(yearArray, function(index, value){
                filters_container.append('<li class="filter-child year" data-value="'+ value +'">'+ value +'</li>')
            }) : '';

        $('.filter-selector .filter-child').click(function () {
            $(this).hasClass('selected') ? [$(this).removeClass('selected'), $(this).addClass('removed'),
                $(this).mouseout(function () {$(this).removeClass('removed');}), button_filters.find('button:contains('+ $(this).text() +')').filter(function(){return true;}).remove()] :
                [$(this).addClass('selected'), $(this).removeClass('removed'), button_filters.append('<button class="btn_filter">' + $(this).text() + '</button>')];

            $('.btn_filter').click(function() {
                let btn_text;
                btn_text = $(this).text();
                $('.filter-selector .filter-child:contains('+ btn_text +')').filter(function () {
                    return $(this).removeClass('selected');
                });
                $(this).remove();
            });
        });
    }

	let category_btn = $('#category-selector-btn'),
        category_list = $('#category_selector'),
        category_list_item =  $('#category_selector li');
    function categorySelector() {
        category_btn.click(function () {
            category_list.hasClass('open') ? category_list.removeClass('open') : category_list.addClass('open');
        });
	}

	function categorySelected() {
        category_list_item.click(function() {
       	  	let data_value = $(this).data('value');
            category_btn.find('span').text(data_value);
            category_list.removeClass('open');
            getJudges();
	   });
	}

	function openFilter() {
        $('.filter-all').click(function() {
            let filter_selector = $('.filter-selector');
            $(this).hasClass('open') ? [$(this).removeClass('open'), filter_selector.removeClass('open')] : [$(this).addClass('open'),filter_selector.addClass('open')];
        });
    }

    function filterPastWinners(){
        let data_filters, split_filters;

        $('.box-container .unit').each(function () {
            data_filters = $(this).data('filters');
            split_filters = data_filters.split(',');

            filterChecker(filters, split_filters);

        });
    }

    function filterChecker(filters, unit) {
        return (filters, unit) => target.every(v => filters.includes(v));
    }

	//API Function
	let test;
    function callAPIEndpoint(endpoint, method, postData, callback) {
        let httpRequest =  new XMLHttpRequest();
        httpRequest.open(method, endpoint, true);
        httpRequest.onreadystatechange = function() {
            if(httpRequest.readyState == 4) {
                if(httpRequest.status == 200) {
                    if(callback) {
                        callback(JSON.parse(httpRequest.response));
                    }
                }
            }
        };
        if(postData) {
            if(test) {
                postData += '&test=1';
            }
            httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            httpRequest.send(postData);
        } else {
            httpRequest.send(null);
        }
    }

    function getJudges() {
        /*
        callAPIEndpoint('ajax/getJudges', 'POST', 'category=' + category_btn.text(), function (result) {
            $('.judges-result div').remove();
			let data_append;
			 result.data.length > 0 ?
             $.each(result.data, function(index, value){
                data_append = '<div class="unit size1of3 center-align">' +
                    '<div class="judge-profile">' +
                    '<img src="'+ value.image[0]['filename'] +'">' +
                    '<h3 class="judge-name">'+ value.judge_name +'</h3>' +
                    '<p>'+ value.judge_position +'</p>' +
                    '</div>' +
                    '</div>';
                $('.judges-result').append(data_append);
             }) : '';
        });
        */
	}

    function otherSettings() {
        let navigation_li = $('.parent-ul .parent-li');
        let wow = new WOW(
            {
                offset: 150,    // distance to the element when triggering the animation (default is 0)
                //mobile: true,  // trigger animations on mobile devices (default is true)
                live: true,     // act on asynchronously loaded content (default is true)
                callback: function(box) {
                    // the callback is fired every time an animation is started
                    // the argument that is passed in is the DOM node being animated
                },
                scrollContainer: null // optional scroll container selector, otherwise use window
            }
        );
        wow.init();

        lightbox.option({
            'resizeDuration': 300,
            'wrapAround': true,
            'maxHeight': 800,
            'maxWidth': 800,
            'positionFromTop' : 200
        });


        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight){
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }

        $('.nav-open-button').click(function() {
            $(this).hasClass('open') ? [$('body').removeClass('nav-open'), $(this).removeClass('open'),
                $('.mobile-nav').removeClass('open')] : [$('body').addClass('nav-open'), $(this).addClass('open'), $('.mobile-nav').addClass('open')];
        });

        navigation_li.mouseover(function () {
            navigation_li.each(function () {
                $(this).find('.dropdown').removeClass('open');
            });
            $(this).find('.dropdown').addClass('open');
            $(this).addClass('hover-active');
        });

        navigation_li.mouseout(function () {
            navigation_li.each(function () {
                $(this).find('.dropdown').removeClass('open');
                $(this).removeClass('hover-active');
            });
        });

        $(".parent-li a").on('click', function(event) {
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                // Store hash
                let hash = this.hash,
                    location = ($(hash).offset().top - 350);

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: location
                }, 800, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
	}
    $(window).resize(function() {
        //pageBlockSize();
    });

    $(window).load(function() {
       let grid = $('.grid')
        //Isotope
        grid.isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                // use outer width of grid-sizer for columnWidth
                horizontalOrder: true
            },
            reLayout: true
        });

        boxSize();
    })
}(jQuery));




