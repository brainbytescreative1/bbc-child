<?php

function get_responsive_image_bbc($image_id, $image_size, $max_width){

	// check the image ID is not blank
	if($image_id !== '') {

		// set the default src image size
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );

		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );

		// generate the markup for the responsive image
		echo 'src="'.$image_src.'" srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'"';

	}

}

/*
function get_optimized_image_url_bbc($image) {

    if ( $image ) {

        $avif_test_result = 'noavif';
        $webp_test_result = 'nowebp';

        $avif_image = $image . '.avif';

        // avif test
        $avif_image = curl_init($image . '.avif');
        curl_setopt($avif_image, CURLOPT_RETURNTRANSFER, TRUE);
        $avif_response = curl_exec($avif_image);
        $avif_httpCode = curl_getinfo($avif_image, CURLINFO_HTTP_CODE);
        curl_close($avif_image);

        if ( $avifResponseCode === 200 ) {
            $avif_test_result = 'yesavif';
        }

        // webp test
        $webp_image = curl_init($image . '.webp');
        curl_setopt($webp_image, CURLOPT_RETURNTRANSFER, TRUE);
        $webp_response = curl_exec($webp_image);
        $webp_httpCode = curl_getinfo($webp_image, CURLINFO_HTTP_CODE);
        curl_close($webp_image);

        if ( $webp_httpCode === 200 ) {
            $webp_test_result = 'yeswebp';
        }

        if ( $avif_test_result === 'yesavif' ) {
            return $image . '.avif';
        } elseif ( $webp_test_result === 'yeswebp' ) {
            return $image . '.webp';
        } else {
            return $image;
        }
        
    }
}
*/

/*
function isUrlValid($url) {

    // avif test
    $avif_url = $url . '.avif';
    $avifch = curl_init($avif_url);
    curl_setopt($avifch, CURLOPT_NOBODY, true);
    curl_setopt($avifch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($avifch);
    $avifresponseCode = curl_getinfo($avifch, CURLINFO_HTTP_CODE);
    curl_close($avifch);

    // webp test
    $webp_url = $url . '.webp';
    $webpch = curl_init($webp_url);
    curl_setopt($webpch, CURLOPT_NOBODY, true);
    curl_setopt($webpch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($webpch);
    $webpresponseCode = curl_getinfo($webpch, CURLINFO_HTTP_CODE);
    curl_close($webpch);

    if ( $avifresponseCode === 200 ) {
        $url = $avif_url;
    } elseif ( $webpresponseCode === 200 ) {
        $url = $webpresponseCode;
    }

    return $url;
}
*/