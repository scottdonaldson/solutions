/* Use this script if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-facebook' : '&#xe000;',
			'icon-twitter' : '&#xe001;',
			'icon-linkedin' : '&#xe002;',
			'icon-google-plus' : '&#xe003;',
			'icon-support' : '&#xe004;',
			'icon-design' : '&#xe005;',
			'icon-prototyping' : '&#xe006;',
			'icon-validation' : '&#xe007;',
			'icon-compliance' : '&#xe008;',
			'icon-management' : '&#xe009;',
			'icon-pencil' : '&#xe00a;',
			'icon-close' : '&#xe00b;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; i < els.length; i += 1) {
		el = els[i];
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
};