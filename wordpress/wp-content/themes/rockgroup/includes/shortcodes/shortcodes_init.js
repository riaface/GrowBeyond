// Shortcodes init
jQuery(document).ready(function() {
	"use strict";
	initShortcodes(jQuery('body').eq(0));
});

function initShortcodes(container) {
	"use strict";
	// Tabs
	if (container.find('.sc_tabs:not(.inited)').length > 0) {
		var sc_tabs_effetcs = container.find('.sc_tabs:not(.inited)').hasClass('sc_tabs_effects');
		container.find('.sc_tabs:not(.inited)')
			.addClass('inited')
			.tabs({
				show: {
					direction: sc_tabs_effetcs ? 'right' : '',
					effect: sc_tabs_effetcs ? 'slide' : 'fade',
					duration: sc_tabs_effetcs ? 500 : 250,
				},
				hide: {
					direction: sc_tabs_effetcs ? 'left' : '',
					effect: sc_tabs_effetcs ? 'slide' : 'fade',
					duration: sc_tabs_effetcs ? 500 : 250,
				},
				create: function (event, ui) {
					initShortcodes(ui.panel);
				},
				activate: function (event, ui) {
					initShortcodes(ui.newPanel);
				}
			});
	}


	// Accordion
	if (container.find('.sc_accordion_init:not(.inited)').length > 0) {
		container.find(".sc_accordion_init:not(.inited)").each(function () {
			var init = jQuery(this).data('active');
			if (isNaN(init)) init = 0;
			else init = Math.max(0, init);
			jQuery(this)
				.addClass('inited')
				.accordion({
					active: init,
					heightStyle: "content",
					header: "> .sc_toggl_item > .sc_toggl_title",
					create: function (event, ui) {
						initShortcodes(ui.panel);
						ui.header.each(function () {
							jQuery(this).parent().addClass('sc_active');
						});
					},
					activate: function (event, ui) {
						initShortcodes(ui.newPanel);
						ui.newHeader.each(function () {
							jQuery(this).parent().addClass('sc_active');
						});
						ui.oldHeader.each(function () {
							jQuery(this).parent().removeClass('sc_active');
						});
					}
				});
		});
	}

	// Toggles
	if (container.find('.sc_toggles_init:not(.inited)').length > 0) {
		container.find('.sc_toggles_init .sc_toggl_title:not(.inited)')
			.addClass('inited')
			.click(function () {
				jQuery(this).parent().toggleClass('sc_active');
				jQuery(this).parent().find('.sc_toggl_content').slideToggle(200, function () { 
					initShortcodes(jQuery(this).parent().find('.sc_toggl_content')); 
				});
			});
	}

	// Tooltip
	if (container.find('.sc_tooltip:not(.inited)').length > 0) {
		container.find('.sc_tooltip:not(.inited)')
			.addClass('inited')
			.hover(function () {
				"use strict";
				var obj = jQuery(this);
				obj.find('.sc_tooltip_item').stop().animate({
					'marginTop': '5'
				}, 100).show();
			},
			function () {
				"use strict";
				var obj = jQuery(this);
				obj.find('.sc_tooltip_item').stop().animate({
					'marginTop': '0'
				}, 100).hide();
			});
	}

	// Infoboxes
	if (container.find('.sc_infobox.sc_infobox_closeable:not(.inited)').length > 0) {
		container.find('.sc_infobox.sc_infobox_closeable:not(.inited)')
			.addClass('inited')
			.click(function () {
				jQuery(this).slideUp();
			});
	}

	//icons widget
	if (jQuery('.sc_icons_widget:not(.inited)').length > 0) {
		iconsWidgetInit(container);
		jQuery(window).scroll(function () { iconsWidgetInit(container); });
	}

	// team
	if (container.find('.sc_team.sc_team_vertical:not(.inited)').length > 0) {
		container.find('.sc_team.sc_team_vertical:not(.inited)')
			.addClass('inited');
	}

	// Contact form
	if (container.find('.sc_form .sc_form_button .sc_button:not(.inited)').length > 0 && container.find('.sc_form').data('formtype') == 'contact' ) {
		container.find('.sc_form .sc_form_button .sc_button:not(.inited)')
			.addClass('inited')
			.click(function(e){
				userSubmitForm(jQuery(this).parents("form"), THEMEREX_ajax_url, THEMEREX_ajax_nonce);
				e.preventDefault();
				return false;
			});
	}


	// Bordered images
	if (container.find('.sc_border:not(.inited)').length > 0) {
		container.find('.sc_border:not(.inited)')
			.each(function () {
				"use strict";
				if (jQuery(this).parents('div:hidden').length > 0) return;
				jQuery(this).addClass('inited');
				var w = Math.round(jQuery(this).width());
				var h = Math.round(w/4*3);
				jQuery(this).find('.slides').css({height: h+'px'});
				jQuery(this).find('.slides li').css({width: w+'px', height: h+'px'});
			});
	}

	
	//slider
	if (jQuery('.sc_slider:not(.inited)').length > 0) {
		swiper_slider_init(container);
		jQuery(window).scroll(function () { swiper_slider_init(container); });
	}
	
	//Scroll
	if (container.find('.sc_scroll:not(.inited)').length > 0) {
		var myScroll = {};
		container.find('.sc_scroll:not(.inited)')
			.each(function () {
				"use strict";
				if (jQuery(this).parents('div:hidden').length > 0) return;
				jQuery(this).addClass('inited');
				var id = jQuery(this).attr('id');
				if (id == undefined) {
					id = 'scroll_'+Math.random();
					id = id.replace('.', '');
					jQuery(this).attr('id', id);
				}
				jQuery(this).addClass(id);
				myScroll[id] = new Swiper('.'+id, {
					freeMode: true,
					freeModeFluid: true,
					grabCursor: true,
					mode: jQuery(this).hasClass('sc_scroll_vertical') ? 'vertical' : 'horizontal',
					slidesPerView: jQuery(this).hasClass('sc_scroll') ? 'auto' : 1,
					mousewheelControl: true,
					mousewheelAccelerator: 4,	// Accelerate mouse wheel in Firefox 4+
					scrollContainer: jQuery(this).hasClass('sc_scroll_vertical'),
					scrollbar: {
						container: '.'+id+'_bar',
						hide: true,
						draggable: true  
					}
				})
			});
	}

	//Countdown
	if (container.find('.sc_countdown_counter:not(.inited)').length > 0) {
		var myCountdown = {};
		container.find('.sc_countdown_counter:not(.inited)').each(function () {
				"use strict";
				if (jQuery(this).parents('div:hidden').length > 0) return;
				jQuery(this).addClass('inited');
				var id = jQuery(this).attr('id');
				if (id == undefined) {
					id = 'countdown_'+Math.random();
					id = id.replace('.', '');
					jQuery(this).attr('id', id);
				}
				var style = jQuery(this).data('style');
				var curDate = new Date();
				var endDate = jQuery(this).data('date');
				if (endDate == undefined || endDate == ''){
					var cur_date_year = curDate.getFullYear();
					var cur_date_mounth = (curDate.getMonth()+2) % 12;
						cur_date_mounth = cur_date_mounth<10 ?  '0'+cur_date_mounth : cur_date_mounth;
					var cur_date_day = curDate.getDate()<10 ? '0'+curDate.getDate() : curDate.getDate();
					endDate = cur_date_year+'-'+cur_date_mounth+'-'+cur_date_day;
				}
				endDate = endDate.split('-');
				var endTime = jQuery(this).data('time');
				if (endTime == undefined || endTime == ''){
					endTime = '00:00:00';
				}
				endTime = endTime.split(':');
				if (endTime.length==2){
					endTime[2] = 0;
				}
				var destDate = new Date(endDate[0], endDate[1]-1, endDate[2], endTime[0], endTime[1], endTime[2]);
				var diff = Math.round(destDate.getTime() / 1000 - curDate.getTime() / 1000);
				
				if( style == 'flip'){
					myCountdown[id] = jQuery('#'+id).FlipClock(diff, {
						countdown: true,
						clockFace: 'DailyCounter'
					});
				} else {
					myCountdown[id] = jQuery('#'+id).countdown({
						until: diff
					});
					
				}
			});
	}

	//Zoom
	if (container.find('.sc_zoom:not(.inited)').length > 0) {
		container.find('.sc_zoom:not(.inited)')
			.each(function () {
				if (jQuery(this).parents('div:hidden').length > 0) return;
				jQuery(this).addClass('inited');
				jQuery(this).find('img').elevateZoom({
					zoomType: "lens",
					//borderColour: "#8c8c8c",
					borderSize: 0,
					lensShape: "round",
					lensSize: 200
				});
			});
	}

	//skills init
	if (container.find('.sc_skills_item:not(.inited)').length > 0) {
		skills_init(container);
		jQuery(window).scroll(function () { skills_init(container); });
	}
	//skills type='arc' init
	if (jQuery('.sc_skills_arc:not(.inited)').length > 0) {
		skills_arc_init(container);
		jQuery(window).scroll(function () { skills_arc_init(container); });
	}

	//chart type='arc' init
	if (jQuery('.sc_chart_diagram:not(.inited)').length > 0) {
		chart_diagram_init(container);
		jQuery(window).scroll(function () { chart_diagram_init(container); });
	}

	//rocks skills init
	if (jQuery('.sc_rocks_skills:not(.inited)').length > 0) {
		rocks_skills_init(container);
		jQuery(window).scroll(function () { rocks_skills_init(container); });
	}

	//around list init
	if (jQuery('.sc_around_list:not(.inited)').length > 0) {
		around_list_init(container);
		jQuery(window).scroll(function () { around_list_init(container); });
	}

	//islands
	if (jQuery('.sc_islands:not(.inited)').length > 0) {
		IslandsInit(container);
		jQuery(window).scroll(function () { IslandsInit(container); });
	}

	// eform
	jQuery('.sc_eform_form .sc_eform_input, .sc_eform_form .sc_eform_button').click(function (e) {
		"use strict";
		e.stopPropagation();
	});

	jQuery(document).click(function (e) {
		"use strict";
		jQuery('.sc_eform_form.sc_eform_hide').removeClass('sc_eform_opened');
	});

	jQuery('.sc_eform_form .sc_eform_button').click(function (e) {
		"use strict";
		var form = jQuery(this).parents('.sc_eform_form');
		var input = form.find('.sc_eform_input');
		var type = form.data('type');
		form.addClass('sc_eform_opened');
		e_form( jQuery(this).parents('.sc_eform_form') )
		return false;
	});


}

// eform 
function e_form(container){
"use strict";
	var form = container;
	var input = form.find('.sc_eform_input');
	var button = form.find('.sc_eform_button');
	var type = form.data('type');

		//emailer
		if (form.length>0 && type == 'emailer' ) {
			if (button.hasClass('sc_eform_button')) {
				var group = button.data('group');
				var email = input.val();
				var regexp = new RegExp(THEMEREX_EMAIL_MASK);
				if (!regexp.test(email)) {
					input.get(0).focus();
					themerex_message_warning(THEMEREX_EMAIL_NOT_VALID);
				} else {
					jQuery.post(THEMEREX_ajax_url, {
						action: 'emailer_submit',
						nonce: THEMEREX_ajax_nonce,
						group: group,
						email: email
					}).done(function(response) {
						var rez = JSON.parse(response);
						if (rez.error === '') {
							themerex_message_success(THEMEREX_MESSAGE_EMAIL_ADDED.replace('%s', email));
							input.val('');
						} else {
							themerex_message_warning(rez.error);
						}
					});
				}
			} else {
				form.get(0).submit();
				}
		//search
		} else if (form.length>0 && type == 'search'){
			if (button.hasClass('sc_eform_button')) {
				if(  input.val() != '')
					form.get(0).submit();
			}
				
		} else  {
			jQuery(document).trigger('click');
		}
		//endIF
}

	


// skills init
function skills_init(container) {
	if (arguments.length==0) var container = jQuery('body');
	var scrollPosition = jQuery(window).scrollTop() + jQuery(window).height();

	container.find('.sc_skills_item:not(.inited)').each(function () {
		var skillsItem = jQuery(this);
		var scrollSkills = skillsItem.offset().top;
		if (scrollPosition > scrollSkills) {
			if (jQuery(this).parents('div:hidden').length > 0) return;
			skillsItem.addClass('inited');
			var skills = skillsItem.parents('.sc_skills').eq(0);
			var type = skills.data('type');
			var total = skillsItem.find('.sc_skills_total').eq(0);
			var start = parseInt(total.data('start'));
			var stop = parseInt(total.data('stop'));
			var maximum = parseInt(total.data('max'));
			var startPercent = Math.round(start/maximum*100);
			var stopPercent = Math.round(stop/maximum*100);
			var ed = total.data('ed');
			var duration = parseInt(total.data('duration'));
			var speed = parseInt(total.data('speed'));
			var step = parseInt(total.data('step'));
			if (type == 'bar') {
				var dir = skills.data('dir');
				var count = skillsItem.find('.sc_skills_count').eq(0);
				if (dir=='horizontal')
					count.css('width', startPercent + '%').addClass('sc_skills_count_init').animate({ width: stopPercent + '%' }, duration);
				else if (dir=='vertical')
					count.css('height', startPercent + '%').addClass('sc_skills_count_init').animate({ height: stopPercent + '%' }, duration);
				skills_counter(start, stop, speed-(dir!='unknown' ? 5 : 0), step, ed, total);
			} else if (type == 'counter') {
				skills_counter(start, stop, speed - 5, step, ed, total);
			} else if (type == 'pie') {
				var steps = parseInt(total.data('steps'));
				var color = total.data('color');
				var easing = total.data('easing');
	
				skills_counter(start, stop, Math.round(1500/steps), step, ed, total);
				var R = hexToR(color);
		        var G = hexToG(color);
		        var B = hexToB(color);

		        sec_color = 'rgba(' + R + ',' + G + ',' + B + ', 0.7)';				
		        var options = {
					segmentShowStroke: true,
					segmentStrokeColor: "transparent",
					percentageInnerCutout: 0,
					animationSteps: steps,
					animationEasing: easing,
					animateRotate: true,
					animateScale: false,
				};
	
				var pieData = [{
					value: stopPercent,
					color: color
				}, {
					value: 100 - stopPercent,
					color: sec_color
				}];
				var canvas = skillsItem.find('canvas');
				canvas.attr({width: skillsItem.width(), height: skillsItem.width()}).css({width: skillsItem.width(), height: skillsItem.height()});
				var pie = new Chart(canvas.get(0).getContext("2d")).Doughnut(pieData, options);
			}
		}
	});
}

//skills counter animation
function skills_counter(start, stop, speed, step, ed, total) {
	total.html('<span>'+start+ed+'</span>');
	start = Math.min(stop, start + step);
	if (start <= stop) {
		setTimeout(function () {
			skills_counter(start, stop, speed, step, ed, total);
		}, speed);
	}
}

//skills arc init
function skills_arc_init(container) {
	if (arguments.length==0) var container = jQuery('body');
	container.find('.sc_skills_arc:not(.inited)').each(function () {
		var arc = jQuery(this);
		arc.addClass('inited');
		var canvas = arc.find('.sc_skills_arc_canvas').eq(0);
		var legend = arc.find('.sc_skills_legend').eq(0);
		var w = Math.round((arc.width() - legend.width())*1);
		if(jQuery(window).width() < 449 || (jQuery(window).width() < 669 && jQuery('#wrap').hasClass('bodyStyleBoxed'))){
			w = arc.width();
		}
		var c = Math.floor(w/2)+5;
		var o = {
			random: function(l, u){
				return Math.floor((Math.random()*(u-l+1))+l);
			},
			diagram: function(){
				var r = Raphael(canvas.attr('id'), w, w),
					rad = Math.round(w/9),
					speed = 400;
				
				r.circle(c, c, Math.round(w/5)).attr({ stroke: 'none', fill: 'transparent' });
				
				var title = r.text(c, c, THEMEREX_SC_SKILLS).attr({
					font: '400 '+rad+'px '+THEMEREX_GLOBAL_FONTS,
					fill: '#222222'
				}).toFront();
				
				r.customAttributes.arc = function(value, color, rad){
					var v = 3.6 * value,
						alpha = v == 360 ? 359.99 : v,
						rand = o.random(91, 240),
						a = (rand-alpha) * Math.PI/180,
						b = rand * Math.PI/180,
						sx = c + rad * Math.cos(b),
						sy = c - rad * Math.sin(b),
						x = c + rad * Math.cos(a),
						y = c - rad * Math.sin(a),
						path = [['M', sx, sy], ['A', rad, rad, 0, +(alpha > 180), 1, x, y]];
					return { path: path, stroke: color }
				}
				
				jQuery('.sc_skills_data').find('.arc').each(function(i){
					var t = jQuery(this), 
						color = t.find('.color').val(),
						value = t.find('.percent').val(),
						text = t.find('.text').text();
					
					rad += Math.round(w/15);
					var z = r.path().attr({ arc: [value, color, rad], 'stroke-width': Math.round(w/45) });
					
					z.mouseover(function(){
						this.animate({ 'stroke-width': Math.round(w/9), opacity: .75 }, 1000, 'elastic');
						if (Raphael.type != 'VML') //solves IE problem
						this.toFront();
						title.stop().animate({ opacity: 0 }, speed, '>', function(){
							this.attr({ text: (text ? text + '\n' : '') + value + '%' }).animate({ opacity: 1 }, speed, '<');
						});
					}).mouseout(function(){
						this.stop().animate({ 'stroke-width': Math.round(w/45), opacity: 1 }, speed*4, 'elastic');
						title.stop().animate({ opacity: 0 }, speed, '>', function(){
							title.attr({ text: THEMEREX_SC_SKILLS }).animate({ opacity: 1 }, speed, '<');
						});	
					});
				});
				
			}
		}
		o.diagram();
	});
}


//chart diagram init
function chart_diagram_init(container) {
	if (arguments.length==0) var container = jQuery('body');
	var scrollPosition = jQuery(window).scrollTop() + jQuery(window).height();

	container.find('.sc_chart_diagram:not(.inited)').each(function () {
		var chart = jQuery(this);
		var scrollSkills = chart.offset().top + 300;
		if (scrollPosition > scrollSkills) {
			chart.addClass('inited');
			var chart_flag = false;
		    var chart_invise = false;
		    var init_attempts = 0;
		    var inner_cutout = 90;

		    function chart_anim(id, doughnutData) {

		        var id = id;
		        var doughnutData = doughnutData;
		        var oft = jQuery('#' + id).offset().top;
		        var scrt = jQuery(window).scrollTop();
		        var hgt = jQuery(window).height();
		        if (chart_flag === false) {

		            var options = {
		                segmentShowStroke: 0,
		                percentageInnerCutout: inner_cutout,
		                segmentShowStroke: false
		            };
		            var myDoughnut = new Chart(document.getElementById('canvas_' + id).getContext("2d")).Doughnut(doughnutData, options);
		            chart_flag = true;

		        }
		        chart_flag = false;
		    }


		    var marg = jQuery(chart).find('canvas:first-child').width() * 0.1171875 / (-2);
		    var i = marg;
		    var S = 0;


		        var sl_width = jQuery(chart).find('canvas').css('width');

		        if (jQuery(chart).attr('data-cutout') != '' && jQuery(chart).attr('data-cutout')) {
		            inner_cutout = jQuery(chart).attr('data-cutout');
		        }

		        var Count = -1;
		        jQuery(chart).find('.sc_chart_item').each(function () {
		            var dt_percent = jQuery(this).find('canvas').attr('data-percent');
		            var dt_color = jQuery(this).find('canvas').attr('data-color');

		            var R = hexToR(dt_color);
		            var G = hexToG(dt_color);
		            var B = hexToB(dt_color);

		            dt_color = 'rgb(' + R + ',' + G + ',' + B + ')';
		            dt_color_1 = 'rgba(' + R + ',' + G + ',' + B + ', 0.7)';

		            var WH = 100 - dt_percent;
		            var SA = 100 - WH;
		            var FR = 0;
		            var SC = 0;

		            if (dt_percent <= 12) {
		                FR = SA;
		                SA = 0;
		            }
		            if (dt_percent > 12) {
		                FR = 12;
		                SA = SA - 12;
		            }
		            if (dt_percent > 62) {
		                SC = SA - 50;
		                SA = 50;
		            }

		            var doughnutData = [{
		                value: FR, //12
		                color: dt_color_1
		            }, {
		                value: SA,//63
		                color: dt_color
		            }, {
		                value: SC,
		                color: dt_color_1
		            }, {
		                value: WH,
		                color: "transparent"
		            }];
		            Count++;
		            i = i - marg;
		            inner_cutout = inner_cutout - Count;

		            var id = jQuery(this).attr('id');
		            chart_anim(id, doughnutData);
		            jQuery(this).css({
		                'margin-top': i,
		                'margin-left': i
		            });

		        });

		    setTimeout(function () {
		        jQuery(chart).find('.sc_chart_title').css('opacity', 1);
		        jQuery(chart).find('.sc_chart_content').css('opacity', 1);
		        jQuery(chart).find('.sc_chart_line').css('opacity', 1);
		        jQuery(chart).find('.name').css('opacity', 1);
		    }, 2000);


		    jQuery(chart).find('.sc_chart_item .sc_chart_content').each(function () {
		        var percent = jQuery(this).parent().find('canvas').attr('data-percent');
		        var height = jQuery(this).parent().find('canvas').height() / 2;

		        if (percent < 25) var plots = (100 + percent) * 10 - 250;
		        else var plots = percent * 10 - 250;

		        var increase = Math.PI * 2 / 1000,
		            angle = 0,
		            x = 0,
		            y = 0;
		        for (var i = 1; i < plots; i++) {
		            angle += increase;
		        }

		        x = (height + height * 0.35) * Math.cos(angle) + height;
		        y = (height + height * 0.35) * Math.sin(angle) + height;

		        if (percent == 50){ x = x - jQuery(this).width() / 2 - 3; y = y + 10;}
		        if (percent > 50 && percent < 80) x = x - jQuery(this).width();
		        if (percent > 50 || percent < 26) y = y - jQuery(this).height() / 2;
		        if (percent > 75) { y = y - jQuery(this).height() / 2 - 10; x = x - jQuery(this).width() / 2; }
		        jQuery(this).css({
		            'left': x,
		            'top': y
		        });

		        var T= 0; var L=0;
		        if(jQuery(this).find('.icon').length > 0)
		        {
		       		var position = jQuery(this).find('.icon').position();
		       	 	T = position.top + jQuery(this).find('.icon').height() + 40;
		       	 	L = position.left - 160 + jQuery(this).width() / 2;
		     	}
		        jQuery(this).find('.content').css({
		            'top': T,
		            'left': L
		        });
		    });

		    var k = 0;
		    jQuery(chart).find('.sc_chart_item .sc_chart_line').each(function () {
		        var percent = jQuery(this).parent().find('canvas').attr('data-percent');
		        var ItemHeight = jQuery(this).parent().find('canvas').height();
		        var LineHeight = ItemHeight + ItemHeight * 0.35;
		        plots = percent * 10 - 250;
		        increase = Math.PI * 2 / 1000,
		            angle = 0,
		            x = 0,
		            y = 0;
		        var U = percent * 360 / 100;
		        k = k + marg;
		        if (percent > 50) x = x - jQuery(this).width();
		        jQuery(this).css({
		            'height': LineHeight,
		            'transform': 'rotate(' + U + 'deg)',
		            'left': (ItemHeight / 2),
		            'top': ((ItemHeight - LineHeight) / 2)
		        });
		        var t = jQuery(this).parent().find('canvas').height() * 0.18  + marg * (-0.9);
		        jQuery(this).find('.sc_chart_tail').css('height', t);
		        
		    });

		    jQuery(chart).find('.sc_chart_content img').mouseover(function () {
		        jQuery(this).parent().find('.content').show();
		    });

		    jQuery(chart).find('.sc_chart_content img').mouseout(function () {
		        jQuery(this).parent().find('.content').hide();
		    });
		}

	});
}


function hexToR(h) {
    return parseInt((cutHex(h)).substring(0, 2), 16)
}

function hexToG(h) {
    return parseInt((cutHex(h)).substring(2, 4), 16)
}

function hexToB(h) {
    return parseInt((cutHex(h)).substring(4, 6), 16)
}

function cutHex(h) {
    return (h.charAt(0) == "#") ? h.substring(1, 7) : h
}


//rocks skills init
function rocks_skills_init(container) {
	if (arguments.length==0) var container = jQuery('body');
	var scrollPosition = jQuery(window).scrollTop() + jQuery(window).height();


	container.find('.sc_rocks_skills:not(.inited)').each(function () {
		var chart = jQuery(this);
		var scrollSkills = chart.offset().top + 500;

		if (scrollPosition > scrollSkills) {
			chart.addClass('inited');
			var item = jQuery(this);
			var width = jQuery(this).width();
			var count =  jQuery(item).find('.sc_rocks_row').length;
			var shadow = width/count;
			var maxHeight = jQuery(item).find('.sc_rocks_row .sc_rocks_progress').css('height');

			jQuery(item).find('.sc_rocks_row').each(function () {
			    var percent = jQuery(this).find('.sc_rocks_progress').attr('data-process');
			    percent = percent.replace('%', '');
			    maxHeight = maxHeight.replace('px', '');
			    var x = maxHeight * percent / 100;
			           
			    jQuery(this).find('.sc_rocks_progress').css({
			        'height': x
			    });
			     jQuery(this).find('.sc_rocks_progressbar .sc_rocks_shadow').animate({
			                'border-bottom-width': '30px',
			                'border-right-width': shadow
			    }, 1000, "linear");
			     jQuery(this).find('.sc_rocks_progress .sc_rocks_before, .sc_rocks_progress .sc_rocks_after ').animate({
			                'border-bottom-width': x
			    }, 1600, "linear", function () {
			                jQuery('.sc_rocks_row').find('.sc_rocks_value, .sc_rocks_caption').css('opacity', 1);
			            });
			});
		}
	    
	});
}

//around list init
function around_list_init(container) {
	if (arguments.length==0) var container = jQuery('body');
	var scrollPosition = jQuery(window).scrollTop() + jQuery(window).height();
		
	container.find('.sc_around_list:not(.inited)').each(function () {
		var item = jQuery(this);
		var scrollSkills = item.offset().top;

		if (scrollPosition > scrollSkills) {
			item.addClass('inited');
			var left_numb = jQuery(item).find('.sc_around_left .sc_around_item').length;
			if(left_numb == 2){
				jQuery(item).find('.sc_around_left .sc_around_item:nth-child(1) .sc_around_line').addClass('rotate_bottom');
				jQuery(item).find('.sc_around_left .sc_around_item:nth-child(2) .sc_around_line').addClass('rotate_top');
			}
			if(left_numb == 3){
				jQuery(item).find('.sc_around_left .sc_around_item:nth-child(1) .sc_around_line').addClass('rotate_bottom');
				jQuery(item).find('.sc_around_left .sc_around_item:nth-child(3) .sc_around_line').addClass('rotate_top');
			}

			var right_numb = jQuery(item).find('.sc_around_right .sc_around_item').length;
			if(right_numb == 2){
				jQuery(item).find('.sc_around_right .sc_around_item:nth-child(1) .sc_around_line').addClass('rotate_bottom');
				jQuery(item).find('.sc_around_right .sc_around_item:nth-child(2) .sc_around_line').addClass('rotate_top');
			}
			if(right_numb == 3){
				jQuery(item).find('.sc_around_right .sc_around_item:nth-child(1) .sc_around_line').addClass('rotate_bottom');
				jQuery(item).find('.sc_around_right .sc_around_item:nth-child(3) .sc_around_line').addClass('rotate_top');
			}

			setTimeout(function(){ jQuery(item).find('.sc_around_item a span').css('opacity', 1);  }, 500);
			setTimeout(function(){ jQuery(item).find('.sc_around_item .sc_around_line').css('opacity', 1); }, 1000);
			

			
		}
	    
	});
}

//islands
function IslandsInit(container){
	if (arguments.length==0) var container = jQuery('body');
		var scrollPosition = jQuery(window).scrollTop() + jQuery(window).height();
			
		container.find('.sc_islands:not(.inited)').each(function () {
			var item = jQuery(this);
			var scrollSkills = item.offset().top + 200;

			if (scrollPosition > scrollSkills) {
				item.addClass('inited'); 
				setTimeout(function(){ jQuery(item).find('.sc_island_item.style_1').css('margin-top','0'); }, 900);
				setTimeout(function(){ jQuery(item).find('.sc_island_item.style_2').css('margin-top','0'); }, 400);
				setTimeout(function(){ jQuery(item).find('.sc_island_item.style_3').css('margin-top','0'); }, 1200);
				setTimeout(function(){ jQuery(item).find('.sc_island_item.style_4').css('margin-top','0'); }, 900);
				setTimeout(function(){ jQuery(item).find('.sc_island_item.style_5').css('margin-top','0'); }, 400);
				setTimeout(function(){ jQuery(item).find('.sc_island_item .sc_island_title ').css('opacity', 1); }, 2200);
			}
		});
}

//swiper slider
function swiper_slider_init(container) {

	if (arguments.length==0) var container = jQuery('body');
		var scrollPosition = jQuery(window).scrollTop() + jQuery(window).height();

	if (container.find('.sc_slider_swiper:not(.inited)').length > 0 ) {

		var mySwiper = {};
		//swiper auho height
		jQuery('.sc_slider_swiper.sc_slider_swiper_autoheight').each(function() {
			var sl_width = jQuery(this).width();
			jQuery(this).css('height','auto')
			jQuery(this).find('li.swiper-slide').each(function() {
				if( jQuery(this).find('img').length > 0 && jQuery(this).find('img').attr('width').replace('px', '') >= sl_width ){
					var img_width = jQuery(this).find('img').attr('width').replace('px', '');
					var img_height = jQuery(this).find('img').attr('height').replace('px', '');
					var li_height = sl_width / img_width * img_height;
				} else {
					var li_height = jQuery(this).height();
				}
				jQuery(this).attr('data-autoheight', li_height );
			});
		});


		container.find('.sc_slider_swiper:not(.inited)').each(function () {
				"use strict";
				var item = jQuery(this);
				var scrollSlider = item.offset().top;
				if (scrollPosition > scrollSlider) {

					if (jQuery(this).parents('div:hidden').length > 0) return;
					jQuery(this).addClass('inited');
					var id = jQuery(this).attr('id');
					if (id == undefined) {
						id = 'swiper_'+Math.random();
						id = id.replace('.', '');
						jQuery(this).attr('id', id);
					}
						//specify height
						var firstSlider = jQuery(this).find('li.swiper-slide').eq(0);
						var firstHeight = firstSlider.data('autoheight');
						var firstTheme = firstSlider.data('theme') != undefined ? 'sc_slider_'+firstSlider.data('theme') : '';
						var testimonialAuthor = firstSlider.hasClass('sc_testimonials_item_author_show') ? 'sc_testimonials_author_show' : '';
						jQuery(this).addClass(id+' '+firstTheme+' '+testimonialAuthor ).css('height', firstHeight);
						firstSlider.css('height', firstHeight);

					//init slider
					mySwiper[id] = new Swiper('.'+id, {
						loop: true,
						grabCursor: true,
						calculateHeight: false,
						pagination: jQuery(this).hasClass('sc_slider_pagination') ? '#'+id+' .slider-pagination-nav' : false,
					    paginationClickable: true,
						autoplay: 7000,
						speed: 600,
						onFirstInit: function (swiper){ /*operation*/ },
						onSlideChangeStart: function (swiper){
						var activeIndex = swiper.activeIndex;
							var sliderContainer = swiper.container;
							var sliderLi = jQuery(sliderContainer).find('li.swiper-slide').eq(activeIndex)
							var theme = sliderLi.data('theme') != undefined ? 'sc_slider_'+sliderLi.data('theme') : '';
							var testimonialAuthor = sliderLi.hasClass('sc_testimonials_item_author_show') ? 'sc_testimonials_author_show' : '';
							var height = sliderLi.data('autoheight');
							jQuery('#'+id).removeClass('sc_slider_light sc_slider_dark sc_testimonials_author_show').addClass( theme+' '+testimonialAuthor );
							sliderLi.css('height',height);
							jQuery('#'+id).css('height',height);
							jQuery('#'+id).find('.swiper-wrapper').css('height',height);
					},
					});
						

					var navi = jQuery(this).find('.slider-control-nav');
					if (navi.length == 0) navi = jQuery(this).siblings('.slider-control-nav');
					navi.find('.slide-prev').click(function(e){
						var swiper = jQuery(this).parents('.sc_slider_swiper');
						if (swiper.length == 0) swiper = jQuery(this).parents('.slider-control-nav').siblings('.sc_slider_swiper');
						var id = swiper.attr('id');
						e.preventDefault();
						mySwiper[id].swipePrev();
					});
					navi.find('.slide-next').click(function(e){
						var swiper = jQuery(this).parents('.sc_slider_swiper');
						if (swiper.length == 0) swiper = jQuery(this).parents('.slider-control-nav').siblings('.sc_slider_swiper');
						var id = swiper.attr('id');
						e.preventDefault();
						mySwiper[id].swipeNext();
					});
				}
		});
		
	}
}

//icons widget
function iconsWidgetInit(container){
	if (arguments.length==0) var container = jQuery('body');
		var scrollPosition = jQuery(window).scrollTop() + jQuery(window).height();
			
		container.find('.sc_icons_widget:not(.inited)').each(function () {
			var item = jQuery(this);
			var scrollSkills = item.offset().top + 200;

			if (scrollPosition > scrollSkills) {
				item.addClass('inited'); 
				var x = jQuery(this).find('.sc_icons_item.active').length;
				var color = jQuery(this).find('.sc_icons_item.active').data('color');
				var i = 1;
				step(jQuery(this), i , x, color);
			}
		});
}
function step(item, i , x, color){
	jQuery(item).find('.sc_icons_item.active:nth-child('+ i +')').css({'color': color});
	i++;
	if(i <= x)
	{
		setTimeout(function(){ step(item, i , x, color); }, 200);
	}
}