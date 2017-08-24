<?php
	/**
	 * Media helper
	 **/
	class wplab_recover_media {
		
		/**
		 * Generate an image with necessary width, height and retina copy
		 * @param Image URL
		 * @param Image Width
		 * @param Image Height
		 * @param Image Crop
		 * @param Add HD image for retina.js
		 * @param Fallback thumbnail name
		 * @param Thumb id
		 **/
		public static function image( $url, $width = null, $height = null, $crop = true, $hd = true, $hd_url = '', $lazy = false, $classes = array(), $atts = array() ) {
			require_once get_template_directory() . '/library/aq_resizer/aq_resizer.php';	

			$src = $src2x = $hd_str = '';
			
			$atts = is_array( $atts ) && empty( $atts ) ? array( 'alt=""' ) : $atts;
			
			if ( filter_var( $url, FILTER_VALIDATE_URL ) === FALSE ) {
				$protocol = stripos( $_SERVER['SERVER_PROTOCOL'], 'https' ) === true ? 'https:' : 'http:';
				if( $url <> '' ) {
					$url = $protocol . $url;
				}
			}
			
			if ( $hd && filter_var( $hd_url, FILTER_VALIDATE_URL ) === FALSE ) {
				$protocol = stripos( $_SERVER['SERVER_PROTOCOL'], 'https' ) === true ? 'https:' : 'http:';
				if( $hd_url <> '' ) {
					$hd_url = $protocol . $hd_url;
				}
			}

			if( !is_null( $width ) || !is_null( $height ) ) {
				
				$src = aq_resize( $url, $width, $height, $crop );
				
				if( !$src ) {
					$src = $url;
				}
				
				if( $hd ) {
					$hd_width = $width * 2;
					$hd_height = $height != null ? $height * 2 : null;
					$src2x = aq_resize( $hd_url, $hd_width, $hd_height, $crop );
					if( !$src2x ) {
						$src2x = $hd_url;
					} else {
						$hd_str = $hd_url;
					}
				} 
				
			} else {
				
				$src = $url;
				$src2x = $hd_url;
				
			}
			
			$src = str_replace( 'https://', '//', str_replace( 'http://', '//', $src ) );
			$src2x = str_replace( 'https://', '//', str_replace( 'http://', '//', $src2x ) );
			
			if( $lazy && (wplab_recover_utils::is_unyson() && filter_var( fw_get_db_settings_option( 'disable_lazy_loading' ), FILTER_VALIDATE_BOOLEAN ) === false ) ) {
				
				$classes[] = 'b-lazy';
				$src = $hd && $hd_str <> '' ? $src . '|' . $src2x : $src;
				$atts[] = 'src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="';
				$atts[] = 'data-src="' . esc_attr( $src ) . '"';
				
			} else {
				$atts[] = 'src="' . esc_attr( $src ) . '"';
				if( $hd && $src2x <> '' ) {
					$atts[] = 'data-at2x="' . esc_attr( $src2x ) . '"';
				} else {
					$atts[] = 'data-no-retina';
				}
			}
			
			return '<img class="' . implode( ' ', $classes ) . '" ' . implode( ' ', $atts ) . ' />';
			
		}
		
		/**
		 * Get YouTube Video ID From URL
		 * @param string
		 **/
		public static function getYouTubeVideoId( $url ) {
	    $video_id = false;
	    $url = parse_url($url);
	    if ( isset( $url['host'] ) && strcasecmp($url['host'], 'youtu.be') === 0) {
        #### (dontcare)://youtu.be/<video id>
        $video_id = substr($url['path'], 1);
	    }
	    elseif ( isset( $url['host'] ) && strcasecmp($url['host'], 'www.youtube.com') === 0) {
        if (isset($url['query'])) {
          parse_str($url['query'], $url['query']);
          if (isset($url['query']['v'])) {
            #### (dontcare)://www.youtube.com/(dontcare)?v=<video id>
            $video_id = $url['query']['v'];
          }
        }
        if ($video_id == false) {
          $url['path'] = explode('/', substr($url['path'], 1));
          if (in_array($url['path'][0], array('e', 'embed', 'v'))) {
            #### (dontcare)://www.youtube.com/(whitelist)/<video id>
            $video_id = $url['path'][1];
          }
        }
	    }
    	return $video_id;
		}
		
		/**
		 * Echo image SRC based on file type
		 * @param array
		 * @param string
		 **/
		public static function image_src( $image, $fallback = '' ) {
			
			if( is_array( $image ) && !empty( $image ) ) {
				
				$file = get_attached_file( $image['attachment_id'] );
				$info = pathinfo( $file );
				
				if( $info['extension'] == 'svg' ) {
					echo '<img src="' . esc_attr( $image['url'] ) . '" class="image-svg" alt="" />';
				} else {
					echo '<img src="' . esc_attr( $image['url'] ) . '" alt="" />';
				}
				
			} elseif( $fallback <> '' ) {
				echo '<img src="' . esc_attr( $fallback ) . '" class="image-svg" alt="" />';
			}
					
		}		 		 						
		
	}