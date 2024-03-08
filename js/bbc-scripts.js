//header("Content-Type: application/javascript");

function updateVideoBgURL(videoUrl) {
    let video = '';
    const screen_width = window.innerWidth;
    if ( screen_width >= 768 ) {
        video = '<source src="'+ videoUrl +'" type="video/mp4" />';
        video = document.writeln(video);
        return video;
    } else {
        return null;
    }
};
function isMobile(desktopUrl, mobileUrl) {
    let result = '';

    const screen_width = window.innerWidth;

    if ( screen_width <= 768 ) {
        result = mobileUrl;
    } else {
        result = desktopUrl;
    }

    result = document.writeln(result);
    return result;
};

function isMobileSize(size) {
    const screen_width = window.innerWidth;
    if ( screen_width <= 768 ) {
        size = 'medium_large';
    }
    //size = document.writeln(size);
    return size;
};