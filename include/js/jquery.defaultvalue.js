/**
 * jQuery Default Value Plugin v1.0
 * Progressive enhancement technique for inital input field values
 *
 * The MIT License
 * 
 * Copyright (c) 2007 Paul Campbell (pauljamescampbell.co.uk)
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @param		String
 * @return		Array
 */
(function($) {
	
	$.fn.defaultvalue = function() {
		
		// Scope
		var elements = this;
		var args = arguments;
		var c = 0;
		var defaultclass = "default-value";
		
		return(
			elements.each(function() {				
				
				// Default values within scope
				var el = $(this);
				var def = args[c++];
				el.addClass(defaultclass);

				el.val(def).focus(function() {
					if(el.val() == def) {
						el.val("");
						el.removeClass(defaultclass);
					}
					el.blur(function() {
						if(el.val() == "") {
							el.val(def);
							el.addClass(defaultclass);
						}
					});
				});
				
			})
		);
	}
})(jQuery)

