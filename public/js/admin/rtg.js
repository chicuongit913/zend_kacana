/*Plugin Name: Responsive Tile Gallery
 Author: Andrew Mead
 Date: 10/17/2012*/

(function ($) {

    //Entrance to the plugin
    $.fn.rtg = function (userOptions) {
        rtg.options = $.extend(true, {}, rtg.defaults, userOptions);
        rtg.el = $(this);

        rtg.el.find('.rtg-images').css({
            'height':rtg.options.initialHeight
        });

        //Add a gif to the center of the categories
        rtg.loading.start();

        
        rtg.init();
    };

    //Global gallery object
    var rtg = {};

    //Default options (all can be overridden)
    rtg.defaults = {
        categories:true,
        lightbox:true,
        imageWidth:300,
        spacing:10,
        center:true,
        initialHeight:0
    };

    //Object to manage gallery initialization
    rtg.init = function () {
        //Initalize components based on user options
        if (rtg.options.lightbox) {
            rtg.lightbox.addOverlay();
            sgInitalizeLightbox();
        }
        if (rtg.options.categories) {
            rtg.categories.init();
        }
        
        rtg.images.resize();
        rtg.images.show();

        //If css transitions are enabled
        rtg.utils.addTransition(rtg.el.find('.rtg-images > div'));

        rtg.images.sort();
        rtg.images.center();

        //Reorder the gallery (should only do it if num of possible columns changes)
        var resize = function () {
            rtg.images.sort();
            rtg.images.center();
        };
        var resizeTimer;
        $(window).resize(function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(resize, 200);
        });

        if (navigator.appVersion.indexOf("MSIE 7.") != -1) {
            rtg.el.find('.rtg-categories > li').css('display', 'inline').find('a').css({
                'display':'block',
                'padding':'3px 7px'
            });
        }
    };

    //Object that manages loading gif
    rtg.loading = {
        image:$("<img src='/images/admin/loading.gif'/>"),
        start:function () {
            this.image.css({
                'position':'absolute',
                'top':150,
                'left':(rtg.el.width() - this.image.width()) / 2
            });
            rtg.el.prepend(this.image);
        },
        stop:function () {
            this.image.remove();
        }
    };

    //Object to manage the lightbox
    rtg.lightbox = {};
    rtg.lightbox.addOverlay = function () {
        //Create the container for the maximizer graphic
        var units = rtg.el.find('.rtg-images > div')
            .css({'cursor':'pointer'})
            .append('<span></span>');

        if (rtg.utils.transitions) {
            units.find('img').hover(function () {
                $(this).css({
                    'opacity':'.5'
                });
            }, function () {
                $(this).css({
                    'opacity':'1'
                });
            });
        } else {
            //jQuery fallback
            units.find('img').hover(function () {
                $(this).clearQueue().stop().animate({
                    'opacity':'.5'
                }, {
                    duration:'300'
                });
            }, function () {
                $(this).animate({
                    'opacity':'1'
                }, {
                    duration:'300'
                });
            });
        }
    };


    //Category functionality
    rtg.categories = {};
    rtg.categories.init = function () {
        //Get an array of all categories
        categoryList = this.generateCategoryList();

        //Turn category array into HTML <ul> markup
        var categoryMarkup = this.generateMarkup(categoryList);

        //Add the markup to the page
        rtg.el.prepend(categoryMarkup);

        //Add an event handler
        rtg.el.find('.rtg-categories a').on('click', this.filterBy);
        rtg.categories.setCurrentCategory('All');
    };

    rtg.categories.generateCategoryList = function () {
        //Get the category list from the Ligthbox2 <a rel='lightbox[cat]'>
        var categories = ["All"];

        rtg.el.find('.rtg-images div').each(function () {
            var categoryArray = $(this).attr('data-category').split(',');

            var cursor = 0;
            for (cursor = 0; cursor < categoryArray.length; cursor++) {
                var category = categoryArray[cursor];
                if ($.inArray(category, categories) == -1) {
                    categories.push(category);
                }
            }
        });

        return categories;
    };

    rtg.categories.generateMarkup = function (categoryList) {
        //Generate a html string for the categories
        var items = "";
        for (var i = 0; i < categoryList.length; i++) {
            items += "<li><a href='#" + categoryList[i] + "' category='" + categoryList[i] + "'>" + categoryList[i] + "</a></li>"
        }
        return ("<ul class='rtg-categories'>" + items + "</ul>");
    };

    rtg.categories.filterBy = function (e) {
        /* USE THE LIGHTBOX REL attribute */
        var category = $(e.target).attr('category');

        /* If they are setting the same category, do nothing*/
        if (category === rtg.categories.currentCategory) {
            return;
        }
        rtg.categories.setCurrentCategory(category);

        rtg.el.find('.rtg-images > div').each(function () {
            var image = $(this);

            var imageCategories = image.attr('data-category').split(',');

            if ((category === 'All') || ($.inArray(category, imageCategories) !== -1)) {
                image.css({
                    'display':'block'
                });
                image.find('a').attr('rel', 'lightbox[on]');
            } else {
                //Hide the image
                image.css({
                    'display':'none',
                    'left': '0'
                });
                image.find('a').attr('rel', 'lightbox[off]');
            }
        });

        rtg.images.sort();
        rtg.images.center();
    };

    rtg.categories.setCurrentCategory = function (category) {
        //Remove the current .current-category
        rtg.el.find('.rtg-categories > li > a.rtg-current-category').toggleClass('rtg-current-category');
        rtg.el.find('.rtg-categories > li > a').each(function () {
            if (category === $(this).html()) {
                $(this).toggleClass('rtg-current-category');
            }
        });
        this.currentCategory = category;
    };

    //Add sg.gallery for methods that manipulate images
    rtg.images = {};

    //Resize the images based on defaults.imageWidth
    rtg.images.resize = function () {
        var units = rtg.el.find('.rtg-images > div'),
            opts = rtg.options;
        //For each unit, scale it down to the option, imageWidth
        units.each(function () {

           
            var unit = $(this);
            image = unit.find('img'),
                
          
            image.load(function() {
            	
            	oldWidth = this.width;
                oldHeight = this.height;
                
                ratio = opts.imageWidth / oldWidth;
                newWidth = opts.imageWidth;
                newHeight = oldHeight * ratio;
            	
                $.merge(unit, unit.find('*')).css({
                    'width':newWidth,
                    'height':newHeight
                });
                
              
            });
            
            
            
//            $.merge(unit, unit.find('*')).css({
//                'width':newWidth,
//                'height':newHeight
//            });
        });
    };

    //Show the images for the first time
    rtg.images.show = function () {
        rtg.el.find('.rtg-images > div')
            .css('opacity', '0')
            .css('visibility', 'visible')
            .each(function () {
                $(this).animate({
                    'opacity':'1'
                }, {
                    duration:100 + Math.floor(Math.random() * 900),
                    complete:function () {
                        rtg.loading.stop();
                    }
                });
            });
    };

    //Sort the images
    rtg.images.sort = function () {
        var units = rtg.el.find('.rtg-images > div'),
            opts = rtg.options;
        
        var numberOfColumns = 1 + Math.floor((rtg.el.width() - opts.imageWidth) / (opts.imageWidth + opts.spacing));
        numberOfColumns = (numberOfColumns === 0) ? 1 : numberOfColumns;

        //Array to hold column heights
        var columnHeights = [],
            i = 0;
        for (i; i < numberOfColumns; i = i + 1) {
            columnHeights[i] = 0;
            
        }
       
        var column,
            tallest = 0,
            actualColumns = 0;
        
        units.each(function () {
            if ($(this).css('display') == 'none') {
                return;
            }
            console.log(columnHeights);
            console.log('bbb');
            actualColumns++;
            column = columnHeights.min();
            
            

            if (rtg.utils.transitions) {
                $(this).css({
                    'top':columnHeights[column],
                    'left':column * (opts.imageWidth + opts.spacing)
                });
            } else {
                $(this).animate({
                    'top':columnHeights[column],
                    'left':column * (opts.imageWidth + opts.spacing)
                }, 500);
            }
            console.log($(this).find('a').css('height'));
            columnHeights[column] = columnHeights[column] + $(this).height() + opts.spacing;
            
            //Keep track of tallest column
            if (columnHeights[column] > tallest) {
                tallest = columnHeights[column];
            }
        });

        //Solve the problem of less images than potential columns
        if (rtg.options.center) {
            numberOfColumns = (actualColumns < numberOfColumns) ? actualColumns : numberOfColumns;
        }

        rtg.el.find('.rtg-images').css({
            'height':tallest,
            'width':(numberOfColumns * (opts.imageWidth + opts.spacing)) - opts.spacing
        },400);
    };

    rtg.images.center = function () {
        if (!rtg.options.center) {
            return;
        };

        //Center the .sg-images in its parent
        var images = rtg.el.find('.rtg-images');

        var left = (rtg.el.width() - images.width()) / 2;

        left = (left <= 0) ? 0 : left;

        //I think css transitions don't work here because the previous css trans are not done yet
        images.animate({
            'left':left
        });

        rtg.el.find('.rtg-categories').animate({
            'margin-left':left
        });
    };

    rtg.utils = {};
    rtg.utils.addTransition = function (el) {
        if (rtg.utils.transitions) {
            el.each(function () {
                $(this).css({
                    '-webkit-transition':'all 0.7s ease',
                    '-moz-transition':'all 0.7s ease',
                    '-o-transition':'all 0.7s ease',
                    'transition':'all 0.7s ease'
                });
            });
        }
    };
    rtg.utils.removeTransition = function (el) {
        if (rtg.utils.transitions) {
            el.each(function () {
                $(this).css({
                    '-webkit-transition':'none 0.7s ease',
                    '-moz-transition':'none 0.7s ease',
                    '-o-transition':'none 0.7s ease',
                    'transition':'none 0.7s ease'
                });
            });
        }
    };
    rtg.utils.transitions = (function () {
        function cssTransitions() {
            var div = document.createElement("div");
            var p, ext, pre = ["ms", "O", "Webkit", "Moz"];
            for (p in pre) {
                if (div.style[ pre[p] + "Transition" ] !== undefined) {
                    ext = pre[p];
                    break;
                }
            }
            delete div;
            return ext;
        };
        return cssTransitions();
    }());

    Array.prototype.min = function () {
        var min = 0,
            i = 0;

        for (i; i < this.length; i = i + 1) {
            //If the current column is smaller that the smallest column (min) then min = current column
            if (this[i] < this[min]) {
                min = i;
            }
        }
        return min;
    };
}
    (jQuery)
    )
;