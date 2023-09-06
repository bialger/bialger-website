function play (vId, w, h) {
	var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	function onYouTubeIframeAPIReady() {
		player = new YT.Player('video-placeholder', {
		width: w, height: h, 
		playerVars: { 'autoplay': 1, 'loop': 1, 'playlist': vId, 'controls': 0, 'showinfo': 0, 'rel': 0},
		videoId: vId,
		});
	}
}