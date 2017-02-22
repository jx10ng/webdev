( function( $ ) {

    // Relocate Jetpack sharing buttons down into the comments form
    jQuery( document ).ready( function( $ ) {
        jQuery( '.share-blog' ).html( jQuery( '.sharedaddy' ) );
    } );

    $(window).load(function(){

    /******************STICKY HEADER**************/

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        var position = $('.site-header').position();
       if ( scroll > position.top) {
           $(".site-header").addClass("is-sticky");
       }
       else {
           $(".site-header").removeClass("is-sticky");
       }
    });

    /*******************END STICKY HEADER**************/

    /*********************BACK TO TOP******************/

     $(window).scroll(function(){
        if ($(this).scrollTop() > 1) {
        $('.backtotop').css({bottom:"25px"});
        } else {
        $('.backtotop').css({bottom:"-100px"});
        }
        });
        $('.backtotop').click(function(){
        $('html, body').animate({scrollTop: '0px'}, 1200);
        return false;
        });
    /***************END BACK TO TOP**************/
     $('.menu-toggle').click(function(){
        $('.nav-menu').slideToggle('slow');
     });

    /***************END SCROLL DOWN**************/

    /**********START PORTFOLIO****************/
    var $container = $('.portfolio'),
        colWidth = function () {
            var w = $container.width(),
                columnNum = 1,
                columnWidth = 0;
            if (w > 1200) {
                columnNum  = 3;
            }
            else if (w > 900) {
                columnNum  = 3;
            }
            else if (w > 600) {
                columnNum  = 3;
            }
            else if (w > 300) {
                columnNum  = 2;
            }
            columnWidth = Math.floor(w/columnNum);
            $container.find('.portfolio-item').each(function() {
                var $item = $(this),
                    multiplier_w = $item.attr('class').match(/item-w(\d)/),
                    multiplier_h = $item.attr('class').match(/item-h(\d)/),
                    width = multiplier_w ? columnWidth*multiplier_w[1]-0 : columnWidth-5,
                    height = multiplier_h ? columnWidth*multiplier_h[1]*1-5 : columnWidth*0.5-5;
                $item.css({
                    width: width,
                    height: height
                });
            });
            return columnWidth;
        }

        function refreshWaypoints() {
            setTimeout(function() {
            }, 1000);
        }

        $('nav.portfolio-filter ul a').on('click', function() {
            var selector = $(this).attr('data-filter');
            $container.isotope({ filter: selector }, refreshWaypoints());
            $('nav.portfolio-filter ul a').removeClass('active');
            $(this).addClass('active');
            return false;
        });

        function setPortfolio() {
            setColumns();
            $container.isotope('reLayout');
        }

        isotope = function () {
            $container.isotope({
                resizable: true,
                itemSelector: '.portfolio-item',
                layoutMode : 'masonry',
                gutter: 0,
                masonry: {
                    columnWidth: colWidth(),
                    gutterWidth: 10
                }
            });
        };
    isotope();
    /******************END PORTFOLIO**************/


    /******************COUNTER**************/

    function count($this){
        var current = parseInt($this.html(), 10);
        current = current + 1; /* Where 50 is increment */
        $this.html(++current);
        if(current > $this.data('count')){
            $this.html($this.data('count'));
        }
        else {
            setTimeout(function(){count($this)}, 50);
        }
    }

    $(".stat-count").each(function() {
        $(this).data('count', parseInt($(this).html(), 10));
        $(this).html('0');
        count($(this));
    });

    /**********END COUNTER****************/


    /***********WIDE AND BOXED LAYOUTS*************/

    $('.boxed').click(function() {
        $('body').addClass('boxed');
    });

    $('.wide').click(function() {
        $('body').removeClass('boxed');
        $('body').addClass('wide');
    });

    /**********END WIDE AND BOXED LAYOUT****************/

    });
    /**************END JQUERY***************************/
} )( jQuery );
