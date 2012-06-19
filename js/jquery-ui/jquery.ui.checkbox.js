/*
 * jQuery UI Checkbox @VERSION
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI/ ???
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 */
( function( $, undefined ) {

	$.widget( "ui.checkbox", {
			version: "@VERSION",
			baseClass : 'ui-checkbox',
			options : {
				disabled : null
			},
			
			_create : function() {
				var _this = this,
					options = _this.options;
				
				_this.checkBox = _this.element
								.addClass( 'ui-helper-reset' )
								.css( 'opacity',0 )
								.wrap( '<div class="'+_this.baseClass+' ui-widget ui-state-default ui-corner-all">' )
								.parent();
								


				// check to see if the checkbox is disabled
				if ( _this.element.prop( "disabled" ) ) {
					_this._setOption( "disabled", true );
				}
				
				_this.element
				.bind(
					"hasChanged.checkbox", 
					function() {
						_this._refresh();
					}
				)
				.bind(
					"focus.checkbox", 
					function() {
						_this.checkBox.addClass( "ui-state-focus" );
					}
				)
				.bind(
					"blur.checkbox",
					function() {
						_this.checkBox.removeClass( "ui-state-focus" );
					}
				);
				
				_this.checkBox
				.bind( 
					"mouseenter.checkbox", 
					function() {
						if ( options.disabled ) {
							return;
						}
						_this.checkBox.addClass( "ui-state-hover" );
					}
				)
				.bind(
					"mouseleave.checkbox", 
					function() {
						if ( options.disabled ) {
							return;
						}
						_this.checkBox.removeClass( "ui-state-hover" );
					}
				);
				
				_this.element
				.data(
					'ui.checkbox.interval',
					setInterval(
						$.proxy(function(){
							var _this = this,
								isChecked;
							if( _this.element.data( 'lastState' ) !== (isChecked = _this.element.prop( 'checked' ) ) ){
								_this.element.trigger( 'hasChanged.checkbox' );
								_this.element.data( 'lastState', isChecked );
							}
						}, _this),
						10
					)
				);
				
				_this._refresh();
			},
			
			check : function(){
				this.element.prop( 'checked', true );
				
				this._refresh();
			},
			
			uncheck : function(){
				this.element.prop( 'checked', false );
				
				this._refresh();
			},
			
			refresh : function(){
				this._refresh();
			},
			
			_setOption : function( key, value ){
				this._super( "_setOption", key, value );
				if ( key === "disabled" ) {
					if ( value ) {
						this.element.attr( "disabled", true );
						this.options.disabled = true;
					} else {
						this.element.removeAttr( "disabled" );
						this.options.disabled = false;
					}
					
					this.checkBox
						[ value ? "addClass" : "removeClass" ]( "ui-state-disabled" );
				
					return;
				}
			},
			
			
			
			_refresh : function(){
				var isDisabled = this.element.prop( 'disabled' ),
					isChecked = this.element.prop( 'checked' );
				
				if( isDisabled !== this.options.disabled ){
					this._setOption( "disabled", isDisabled );
				}
				
				if( isChecked ){
					this.checkBox
						.addClass( "ui-state-active" )
						.attr( "aria-pressed", true );
				}
				else{
					this.checkBox
						.removeClass( "ui-state-active" )
						.attr( "aria-pressed", false );
				}
			},
			
			widget: function() {
				return this.checkBox;
			},
			
			destroy: function() {
				clearInterval( this.element.data( 'ui.checkbox.interval' ) );
				this.element.removeData( 'ui.checkbox.interval' ).css('opacity','').unbind(".checkbox").unwrap();
			}
		}
	);
}( jQuery ) );