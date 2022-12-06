(function(fabric) {
	fabric.TextCurved = fabric.util.createClass(fabric.Object, {
		type: 'text-curved',
		diameter: 250,
		kerning: 0,
		text: '',
		flipped: false,
		fill: '#000',
		fontFamily: 'Times New Roman',
		fontSize: 24,
		fontWeight: 'normal',
		fontStyle: '',
		cacheProperties: fabric.Object.prototype.cacheProperties.concat('diameter', 'kerning', 'flipped', 'fill', 'fontFamily', 'fontSize', 'fontWeight', 'fontStyle', 'strokeStyle', 'strokeWidth' , 'text'),
		strokeStyle: null,
		strokeWidth: 0,
		initialize: function(text, options) {
			options || (options = {});
			this.text = text;
			this.callSuper('initialize', options);
			this.set('lockUniScaling', true);
			var canvas = this.getCircularText();
			this.set('width', canvas.width);
			this.set('height', canvas.height);
		},
		_getFontDeclaration: function(){
			return [
				(fabric.isLikelyNode ? this.fontWeight : this.fontStyle),
				(fabric.isLikelyNode ? this.fontStyle : this.fontWeight),
				this.fontSize + 'px',
				(fabric.isLikelyNode ? ('"' + this.fontFamily + '"') : this.fontFamily)
			].join(' ');
		},
		getCircularText: function(){
			var text = this.text,
				diameter = this.diameter,
				flipped = this.flipped,
				kerning = this.kerning,
				fill = this.fill,
				inwardFacing = true,
				startAngle = this.startAngle,
				canvas = fabric.util.createCanvasElement(),
				ctx = canvas.getContext('2d'),
				cw,
				x,
				clockwise = -1;
			if (flipped) {
				// startAngle = 180;
				inwardFacing = false;
			}
			startAngle *= Math.PI / 180;
			var d = document.createElement('div');
			d.style.fontFamily = this.fontFamily;
			d.style.whiteSpace = 'nowrap';
			d.style.fontSize = this.fontSize + 'px';
			d.style.fontWeight = this.fontWeight;
			d.style.fontStyle = this.fontStyle;
			d.textContent = text;
			document.body.appendChild(d);
			var textHeight = d.offsetHeight;
			document.body.removeChild(d);
			canvas.width = canvas.height = diameter;
			ctx.font = this._getFontDeclaration();
			if (inwardFacing) { 
				text = text.split('').reverse().join('') 
			};
	
			// Setup letters and positioning
			ctx.translate(diameter / 2, diameter / 2);
			startAngle += (Math.PI * !inwardFacing);
			ctx.textBaseline = 'middle';
			ctx.textAlign = 'center';
			for (x = 0; x < text.length; x++) {
				cw = ctx.measureText(text[x]).width;
				startAngle += ((cw + (x == text.length-1 ? 0 : kerning)) / (diameter / 2 - textHeight)) / 2 * -clockwise;
			}
			ctx.rotate(startAngle);
			for (x = 0; x < text.length; x++) {
				cw = ctx.measureText(text[x]).width;
				ctx.rotate((cw/2) / (diameter / 2 - textHeight) * clockwise);
				if (this.strokeStyle && this.strokeWidth) {
					ctx.strokeStyle = this.strokeStyle;
					ctx.lineWidth = this.strokeWidth;
					ctx.miterLimit = 2;
					ctx.strokeText(text[x], 0, (inwardFacing ? 1 : -1) * (0 - diameter / 2 + textHeight / 2));
				}
				ctx.fillStyle = fill;
				ctx.fillText(text[x], 0, (inwardFacing ? 1 : -1) * (0 - diameter / 2 + textHeight / 2));
				ctx.rotate((cw/2 + kerning) / (diameter / 2 - textHeight) * clockwise); // rotate half letter
			}
			return canvas;
		},
		_set: function(key, value) {
			switch(key) {
				case 'scaleX':
					this.fontSize *= value;
					this.diameter *= value;
					this.width *= value;
					this.scaleX = 1;
					if (this.width < 1) { this.width = 1; }
					break;
				case 'scaleY':
					this.height *= value;
					this.scaleY = 1;
					if (this.height < 1) { this.height = 1; }
					break;
				default:
					this.callSuper('_set', key, value);
					break;
			}
		},
		_render: function(ctx){
			var canvas = this.getCircularText();
			this.set('width', canvas.width);
			this.set('height', canvas.height);
			ctx.drawImage(canvas, -this.width / 2, -this.height / 2, this.width, this.height);
			this.setCoords();
		},
	
		toObject: function(propertiesToInclude) {
			return this.callSuper('toObject', ['text', 'diameter', 'kerning', 'flipped', 'fill', 'fontFamily', 'fontSize', 'fontWeight', 'fontStyle', 'strokeStyle', 'strokeWidth', 'styles'].concat(propertiesToInclude));
		}
	});
	
	fabric.TextCurved.fromObject = function(object, callback, forceAsync) {
		 return fabric.Object._fromObject('TextCurved', object, callback, forceAsync, 'text-curved');
	};
	
	})(typeof fabric !== 'undefined' ? fabric : require('fabric').fabric);
