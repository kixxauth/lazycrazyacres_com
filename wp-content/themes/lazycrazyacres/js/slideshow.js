/*!
 * jQuery imagesLoaded plugin v1.0.4
 * http://github.com/desandro/imagesloaded
 *
 * MIT License. by Paul Irish et al.
 */

(function($, undefined) {

  // $('#my-container').imagesLoaded(myFunction)
  // or
  // $('img').imagesLoaded(myFunction)

  // execute a callback when all images have loaded.
  // needed because .load() doesn't work on cached images

  // callback function gets image collection as argument
  //  `this` is the container

  $.fn.imagesLoaded = function( callback ) {
    var $this = this,
        $images = $this.find('img').add( $this.filter('img') ),
        len = $images.length,
        blank = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';

    function triggerCallback() {
      callback.call( $this, $images );
    }

    function imgLoaded( event ) {
      if ( --len <= 0 && event.target.src !== blank ){
        setTimeout( triggerCallback );
        $images.unbind( 'load error', imgLoaded );
      }
    }

    if ( !len ) {
      triggerCallback();
    }

    $images.bind( 'load error',  imgLoaded ).each( function() {
      // cached images don't fire load sometimes, so we reset src.
      if (this.complete || typeof this.complete === "undefined"){
        var src = this.src;
        // webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
        // data uri bypasses webkit log warning (thx doug jones)
        this.src = blank;
        this.src = src;
      }
    });

    return $this;
  };
})(jQuery);

(function () {
var IMAGES = [
        'slide0.png'
      , 'slide1.png'
      , 'slide2.png'
      , 'slide3.png'
      , 'slide4.png'
      , 'slide5.png'
    ]
  , INTERVAL = 5555
  , $gSlideShow = null
  , $gCurrentSlide = null
  , gImages = []
  , gTimeout = null
  , iCurrentIndex = (IMAGES.length - 1)
  , isSlideshowLoaded = false;

function load(aCallback) {
    $gSlideShow = $('#slideshow');

    var i = 0, html, images = IMAGES.reverse();

    $gCurrentSlide = $gSlideShow.children().first();

    for (; i < images.length; i += 1) {
        if (images[i] === 'slide0.png') {
            continue;
        }

        html = '<img src="'+ getImagePath(images[i]) +'" ';
        html += 'width="421" height="328" />';
        $image = $(html);
        $gSlideShow.prepend($image);
        gImages.push($image);
    }

    gImages.push($gCurrentSlide);
    $gSlideShow.imagesLoaded(aCallback)
}

function getImagePath(aFileName) {
    return gG.templateDir +'/images/'+ aFileName;
}

function start() {
    if (gTimeout === null) {
        gTimeout = window.setTimeout(changeSlide, INTERVAL);
    } else {
        window.clearTimeout(gTimeout);
    }
}

function changeSlide() {
    $gCurrentSlide.fadeOut();
    $gCurrentSlide = getNextSlide();
    $gCurrentSlide.fadeIn();
    gTimeout = window.setTimeout(changeSlide, INTERVAL);
}

function getNextSlide() {
    if ((iCurrentIndex + 1) === IMAGES.length) {
        iCurrentIndex = 0;
    } else {
        iCurrentIndex += 1;
    }
    return gImages[iCurrentIndex];
}

function pause() {
    if (gTimeout !== null) {
        window.clearTimeout(gTimeout);
    }
    gTimeout = null;
}

$(function () {
    load(start);
});
}());
