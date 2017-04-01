$(document).ready(function(){
    'use strict';
    
    $('.product-pop .product-pop-details  list .list-tag .fa-tag').click(function(){
        $(this).next().slideToggle(500);
   
    $("html ,  body").animate({
                    
                    top:5px;
                    
                }, 1000);
});