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