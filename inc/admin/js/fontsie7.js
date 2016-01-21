/* To avoid CSS expressions while still supporting IE 7 and IE 6, use this script */
/* The script tag referring to this file must be placed before the ending body tag. */

(function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'sampression\'">' + entity + '</span>' + html;
	}
	var icons = {
		'icon-youtube': '&#xe60b;',
		'icon-yahoo': '&#xe60c;',
		'icon-viemo': '&#xe60d;',
		'icon-linkedin': '&#xe60f;',
		'icon-twitter': '&#xe609;',
		'icon-googleplus': '&#xe610;',
		'icon-flicker': '&#xe611;',
		'icon-facebook': '&#xe612;',
		'icon-support-desk': '&#xe613;',
		'icon-view-changes-log': '&#xe614;',
		'icon-theme-documentation': '&#xe615;',
		'icon-sam-widget-manager': '&#xe600;',
		'icon-sam-styling': '&#xe601;',
		'icon-sam-shortcodes': '&#xe603;',
		'icon-sam-miscellaneous': '&#xe604;',
		'icon-sam-logos-icons': '&#xe605;',
		'icon-sam-import-export': '&#xe606;',
		'icon-sam-image-settings': '&#xe607;',
		'icon-sam-hooks': '&#xe608;',
		'icon-sam-custom-css': '&#xe602;',
		'icon-sam-blog': '&#xe60a;',
		'icon-sam-social-media': '&#xe48c;',
		'icon-check': '&#xe60e;',
		'icon-sam-typogrpahy': '&#xe44a;',
		'0': 0
		},
		els = document.getElementsByTagName('*'),
		i, attr, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
}());
