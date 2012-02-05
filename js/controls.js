/*
Copyright (c) 2011 Rdio Inc

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
 */

//Constants
var MIN_VOLUME = 0;
var MAX_VOLUME = 10;
var VOLUME_STEP = 1;
var DEFAULT_VOLUME = 5;

var songDuration = 0;
var SEEK_STEP_SIZE = 10;			//seek 20 seconds at a time


// a global variable that will hold a reference to the api swf once it has loaded
var apiswf = null;
var myPlayState = null;	//0 - paused, 1 - playing, 2 - stopped, 3 - buffering or 4 - paused.

$(document).ready(function() {
  // on page load use SWFObject to load the API swf into div#apiswf
  var flashvars = {
    'playbackToken': playback_token, // from token.js
    'domain': domain,                // from token.js
    'listener': 'callback_object'    // the global name of the object that will receive callbacks from the SWF
    };
  var params = {
    'allowScriptAccess': 'always'
  };
  var attributes = {};
  swfobject.embedSWF('http://www.rdio.com/api/swf/', // the location of the Rdio Playback API SWF
      'apiswf', // the ID of the element that will be replaced with the SWF
      1, 1, '9.0.0', 'expressInstall.swf', flashvars, params, attributes);

	// set up the controls
	$('#playPause').click(playPause);
	$('#previous').click(previous);
	$('#next').click(next);
	shortcut.add('space', playPause)
	shortcut.add('left', previous);
	shortcut.add('right', next);
	shortcut.add('up', function(){volumeUp(); return false;});
	shortcut.add('down', function(){volumeDown(); return false;});
	shortcut.add('f', seekForward);
	shortcut.add('d', seekBackward);

	//set up volume slider
	$(function() {
		$( "#slider-range-min" ).slider({
			range: "min",
			value: DEFAULT_VOLUME,
			min: MIN_VOLUME,
			max: MAX_VOLUME,
			step: VOLUME_STEP,
			animate: true,
			slide: volumeSlide,
		});
		$( "#volume" ).val( $( "#slider-range-min" ).slider( "value" ) );
	});
	//set up track progress bar
	$(function() {
		$( "#songProgress" ).slider({
			range: "min",
			value: DEFAULT_VOLUME,
			min: 0,
			max: songDuration,
			step: VOLUME_STEP,
			animate: true,
			slide: function(event, ui){apiswf.rdio_seek(ui.value); console.log(ui.value);},
		});
		$( "#songProgress" ).attr("aria-live", "off");
	});
});

// the global callback object
var callback_object = {};

callback_object.ready = function ready(user) {
  // Called once the API SWF has loaded and is ready to accept method calls.
  // find the embed/object element
  apiswf = $('#apiswf').get(0);

}

callback_object.playStateChanged = function playStateChanged(playState) {
	// The state can be: 0 - paused, 1 - playing, 2 - stopped, 3 - buffering or 4 - paused.
	myPlayState = playState;
}


/*************************
	Control Functions
*************************/
function previous(){
	apiswf.rdio_previous();
}

function next(){
	apiswf.rdio_next();
}

function playPause(){
	if(myPlayState == null){	//play for the first time
		apiswf.rdio_play($('#play_key').val());
		$('#playPause').text("Pause");
	}
	else if(myPlayState == 0 || myPlayState ==4){	//resume from pause
		apiswf.rdio_play();
		$('#playPause').text("Pause");
	}
	else{	//pause
		apiswf.rdio_pause();
		$('#playPause').text("Play");
	}
}

function volumeUp(){
	var volume = $('#slider-range-min').slider("value");
	if(volume >= MAX_VOLUME - VOLUME_STEP){
		$('#slider-range-min').slider("value", MAX_VOLUME);
	}else{
		$('#slider-range-min').slider("value", volume+VOLUME_STEP);
	}
	volumeSlide();
}

function volumeDown(){
	var volume = $('#slider-range-min').slider("value");
	if(volume <= MIN_VOLUME + VOLUME_STEP){
		$('#slider-range-min').slider("value", MIN_VOLUME);
	}else{
		$('#slider-range-min').slider("value", volume-VOLUME_STEP);
	}
	volumeSlide();
}

function volumeSlide(){
	$( "#volume" ).val($( "#slider-range-min" ).slider( "value" ));
	apiswf.rdio_setVolume($( "#slider-range-min" ).slider( "value" )/(MAX_VOLUME-MIN_VOLUME));
}

function seekForward(){
	if(songDuration != 0){
		var currentPosition = $('#songProgress').slider("value");
		if(songDuration < currentPosition + SEEK_STEP_SIZE){
			currentPosition = Math.floor(songDuration - SEEK_STEP_SIZE);
		}
		$('#songProgress').slider("option", "value", Math.floor(currentPosition+SEEK_STEP_SIZE));
		apiswf.rdio_seek(Math.floor(currentPosition+SEEK_STEP_SIZE));
	}
}

function seekBackward(){
	if(songDuration != 0){
		var currentPosition = $('#songProgress').slider("value");
		if(0 > currentPosition - SEEK_STEP_SIZE){
			currentPosition = 0;
		}
		$('#songProgress').slider("option", "value", Math.floor(currentPosition-SEEK_STEP_SIZE));
		apiswf.rdio_seek(Math.floor(currentPosition-SEEK_STEP_SIZE));
	}
}

function parseTimeFromSeconds(seconds){
	return pad2(Math.floor(seconds/60)) + ":" + pad2(Math.floor(seconds%60));
}

function pad2(number) {
	return (number < 10 ? '0' : '') + number
}


/***************************************
Callback Functions
***************************************/
callback_object.playingTrackChanged = function playingTrackChanged(playingTrack, sourcePosition) {
	// Track metadata is provided as playingTrack and the position within the playing source as sourcePosition.
	if(playingTrack != null){
		songDuration = playingTrack["duration"];
	}
	//set up progress indicator
	$( "#songProgress" ).slider("option", "max", songDuration);
	
	//Update album info (merged with John-Luke's displayInfo.js)
	if (playingTrack != null) {
		$('#song_title').text(playingTrack['name']);
		$('#album').text(playingTrack['album']);
		$('#artist').text(playingTrack['artist']);
		$('#album_art').attr('src', playingTrack['icon']);
	}
}

callback_object.positionChanged = function positionChanged(position) {
	//The position within the track changed to position seconds.
	// This happens both in response to a seek and during playback.
	$( "#songProgress" ).slider("option", "value", Math.floor(position));
	$( "#playerTime" ).text(parseTimeFromSeconds(position) + "/" + parseTimeFromSeconds(songDuration));
}

callback_object.playingSourceChanged = function playingSourceChanged(playingSource) {
  // The currently playing source changed.
  // The source metadata, including a track listing is inside playingSource.
}

callback_object.volumeChanged = function volumeChanged(volume) {
  // The volume changed to volume, a number between 0 and 1.
}

callback_object.muteChanged = function muteChanged(mute) {
  // Mute was changed. mute will either be true (for muting enabled) or false (for muting disabled).
}


callback_object.queueChanged = function queueChanged(newQueue) {
  // The queue has changed to newQueue.
}

callback_object.shuffleChanged = function shuffleChanged(shuffle) {
  // The shuffle mode has changed.
  // shuffle is a boolean, true for shuffle, false for normal playback order.
}

callback_object.repeatChanged = function repeatChanged(repeatMode) {
  // The repeat mode change.
  // repeatMode will be one of: 0: no-repeat, 1: track-repeat or 2: whole-source-repeat.
}

callback_object.playingSomewhereElse = function playingSomewhereElse() {
  // An Rdio user can only play from one location at a time.
  // If playback begins somewhere else then playback will stop and this callback will be called.
}

callback_object.updateFrequencyData = function updateFrequencyData(arrayAsString) {
  // Called with frequency information after apiswf.rdio_startFrequencyAnalyzer(options) is called.
  // arrayAsString is a list of comma separated floats.

 // var arr = arrayAsString.split(',');

 // $('#freq div').each(function(i) {
 //   $(this).width(parseInt(parseFloat(arr[i])*500));
 // })
}

