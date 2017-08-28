jQuery.noConflict()( function($){
	"use strict";

	var wprotoMedia;

	var wprotoThemeCore = {
	
		/**
			Constructor
		**/
		initialize: function() {

			this.build();
			this.events();

		},
		/**
			Build page elements
		**/
		build: function() {
			
			var self = this;
			
			/**
				Color picker
			**/
			$('.wproto-color-picker').each( function() {
				$(this).wpColorPicker();
			});	
			
		},
		/**
			Check for events
		**/
		events: function() {
			
			var self = this;
			
			// sking changer
			$('#wproto-skins-holder a').click( function() {
				
				if ( $(this).hasClass('current') == false && confirm( wprotoVars.strConfirmChangeSkin )) {

					var skin = $(this).data('skin');

					$.ajax({
						url: ajaxurl,
						type: "POST",
						dataType: "json",
						data: {
							'action' : 'wproto_change_skin',
							'skin' : skin
						},
						success: function() {
							location.reload();
						}
					});

				}
				
				return false;
			});
			
			/** menu builder tweaks **/
			$( document).on( 'change', 'select.wproto-submenu-widget-settings-select', function() {				
				var $megaMenuSettings = $(this).parent().parent().next('.wproto-mega-menu-settings');			
				var $customImageSettings = $(this).parents('li.menu-item').nextUntil('.menu-item-depth-0').find('.wproto-menu-image-selector');		
				var val = $(this).val();
				
				if( val == 'mega_menu' ) {
					$megaMenuSettings.fadeIn();
					$customImageSettings.fadeOut();
				} else if( val == 'iconic_menu_big' || val == 'iconic_menu_small' ) {
					$customImageSettings.fadeIn();
					$megaMenuSettings.fadeOut();
				} else {
					$customImageSettings.fadeOut();
					$megaMenuSettings.fadeOut();
				}
				
				return false;
			});
			
			$('select.wproto-submenu-widget-settings-select').each( function() {
				var $customImageSettings = $(this).parents('li.menu-item').nextUntil('.menu-item-depth-0').find('.wproto-menu-image-selector');
				var val = $(this).val();
				if( val == 'iconic_menu_big' || val == 'iconic_menu_small' ) {
					$customImageSettings.show();
				}
			});
			
			// customizer tabs
			$( '#wproto-settings-screen a.nav-tab' ).click( function() {
				var tab = $(this).data('tab');
				$('#wproto-settings-screen .option-tab').hide();
				$('#wproto-settings-screen a.nav-tab').removeClass('nav-tab-active');
				$(this).addClass('nav-tab-active');
				$( '#' + tab ).show();
				return false;
			});
			
			$( document ).on( 'click', '.wproto-file-selector', function() {
		
				var targetImage = $(this).attr('data-src-target');
				var targetInput = $(this).attr('data-url-target');
				var targetInputURL = $(this).attr('data-url-input');
				var sizeInput = $(this).attr('data-size-target');
		
				wprotoMedia = wp.media.frames.wprotoMedia = wp.media({
					className: 'media-frame wproto-media-frame',
					frame: 'select',
					multiple: false,
					title: wprotoVars.strSelectFile,
					button: {
						text: wprotoVars.strSelect
					}
				});
		
				wprotoMedia.on('select', function(){
					var media_attachment = wprotoMedia.state().get('selection').first().toJSON();
			
					if( targetImage != '' ) {
						$( targetImage ).attr( 'src', media_attachment.url );
					}
					if( targetInput != '' ) {
						$( targetInput ).val( media_attachment.id );
					}
					if( targetInputURL ) {
						
						var url = media_attachment.url;
						
						url = url.replace( 'http://', '//' );
						url = url.replace( 'https://', '//' );
						
						$( targetInputURL ).val( url );
					}
					
					if( sizeInput != '' ) {
						var size = media_attachment.filesizeHumanReadable;
						$( sizeInput ).val( size );
					}

				});
		
				wprotoMedia.open();
		
				return false;
			});
			
			$( document ).on( 'click', '.wproto-image-selector', function() {
		
				var targetImage = $(this).attr('data-src-target');
				var targetInput = $(this).attr('data-url-target');
				var targetInputURL = $(this).attr('data-url-input');
				var sizeInput = $(this).attr('data-size-target');
		
				wprotoMedia = wp.media.frames.wprotoMedia = wp.media({
					className: 'media-frame wproto-media-frame',
					frame: 'select',
					multiple: false,
					title: wprotoVars.strSelectImage,
					library: {
						type: 'image'
					},
					button: {
						text: wprotoVars.strSelect
					}
				});
		
				wprotoMedia.on('select', function(){
					var media_attachment = wprotoMedia.state().get('selection').first().toJSON();
			
					if( targetImage != '' ) {
						$( targetImage ).attr( 'src', media_attachment.url );
					}
					if( targetInput != '' ) {
						$( targetInput ).val( media_attachment.id );
					}
					if( targetInputURL ) {
						
						var url = media_attachment.url;
						
						url = url.replace( 'http://', '//' );
						url = url.replace( 'https://', '//' );
						
						$( targetInputURL ).val( url );
					}
					
					if( sizeInput != '' ) {
						var size = media_attachment.filesizeHumanReadable;
						$( sizeInput ).val( size );
					}

				});
		
				wprotoMedia.open();
		
				return false;
			});
	
			$( document ).on( 'click', '.wproto-image-remover', function(){
		
				var targetImage = $(this).attr('data-src-target');
				var targetInput = $(this).attr('data-url-target');
				var defaultImage = $(this).attr('data-default-img');
				var targetInputURL = $(this).attr('data-url-input');
				var sizeInput = $(this).attr('data-size-target');
		
				$( targetImage ).attr( 'src', defaultImage );
				$( targetInput ).val( '0' );
				$( targetInputURL ).val('');
				$( sizeInput ).val('');
		
				return false;
			});
			
			/** save settings was clicked **/
			$('#wproto-customizer-form').bind( 'submit', function(){
				
				var form = $(this);
				
				self.saveThemeLess( form );
				
				return false;
			});
			
			/** reset settings was clicked **/
			$('#wproto-customizer-form input[name=wproto_reset_to_defaults]').bind( 'click', function() {
				$('#wproto-customizer-form').unbind( 'submit' );
				$(this).unbind( 'click' ).click();
				return false;
			});
			
		},
		/**
			Compile LESS styles
		**/	
		saveThemeLess: function( form ) {
			
			var customFonts = [];
			// get all custom fonts
			$('.wproto-font-picker-input').each( function() {
				
				var fontType = $(this).find(':selected').parent().data('type');
				var fontFamily = $(this).val();
				
				if( fontType == 'custom' ) {
					customFonts.push( fontFamily );
				}
				
			});
			
			// save custom fonts
			$.ajax({
				url: ajaxurl,
				type: "POST",
				dataType: "json",
				data: {
					'action' : 'wproto_save_custom_fonts_list',
					'data' : customFonts
				}
			});
			
			var modalDialog = $( '<div title="' + wprotoVars.strPleaseWait + '">' + wprotoVars.strCompilingLess + '<br/></div>' ).dialog({
				modal: true,
				width: 500,
				closeOnEscape: false,
				resizable: false,
				draggable: false,
				dialogClass: 'wproto-no-close'
			});
			
			// init LESS parser
			var lessVars = form.serializeObject();		
			lessVars = lessVars.theme_styles;
								
			// prepare LESS vars
			var parser = less.Parser();
			
			var variable_less = "";
			for (var type in lessVars ) {
				
				if( type == 'font_picker' || type == 'font_family_picker' ) {
					
					for (var item in lessVars[type] ) {
						
						for (var variable in lessVars[type][item] ) {
							
  						if( $.isNumeric( lessVars[type][item][variable] ) ) {  
	    					if( lessVars[type][item][variable] % 1 === 0){
	    						variable_less += "@" + item + "_" + variable + ": " + parseInt(lessVars[type][item][variable]) + ";";
	   						} else {
	   							variable_less += "@" + item + "_" + variable + ": " + lessVars[type][item][variable] + ";";
	   						}
							} else if( lessVars[type][item][variable] == '' ) {
	    					variable_less += "@" + item + "_" + variable + ": wprotoSystemNoValue;";
	    				} else {
	    					variable_less += "@" + item + "_" + variable + ": ~'" + lessVars[type][item][variable] + "';";
	    				}

						}
						
					}

				} else if( type == 'bg_picker' ) {
					
					for (var item in lessVars[type] ) {
						
						for (var variable in lessVars[type][item] ) {
							
  						if( lessVars[type][item][variable] == '' ) {
	    					variable_less += "@" + item + "_" + variable + ": wprotoSystemNoValue;";
	    				} else {
	    					variable_less += "@" + item + "_" + variable + ": ~'" + lessVars[type][item][variable] + "';";
	    				}

						}
						
					}
					
				} else if( type == 'color_picker' ) {
					
					for (var variable in lessVars.color_picker ) {
						variable_less += "@" + variable + ": " + lessVars[type][variable] + ";";
					}
					
				} 

			}

			$.ajax({
				url: ajaxurl,
				type: "POST",
				dataType: "json",
				data: {
					'action' : 'wproto_get_less_sources_list'
				},
				beforeSend: function() {
					modalDialog.append( wprotoVars.strLoadingLessFiles + '<br/>' );
				},
				success: function( less_files ) {
					
					modalDialog.append( wprotoVars.strLoadingLessFilesSuccess + '<br/>' );
					modalDialog.append( wprotoVars.strCompilationLess + '<br/>' );
					
					var currFileNum = 0;
					
					function doCSS() {
						
						if ( currFileNum >= less_files.count ) {
							
							modalDialog.html( wprotoVars.strAllDone + '<br/>' );
							modalDialog.dialog( "option", "title", wprotoVars.strSuccess );
							
							// save custom fonts
							$.ajax({
								url: ajaxurl,
								type: "POST",
								dataType: "json",
								data: {
									'action' : 'wproto_save_style_version',
									'data' : customFonts
								},
								success: function( file_content ) {
									
									modalDialog.append( wprotoVars.strRefreshing + '<br/>' );
									form.unbind('submit').submit();	
									
								}
							});
							
							return;
							
						} else {
							
							$.ajax({
								url: ajaxurl,
								type: "POST",
								data: {
									'action' : 'wproto_get_less_content',
									'file' : less_files.files[ currFileNum ]
								},
								success: function( file_content ) {
									
									file_content = file_content.replace( '@import "vars.less";', '' );
									file_content = file_content.replace( new RegExp( '@import "','g'), '@import "' + wprotoVars.themeLessPath );
									
									parser.parse( variable_less + ' ' + file_content, function( error, result ){
										
				    				if(error == null){
				        			try {
				        				var newCss = result.toCSS( { compress: true } );
				        				
												var humanNum = currFileNum + 1;
												modalDialog.html( wprotoVars.strCompilingFile + ' <strong>' + less_files.files[ currFileNum ] + '</strong> (' + humanNum + ' ' + wprotoVars.strOf + ' ' + less_files.count + '). ' );
				
												$.ajax({
													url: ajaxurl,
													type: "POST",
													data: {
														'action' : 'wproto_save_css',
														'file' : less_files.files[ currFileNum ],
														'content' : newCss
													},
													success: function( result ) {
														
														if( result == 'ok' ) {
															
															modalDialog.append( '<span style="color: green">' + wprotoVars.strCompilationLessSuccess + '</span><br/>' );
															currFileNum = currFileNum + 1;
															doCSS();
															
														} else {
															
															modalDialog.html( '<span style="color: red">' + wprotoVars.strCompilingFails + '</span>' );
															
														}
														
													}
												});
				        				
				        			} catch( e ) {
				        				console.log( e );
				    						modalDialog.html( wprotoVars.strLessParseError + '<strong style="color: red">' + e.message + '</strong><br/>' );
				    						modalDialog.dialog( "option", "title", wprotoVars.strError );
				    						modalDialog.dialog( "option", "buttons", { "OK": function () { $( this ).dialog( "close" ); } } );
				        			}
				    				} else {			    					
				  						modalDialog.html( wprotoVars.strLessParseError + '<strong style="color: red">' + error.message + '</strong><br/>' );
				  						modalDialog.dialog( "option", "title", wprotoVars.strError );
				  						modalDialog.dialog( "option", "buttons", { "OK": function () { $( this ).dialog( "close" ); } } );
				    				}
									});
									
								}
							});
							
						}
						
					}
					
					doCSS();
					
				}
			});

			
		}
		
	}
	
	wprotoThemeCore.initialize();
	
});