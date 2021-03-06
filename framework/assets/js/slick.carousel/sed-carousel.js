jQuery( document ).ready( function ( $ ) {

    var _getSlickOptions = function( $element ){

        var data = $element.data(),
            options = {} ,
            breakpoint_lg ,
            breakpoint_md ,
            slickOptions;

        for( var property in data ){
            if(property != "sedRole" && data.hasOwnProperty( property ) )
                options[property] = data[property];
        }

        if( options['slidesToShow'] < options['slidesToScroll'] )
            options['slidesToScroll'] = options['slidesToShow'];

        if( options['slidesToShow'] >= 3  ){
            breakpoint_lg  = 3;
        }else{
            breakpoint_lg  = options['slidesToShow'];
        }

        if( options['slidesToShow'] >= 2  ){
            breakpoint_md  = 2;
        }else{
            breakpoint_md  = options['slidesToShow'];
        }

        if( $("body").hasClass("rtl-body") ){
            options['rtl'] = true;
        }

        slickOptions = $.extend({} , {
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow : '<span class="slide-nav-bt slide-prev"><i class="fa fa-angle-left"></i></span>',
            nextArrow : '<span class="slide-nav-bt slide-next"><i class="fa fa-angle-right"></i></span>',
            swipe      : true ,
            touchMove  : true ,
            //centerMode: true,
            //centerPadding: '60px',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: breakpoint_lg,
                        slidesToScroll: breakpoint_lg
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: breakpoint_md,
                        slidesToScroll: breakpoint_md
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow:2,
                        slidesToScroll: 1 ,
                        arrows: false
                    }
                }
            ]
        } , options );

        return slickOptions;

    };

    var _refreshSlick = function ( $element ) {
        $element.slick('unslick');
        var options = _getSlickOptions( $element );
        $element.slick( options );
    };

    $('[data-sed-role="carousel"]').livequery(function(){

        var $element = $(this),
            $container = $element.parents(".sed-pb-module-container:first");

        if( $container.length > 0 ) {

            //sed.moduleResizeStop
            $container.on("sed.moduleSortableStop sed.moduleResize sed.moduleResizeStop sedAfterRemoveColumns" , function(){
                _refreshSlick( $element );
            });


            $container.find("img").on( "sed.changeImgSrc", function( event , newSrc ){
                _refreshSlick( $element );
            });

            $container.on("sedChangeModulesLength", function (e, length) {
                _refreshSlick( $element );
            });

            $container.on("sedChangedSheetWidth", function () {
                if ($(this).parents(".sed-row-boxed").length > 0) {
                    _refreshSlick( $element );
                }
            });

            $container.on("sedChangedPageLength", function (e, length) {
                if (($(this).parents(".sed-row-boxed").length == 0 && length == "wide" ) || ($(this).parents(".sed-row-boxed").length == 1 && length == "boxed" )) {
                    _refreshSlick( $element );
                }
            });

            $container.on("sedFirstTimeActivatedTabs", function () {
                _refreshSlick( $element );
            });

            $container.on("sedFirstTimeActivatedAccordionTabs", function () {
                _refreshSlick( $element );
            });

            $container.on("sedFirstTimeMegamenuActivated", function () {
                _refreshSlick( $element );
            });
        }

        $element.on("sedChangeDataCarousel", function (e) {
            _refreshSlick( $(this) );
        });

        var options = _getSlickOptions( $element );

        $(this).slick(options);

    });

});