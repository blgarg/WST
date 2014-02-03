/**
Script: Slideshow.js
	Slideshow - A javascript class for Mootools to stream and animate the presentation of images 
*/
(function(){
	WhenPaused = 1 << 0;
	WhenPlaying = 1 << 1;
	OnStart = 1 << 2;
	
	Slideshow = new Class({
		Implements: [Chain, Events, Options],
options: {/*
			onComplete: $empty,
			onEnd: $empty,
			onStart: $empty,*/
		    accesskeys: {'first': {'key': 'shift left', 'label': 'Shift + Leftwards Arrow'}, 'prev': {'key': 'left', 'label': 'Leftwards Arrow'}, 'pause': {'key': 'p', 'label': 'P'}, 'next': {'key': 'right', 'label': 'Rightwards Arrow'}, 'last': {'key': 'shift right', 'label': 'Shift + Rightwards Arrow'}},
			captions: true,
			center: true,
			classes: [/*'slideshow', 'first', 'prev', 'play', 'pause', 'next', 'last', 'images', 'captions', 'controller', 'thumbnails', 'hidden', 'visible', 'inactive', 'active', 'loader'*/],
			controller: true,
			data: null,
			delay: 2000,
			duration: 1000,
			fast: false,
			height: false,
			href: '',
			hu: '',
			linked: false,
			loader: true,
			loop: true,
			match: /\?slide=(\d+)$/,
			overlap: true,
			paused: false,
			random: false,
			replace: [/(\.[^\.]+)$/, '$1'],
			resize: 'fill',
			slide: 0,
			thumbnails: true,
			titles: false,
			transition: 'sine:in:out',
			width: false
		},
initialize: function(el, data, options){
			this.setOptions(options);
			this.el = document.id(el);
			if (!this.el) 
				return;
			var match = window.location.href.match(this.options.match);
			this.slide = this._slide = this.options.match && match ? match[1].toInt() 
				: this.options.slide;
			this.counter = this.timeToNextTransition = this.timeToTransitionComplete = 0;
			this.direction = 'left';
			this.cache = {};
			this.paused = false;
			if (!this.options.overlap)
				this.options.duration *= 2;
			var anchor = this.el.getElement('a') || new Element('a');
			if (!this.options.href)
				this.options.href = anchor.get('href') || '';
			if (this.options.hu.length && !this.options.hu.test(/\/$/)) 
				this.options.hu += '/';
			if (this.options.fast === true)
				this.options.fast = WhenPaused | WhenPlaying;
var keys = 'slideshow first prev play pause next last images captions controller thumbnails hidden visible inactive active loader'.split(' '),
				values = keys.map(function(key, i){
					return this.options.classes[i] || key;
				}, this);
			this.classes = values.associate(keys);
			this.classes.get = function(){
				var str = '.' + this.slideshow;
				for (var i = 0, l = arguments.length; i < l; i++)
					str += '-' + this[arguments[i]];
				return str;
			}.bind(this.classes);
if (!data){
				this.options.hu = '';
				data = {};
				var thumbnails = this.el.getElements(this.classes.get('thumbnails') + ' img');
				this.el.getElements(this.classes.get('images') + ' img').each(function(img, i){
					var src = img.src,
						caption = img.alt || img.title,
						href = img.getParent().href,
						thumbnail = thumbnails[i] ? thumbnails[i].src 
							: '';
					data[src] = {'caption': caption, 'href': href, 'thumbnail': thumbnail};
				});
			}
			var loaded = this.load(data);
			if (!loaded)
				return; 
this.events = {};
			this.events.push = function(type, fn){
				if (!this[type])
					this[type] = [];
				this[type].push(fn);
				document.addEvent(type, fn);
				return this;
			}.bind(this.events);

			this.accesskeys = {};
			for (action in this.options.accesskeys){
				var obj = this.options.accesskeys[action];
				this.accesskeys[action] = accesskey = {'label': obj.label};
				['shift', 'control', 'alt'].each(function(modifier){
					var re = new RegExp(modifier, 'i');
					accesskey[modifier] = obj.key.test(re);
					obj.key = obj.key.replace(re, '');
				});
				accesskey.key = obj.key.trim();
			}
this.events.push('keyup', function(e){
				Object.each(this.accesskeys, function(accesskey, action){
					if (e.key == accesskey.key && e.shift == accesskey.shift && e.control == accesskey.control && e.alt == accesskey.alt)
						this[action]();
				}, this);			
			}.bind(this));	 
var el = this.el.getElement(this.classes.get('images')),
				img = this.el.getElement('img') || new Element('img'),
				images = el ? el.empty() 
					: new Element('div', {'class': this.classes.get('images').substr(1)}).inject(this.el),
				div = images.getSize();
			this.height = this.options.height || div.y;		
			this.width = this.options.width || div.x;
			images.set({'styles': {'height': this.height, 'width': this.width}});
			this.el.store('images', images);
			this.a = this.image = img;
			if (Browser.ie && Browser.version >= 7)
				this.a.style.msInterpolationMode = 'bicubic';
			this.a.set('styles', {'display': 'none'});
			this.b = this.a.clone();
			[this.a, this.b].each(function(img){
				anchor.clone().cloneEvents(anchor).grab(img).inject(images);
			});
this.options.captions && new Caption(this);
			this.options.controller && new Controller(this);
			this.options.loader && new Loader(this);
			this.options.thumbnails && new Thumbnails(this);
this._preload(this.options.fast & OnStart);
		},
go: function(n, direction){
			var nextSlide = (this.slide + this.data.images.length) % this.data.images.length;
			if (n == nextSlide || Date.now() < this.timeToTransitionComplete)
				return;		
			clearTimeout(this.timer);
			this.timeToNextTransition = 0;		
			this.direction = direction ? direction 
				: n < this._slide ? 'right' 
				: 'left';
			this.slide = this._slide = n;
			if (this.preloader) 
				this.preloader = this.preloader.destroy();
			this._preload((this.options.fast & WhenPlaying) || (this.paused && this.options.fast & WhenPaused));
		},
first: function(){
			this.prev(true); 
		},
prev: function(first){
			var n = 0;
			if (!first){
				if (this.options.random){
					if (this.showed.i < 2)
						return;
					this.showed.i -= 2;
					n = this.showed.array[this.showed.i];
				}
				else
					n = (this.slide - 1 + this.data.images.length) % this.data.images.length;									
			}
			this.go(n, 'right');
		},
pause: function(p){
			if (p != undefined)
				this.paused = p ? false 
					: true;
			if (this.paused){ // play
				this.paused = false;
				this.timeToTransitionComplete = Date.now() + this.timeToTransitionComplete;		
				this.timer = this._preload.delay(50, this);
				[this.a, this.b].each(function(img){
					['morph', 'tween'].each(function(p){
						if (this.retrieve(p)) this.get(p).resume();
					}, img);
				});
				this.controller && this.el.retrieve('pause').getParent().removeClass(this.classes.play);
			} 
			else { 
				this.paused = true;
				this.timeToTransitionComplete = this.timeToTransitionComplete - Date.now();
				clearTimeout(this.timer);
				[this.a, this.b].each(function(img){
					['morph', 'tween'].each(function(p){
						if (this.retrieve(p)) this.get(p).pause();
					}, img);
				});
				this.controller && this.el.retrieve('pause').getParent().addClass(this.classes.play);
			}
		},
next: function(last){
			var n = last ? this.data.images.length - 1 
				: this._slide;
			this.go(n, 'left');
		},
last: function(){
			this.next(true); 
		},
load: function(data){
			this.firstrun = true;
			this.showed = {'array': [], 'i': 0};
			if (typeOf(data) == 'array'){
				this.options.captions = false;			
				data = new Array(data.length).associate(data.map(function(image, i){ return image + '?' + i })); 
			}
			this.data = {'images': [], 'captions': [], 'hrefs': [], 'thumbnails': [], 'targets': [], 'titles': []};
			for (var image in data){
				var obj = data[image] || {},
					image = this.options.hu + image,
					caption = obj.caption ? obj.caption.trim() 
						: '',
					href = obj.href ? obj.href.trim() 
						: this.options.linked ? image 
						: this.options.href,
					target = obj.target ? obj.target.trim() 
						: '_self',
					thumbnail = obj.thumbnail ? this.options.hu + obj.thumbnail.trim() 
						: image.replace(this.options.replace[0], this.options.replace[1]),
					title = caption.replace(/<.+?>/gm, '').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, "'");
				this.data.images.push(image);
				this.data.captions.push(caption);
				this.data.hrefs.push(href);
				this.data.targets.push(target);
				this.data.thumbnails.push(thumbnail);
				this.data.titles.push(title);
			}
			if (this.options.random)
				this.slide = this._slide = Number.random(0, this.data.images.length - 1);
if (this.options.thumbnails && this.el.retrieve('thumbnails'))
				this._thumbnails();
			if (this.el.retrieve('images')){
				[this.a, this.b].each(function(img){
					['morph', 'tween'].each(function(p){
						if (this.retrieve(p)) this.get(p).cancel();
					}, img);
				});
				this.slide = this._slide = this.timeToTransitionComplete = 0;
				this.go(0);		
			}
			return this.data.images.length;
		},
/**myShow.destroy(p);*/
destroy: function(p){
			Object.each(this.events, function(array, e){
				if ('each' in array)
					array.each(function(fn){ document.removeEvent(e, fn); });
			});
			this.pause(1);
			'caption loader thumbnails'.split(' ').each(function(i, timer){
				this.options[i] && (timer = this[i].retrieve('timer')) && clearTimeout(timer);
			}, this);
			typeOf(this.el[p]) == 'function' && this.el[p]();
			delete this.el.uid;
		},
/**Private method: preload*/
_preload: function(fast){
			var src = this.data.images[this._slide].replace(/([^?]+).*/, '$1'),
				cached = loaded = !!this.cache[src];
			if (!cached){
				if (!this.preloader)
				 	this.preloader = new Asset.image(src, {
						'onerror': function(){
							// do something
						},
						'onload': function(){
							this.store('loaded', true);
						}
					});
				loaded = this.preloader.retrieve('loaded') && this.preloader.get('width');
			}
			if (loaded && Date.now() > this.timeToNextTransition && Date.now() > this.timeToTransitionComplete){
				var src = this.data.images[this._slide].replace(/([^?]+).*/, '$1');
				if (this.preloader){
					this.cache[src] = {
						'height': this.preloader.get('height'),
						'src': src,
						'width': this.preloader.get('width')
					}
				}
				if (this.stopped){
					if (this.options.captions)
						this.caption.get('morph').cancel().start(this.classes.get('captions', 'hidden'));
					this.pause(1);
					if (this.end)
						this.fireEvent('end');
					this.stopped = this.end = false;
					return;				
				}
				this.image = this.counter % 2 ? this.b 
					: this.a;
				this.image.set('styles', {'display': 'block', 'height': null, 'visibility': 'hidden', 'width': null, 'zIndex': this.counter});
				this.image.set(this.cache[src]);
				this.image.width = this.cache[src].width;
				this.image.height = this.cache[src].height;
				this.options.resize && this._resize(this.image);
				this.options.center && this._center(this.image);
				var anchor = this.image.getParent();
				if (this.data.hrefs[this._slide]){
					anchor.set('href', this.data.hrefs[this._slide]);
					anchor.set('target', this.data.targets[this._slide]);			
				} 
				else {
					anchor.erase('href');
					anchor.erase('target');
				}
				var title = this.data.titles[this._slide];
				this.image.set('alt', title);		
				this.options.titles && anchor.set('title', title);
				this.options.loader && this.loader.fireEvent('hide');
				this.options.captions && this.caption.fireEvent('update', fast);				
				this.options.thumbnails && this.thumbnails.fireEvent('update', fast); 			
				this._show(fast);
				this._loaded(fast);
			} 
			else {
				if (Date.now() > this.timeToNextTransition && this.options.loader)
					this.loader.fireEvent('show');
				this.timer = this._preload.delay(50, this, fast); 
			}
		},
/**Private method: showDoes the slideshow effect.*/
_show: function(fast){
			if (!this.image.retrieve('morph')){
				var options =  this.options.overlap ? {'link': 'cancel'} : {'link': 'chain'};
				$$(this.a, this.b).set('morph', Object.merge(options, {'duration': this.options.duration, 'onStart': this._start.bind(this), 'onComplete': this._complete.bind(this), 'transition': this.options.transition}));
			}
			var hidden = this.classes.get('images', (this.direction == 'left' ? 'next' 
				: 'prev')),
				visible = this.classes.get('images', 'visible'),
				img = this.counter % 2 ? this.a 
					: this.b;
			if (fast){			
				img.get('morph').cancel().set(hidden);
				this.image.get('morph').cancel().set(visible); 			
			} 
			else {
				if (this.options.overlap){
					img.get('morph').set(visible);
					this.image.get('morph').set(hidden).start(visible);
				} 
				else {
					var fn = function(visible){
						this.image.get('morph').start(visible);
					}.pass(visible, this);
					if (this.firstrun)
						return fn();
					hidden = this.classes.get('images', (this.direction == 'left' ? 'prev' 
						: 'next'));
					this.image.get('morph').set(hidden);				
					img.get('morph').set(visible).start(hidden).chain(fn);
				}
			}
		},
/**PrivateRun after the current image has been loaded, sets up the next image to be shown.*/
_loaded: function(fast){
			this.counter++;
			this.timeToNextTransition = Date.now() + this.options.duration + this.options.delay;
			this.direction = 'left';			
			this.timeToTransitionComplete = fast ? 0 
				: Date.now() + this.options.duration;
			if (this._slide == (this.data.images.length - 1) && !this.options.loop && !this.options.random)
				this.stopped = this.end = true;
			if (this.options.random){
				this.showed.i++;
				if (this.showed.i >= this.showed.array.length){
					var n = this._slide;
					if (this.showed.array.getLast() != n) this.showed.array.push(n);
					while (this._slide == n)
						this.slide = this._slide = Number.random(0, this.data.images.length - 1);				
				}
				else
					this.slide = this._slide = this.showed.array[this.showed.i];
			}
			else {
				this.slide = this._slide;
				this._slide = (this.slide + 1) % this.data.images.length;
			}
			if (this.image.getStyle('visibility') != 'visible')
				(function(){ this.image.setStyle('visibility', 'visible'); }).delay(1, this);			
			if (this.preloader) 
				this.preloader = this.preloader.destroy();
			this.paused || this._preload();
		},
/**Private method: centerCenter an image.*/
_center: function(img){
			var size = img.getSize(), 
				h = size.y, w = size.x; 
			img.set('styles', {'left': (w - this.width) / -2, 'top': (h - this.height) / -2});
		},
/**Private method: resizeResizes an image.*/
_resize: function(img){
			var h = img.get('height').toFloat(), w = img.get('width').toFloat(),
				dh = this.height / h, dw = this.width / w;
			if (this.options.resize == 'fit')
				dh = dw = dh > dw ? dw 
					: dh;
			if (this.options.resize == 'fill')
				dh = dw = dh > dw ? dh 
					: dw;
			img.set('styles', {'height': Math.ceil(h * dh), 'width': Math.ceil(w * dw)});
		},
/**Private method: startCallback on start of slide change.*/
_start: function(){		
			this.fireEvent('start');
		},
/**Private method: completeCallback on start of slide change.*/
_complete: function(){
			if (this.firstrun && this.options.paused)
				this.pause(1);
			this.firstrun = false;
			this.fireEvent('complete');
		}	
	});
/**Private method: captions*/
var Caption = new Class({
		Implements: [Chain, Events, Options],
options: {
			delay: 0,
			link: 'cancel'			
		},
initialize: function(slideshow){
			if (!slideshow)
				return;
			var options = slideshow.options.captions;
			if (options === true)
				options = {};
			this.setOptions(options);
			var el = slideshow.el.getElement(slideshow.classes.get('captions')),
				caption = el ? el.dispose().empty()
					: new Element('div', {'class': slideshow.classes.get('captions').substr(1)});
			slideshow.caption = caption;
			caption.set({
		    	'aria-busy': false,
		    	'aria-hidden': false,
				'events': { 'update': this.update.bind(slideshow) },
				'morph': this.options,
				'role': 'description'
			}).store('delay', this.options.delay);
		    if (!caption.get('id'))
		    	caption.set('id', 'Slideshow-' + Date.now());
		    slideshow.el.retrieve('images').set('aria-labelledby', caption.get('id'));
			caption.inject(slideshow.el);
		},

		update: function(fast){
		    var empty = !this.data.captions[this._slide].length, timer;
			if (timer = this.caption.retrieve('timer'))
				clearTimeout(timer);
		    if (fast){
		      var p = empty ? 'hidden' 
				: 'visible';
		      this.caption.set({'aria-hidden': empty, 'html': this.data.captions[this._slide]}).get('morph').cancel().set(this.classes.get('captions', p));
		    }
		    else {
		      var fn1 = empty ? function(){} 
				: function(caption){
				this.caption.store('timer', setTimeout(function(caption){
			        this.caption.set('html', caption).morph(this.classes.get('captions', 'visible'));
				}.pass(caption, this), this.caption.retrieve('delay')));
		      }.pass(this.data.captions[this._slide], this);    
		      var fn2 = function(){ 
		        this.caption.set('aria-busy', false); 
		      }.bind(this);
		      this.caption.set('aria-busy', true).get('morph').cancel().start(this.classes.get('captions', 'hidden')).chain(fn1, fn2);
		    }
		}
	});
/**Private method: controller*/
var Controller = new Class({
		Implements: [Chain, Events, Options],
options: {
			link: 'cancel'			
		},
initialize: function(slideshow){
			if (!slideshow)
				return;
			var options = slideshow.options.captions;
			if (options === true)
				options = {};
			this.setOptions(options);
			var el = slideshow.el.getElement(slideshow.classes.get('controller')),
				controller = el ? el.dispose().empty()
					: new Element('div', {'class': slideshow.classes.get('controller').substr(1)});
			slideshow.controller = controller;
			controller.set({
				'aria-hidden': false, 
				'role': 'menubar'
			});
			var ul = new Element('ul', {'role': 'menu'}).inject(controller),
				i = 0;
			Object.each(slideshow.accesskeys, function(accesskey, action){
				var li = new Element('li', {
					'class': (action == 'pause' && this.options.paused) ? this.classes.play + ' ' + this.classes[action] 
						: this.classes[action]
				}).inject(ul);
				var a = this.el.retrieve(action, new Element('a', {
					'role': 'menuitem', 'tabindex': i++, 'title': accesskey.label
				}).inject(li));
				a.set('events', {
					'click': function(action){
						this[action]()
					}.pass(action, this),
					'mouseenter': function(active){
						this.addClass(active)
					}.pass(this.classes.active, a),
					'mouseleave': function(active){
						this.removeClass(active)
					}.pass(this.classes.active, a)
				});		
			}, slideshow);
			controller.set({
				'events': {
					'hide': this.hide.pass(slideshow.classes.get('controller', 'hidden'), controller),
					'show': this.show.pass(slideshow.classes.get('controller', 'visible'), controller)
				},
				'morph': this.options
			}).store('hidden', false);
			slideshow.events
				.push('keydown', this.keydown.bind(slideshow))
				.push('keyup',	this.keyup.bind(slideshow))
				.push('mousemove',	this.mousemove.bind(slideshow));
			controller.inject(slideshow.el).fireEvent('hide');
		},
hide: function(hidden){
			if (this.get('aria-hidden') == 'false')
				this.set('aria-hidden', true).morph(hidden);
		},
keydown: function(e){
			Object.each(this.accesskeys, function(accesskey, action){
				if (e.key == accesskey.key && e.shift == accesskey.shift && e.control == accesskey.control && e.alt == accesskey.alt){
					if (this.controller.get('aria-hidden') == 'true')
						this.controller.get('morph').set(this.classes.get('controller', 'visible'));
					this.el.retrieve(action).fireEvent('mouseenter');
				}					
			}, this);		
		},
keyup: function(e){
			Object.each(this.accesskeys, function(accesskey, action){
				if (e.key == accesskey.key && e.shift == accesskey.shift && e.control == accesskey.control && e.alt == accesskey.alt){
					if (this.controller.get('aria-hidden') == 'true')
						this.controller.set('aria-hidden', false).fireEvent('hide'); 
					this.el.retrieve(action).fireEvent('mouseleave');
				}					
			}, this);			
		},
mousemove: function(e){
			var images = this.el.retrieve('images').getCoordinates(),
				action = (e.page.x > images.left && e.page.x < images.right && e.page.y > images.top && e.page.y < images.bottom) ? 'show' 
					: 'hide';
			this.controller.fireEvent(action);
		},
show: function(visible){
			if (this.get('aria-hidden') == 'true')
				this.set('aria-hidden', false).morph(visible);
		}
	});
/**Private method: loader*/
var Loader = new Class({
		Implements: [Chain, Events, Options],
options: {
			fps: 20,
			link: 'cancel'			
		},
initialize: function(slideshow){
			if (!slideshow)
				return;
			var options = slideshow.options.loader;
			if (options === true)
				options = {};
			this.setOptions(options);
			var loader = new Element('div', {
				'aria-hidden': false,
				'class': slideshow.classes.get('loader').substr(1),				
				'morph': this.options,
				'role': 'progressbar'
			}).store('animate', false).store('i', 0).store('delay', 1000 / this.options.fps).inject(slideshow.el);
			slideshow.loader = loader;
			var url = loader.getStyle('backgroundImage').replace(/url\(['"]?(.*?)['"]?\)/, '$1').trim();
			if (url){
				if (url.test(/\.png$/) && Browser.ie && Browser.version < 7)
					loader.setStyles({'backgroundImage': 'none', 'filter': 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' + url + '", sizingMethod="crop")'});					
				new Asset.image(url, {'onload': function(){
					var size = loader.getSize(),
						width = this.get('width'), 
						height = this.get('height');
					if (width > size.x)
						loader.store('x', size.x).store('animate', 'x').store('frames', (width / size.x).toInt());
					if (height > size.y)
						loader.store('y', size.y).store('animate', 'y').store('frames', (height / size.y).toInt());
				}});
			}
			loader.set('events', {
				'animate': this.animate.bind(loader),
				'hide': this.hide.pass(slideshow.classes.get('loader', 'hidden'), loader),
				'show': this.show.pass(slideshow.classes.get('loader', 'visible'), loader)
			});
			loader.fireEvent('hide');
		},

		animate: function(){
			var animate = this.retrieve('animate');
			if (!animate)
				return;
			var i = (this.retrieve('i').toInt() + 1) % this.retrieve('frames');
			this.store('i', i);
			var n = (i * this.retrieve(animate)) + 'px';
			if (animate == 'x')
				this.setStyle('backgroundPosition', n + ' 0px');			
			if (animate == 'y')
				this.setStyle('backgroundPosition', '0px ' + n);			
		},

		hide: function(hidden){
			if (this.get('aria-hidden') == 'false'){
				this.set('aria-hidden', true).morph(hidden);
				if (this.retrieve('animate'))
					clearTimeout(this.retrieve('timer'));
			}
		},
show: function(visible){
			if (this.get('aria-hidden') == 'true'){
				this.set('aria-hidden', false).morph(visible);
				if (this.retrieve('animate')){
					this.store('timer', function(){ 
						this.fireEvent('animate') 
					}.periodical(this.retrieve('delay'), this));			
				}
			}
		}
	});
/**Private method: thumbnails*/
var Thumbnails = new Class({
		Implements: [Chain, Events, Options],
options: {columns: null,
			fps: 50,
			link: 'cancel',
			position: null,
			rows: null,
			scroll: null
		},
initialize: function(slideshow){
			var options = (slideshow.options.thumbnails === true) ? {} 
				: slideshow.options.thumbnails;
			this.setOptions(options);
			var el = slideshow.el.getElement(slideshow.classes.get('thumbnails')),
				thumbnails = el ? el.empty() 
					: new Element('div', {'class': slideshow.classes.get('thumbnails').substr(1)});
			slideshow.thumbnails = thumbnails;
			thumbnails.set({'role': 'menubar', 'styles': {'overflow': 'hidden'}});
			var uid = thumbnails.retrieve('uid', 'Slideshow-' + Date.now()),
				ul = new Element('ul', {'role': 'menu', 'styles': {'left': 0, 'position': 'absolute', 'top': 0}, 'tween': {'link': 'cancel'}}).inject(thumbnails);
			slideshow.data.thumbnails.each(function(thumbnail, i){
				var li = new Element('li', {'id': uid + i}).inject(ul),
					a = new Element('a', {
						'class': slideshow.classes.get('thumbnails', 'hidden').substr(1),
						'events': {
							'click': this.click.pass(i, slideshow)
						},
						'href': slideshow.data.images[i],
						'morph': this.options,
						'role': 'menuitem',
						'tabindex': i
					}).store('uid', i).inject(li);
				if (slideshow.options.titles)
					a.set('title', slideshow.data.titles[i]);
				new Asset.image(thumbnail, {
					'onload': this.onload.pass(i, slideshow)
				}).inject(a);
			}, this);
			thumbnails.set('events', {
				'scroll': this.scroll.bind(thumbnails),
				'update': this.update.bind(slideshow)
			});
			var coords = thumbnails.getCoordinates();
			if (!options.scroll)
				options.scroll = (coords.height > coords.width) ? 'y' 
					: 'x';
			var props = (options.scroll == 'y') ? 'top bottom height y width'.split(' ') 
				: 'left right width x height'.split(' ');
			thumbnails.store('props', props).store('delay', 1000 / this.options.fps);
			slideshow.events.push('mousemove', this.mousemove.bind(thumbnails));
			thumbnails.inject(slideshow.el);
		},

		click: function(i){
			this.go(i); 
			return false; 
		},
mousemove: function(e){
			var coords = this.getCoordinates();
			if (e.page.x > coords.left && e.page.x < coords.right && e.page.y > coords.top && e.page.y < coords.bottom){
				this.store('page', e.page);			
				if (!this.retrieve('mouseover')){
					this.store('mouseover', true);
					this.store('timer', function(){this.fireEvent('scroll');}.periodical(this.retrieve('delay'), this));
				}
			}
			else {
				if (this.retrieve('mouseover')){
					this.store('mouseover', false);				
					clearTimeout(this.retrieve('timer'));
				}
			}			
		},
onload: function(i){
			var thumbnails = this.thumbnails,
				a = thumbnails.getElements('a')[i];
			if (a){
				(function(a){
					var visible = i == this.slide ? 'active' 
						: 'inactive';					
					a.store('loaded', true).get('morph').set(this.classes.get('thumbnails', 'hidden')).start(this.classes.get('thumbnails', visible));	
				}).delay(Math.max(1000 / this.data.thumbnails.length, 100), this, a);
			}					
			if (thumbnails.retrieve('limit'))
				return;
			var props = thumbnails.retrieve('props'), 
				options = this.options.thumbnails,
				pos = props[1], 
				length = props[2], 
				width = props[4],
				li = thumbnails.getElement('li:nth-child(' + (i + 1) + ')').getCoordinates();
			if (options.columns || options.rows){
				thumbnails.setStyles({'height': this.height, 'width': this.width});
				if (options.columns.toInt())
					thumbnails.setStyle('width', li.width * options.columns.toInt());
				if (options.rows.toInt())
					thumbnails.setStyle('height', li.height * options.rows.toInt());
			}
			var div = thumbnails.getCoordinates();
			if (options.position){
				if (options.position.test(/bottom|top/))
					thumbnails.setStyles({'bottom': 'auto', 'top': 'auto'}).setStyle(options.position, -div.height);
				if (options.position.test(/left|right/))
					thumbnails.setStyles({'left': 'auto', 'right': 'auto'}).setStyle(options.position, -div.width);
			}
			var units = Math.floor(div[width] / li[width]),
				x = Math.ceil(this.data.images.length / units),
				r = this.data.images.length % units,
				len = x * li[length],
				ul = thumbnails.getElement('ul').setStyle(length, len);
			ul.getElements('li').setStyles({'height': li.height, 'width': li.width});
			thumbnails.store('limit', div[length] - len);
		},
scroll: function(n, fast){
			var div = this.getCoordinates(),
				ul = this.getElement('ul').getPosition(),
				props = this.retrieve('props'),
				axis = props[3], delta, pos = props[0], size = props[2], value,			
				tween = this.getElement('ul').set('tween', {'property': pos}).get('tween');	
			if (n != undefined){
				var uid = this.retrieve('uid'),
					li = document.id(uid + n).getCoordinates();
				delta = div[pos] + (div[size] / 2) - (li[size] / 2) - li[pos];
				value = (ul[axis] - div[pos] + delta).limit(this.retrieve('limit'), 0);
				tween[fast ? 'set' : 'start'](value);
			}
			else{
				var area = div[props[2]] / 3, 
					page = this.retrieve('page'), 
					velocity = -(this.retrieve('delay') * 0.01);			
				if (page[axis] < (div[pos] + area))
					delta = (page[axis] - div[pos] - area) * velocity;
				else if (page[axis] > (div[pos] + div[size] - area))
					delta = (page[axis] - div[pos] - div[size] + area) * velocity;			
				if (delta){			
					value = (ul[axis] - div[pos] + delta).limit(this.retrieve('limit'), 0);
					tween.set(value);
				}
			}				
		},
update: function(fast){
			var thumbnails = this.thumbnails,
				uid = thumbnails.retrieve('uid');
			thumbnails.getElements('a').each(function(a, i){
				if (a.retrieve('loaded')){
					if (a.retrieve('uid') == this._slide){
						if (!a.retrieve('active', false)){
							a.store('active', true);
							var active = this.classes.get('thumbnails', 'active');							
							if (fast) a.get('morph').set(active);
							else a.morph(active);
						}
					} 
					else {
						if (a.retrieve('active', true)){
							a.store('active', false);
							var inactive = this.classes.get('thumbnails', 'inactive');						
							if (fast) a.get('morph').set(inactive);
							else a.morph(inactive);
						}
					}
				}
			}, this);
			if (!thumbnails.retrieve('mouseover'))
				thumbnails.fireEvent('scroll', [this._slide, fast]);
		}
	});
})();