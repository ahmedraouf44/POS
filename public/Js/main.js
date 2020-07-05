/* global $ */
$(document).ready(function() {
    'use strict';
    /*
    $('.icons').mouseover(function() {
        $('.items').fadeIn(100);
        $('.menu').css('width', "20%");
        $(this).css('width', '15%')
    });
    $('.main, .main2').mouseover(function() {
        $('.menu').children().not('.icons').hide();
        $('.menu').css('width', "5%");
        $('.icons').css('width', "55%");
    });
    */
    $('.ico-home').on('click', function() {
        $('.purchase, .sale, .pro, .fin, .users').hide();
        $('.items').fadeIn(100);
    });
    $('.go-trans').on('click', function() {
        $('.items').hide();
        $('.purchase').fadeIn(100);
    });
    $('.go-branch').on('click', function() {
        $('.sale').prevUntil('.icons').hide();
        $('.sale').fadeIn(100);
    });
    $('.go-sales').on('click', function() {

        $('.pro').fadeIn(100).prevUntil('.icons').hide();
    });
    $('.go-exp').on('click', function() {

        $('.new-sub').fadeIn(100).prevUntil('.icons').hide();
    });
    $('.go-pro').on('click', function() {

        $('.pro-sub').fadeIn(100).prevUntil('.icons').hide();
    });
    $('.go-noti').on('click', function() {

        $('.noti-sub').fadeIn(100).prevUntil('.icons').hide();
    });
    $('.go-repo').on('click', function() {

        $('.repo-sub').fadeIn(100).prevUntil('.icons').hide();
    });
    $('.go-user').on('click', function() {
        $('.user-sub').fadeIn(100).prevUntil('.icons').hide();
    });
    // ------------------- table function
    $('.add-row').on('click', function(e) {
        e.preventDefault();
        // $('<tr class="new-row"><td><i class="fas fa-pencil-alt"></i><input type="text" placeholder="type to search" /></td><td><span>&nbsp;</span></td><td><span>&nbsp;</span></td><td><span>&nbsp;</span></td><td><span>0</span></td><td><span>0</span></td><td><span>%0</span></td><td><p>&nbsp;</p></td><td><span>0.00</span><i class="rem fas fa-trash-alt"></i></td></tr>').appendTo('.tab1-tab');
        // $('input').focus();
        $('.over-divs').fadeIn(500);
        $('.add-cont').animate({
            top: '120px'
        }, 500).delay(500);
    });
    $('.tab1-tab').on('click', '.rem', function() {
        $(this).parent('td').parent('tr').remove();
    });
    $('.tab1-tab').on('click', 'td', function(e) {
        $(this).children('span').html('<input type="text" />');
        $('input').focus();
    });
    $('.tab1-tab').on('click', 'td', function(e) {
        $(this).children('p').html('<input type="text" list="sup"/><datalist id="sup"><option value="Value No 1"></option><option value="Value No 2"></option><option value="Value No 3"></option><option value="Value No 4"></option></datalist>');
        $('input').focus();
    });


    //room

    $('.add-row-room').on('click', function(e) {
        e.preventDefault();
        // $('<tr class="new-row"><td><i class="fas fa-pencil-alt"></i><input type="text" placeholder="type to search" /></td><td><span>&nbsp;</span></td><td><span>&nbsp;</span></td><td><span>&nbsp;</span></td><td><span>0</span></td><td><span>0</span></td><td><span>%0</span></td><td><p>&nbsp;</p></td><td><span>0.00</span><i class="rem fas fa-trash-alt"></i></td></tr>').appendTo('.tab1-tab');
        // $('input').focus();
        $('.over-divs').fadeIn(500);
        $('.add-cont-room').animate({
            top: '120px',
        }, 500).delay(500);

    });
    //end room

    //color
    //room

    $('.add-row-color').on('click', function(e) {
        e.preventDefault();
        // $('<tr class="new-row"><td><i class="fas fa-pencil-alt"></i><input type="text" placeholder="type to search" /></td><td><span>&nbsp;</span></td><td><span>&nbsp;</span></td><td><span>&nbsp;</span></td><td><span>0</span></td><td><span>0</span></td><td><span>%0</span></td><td><p>&nbsp;</p></td><td><span>0.00</span><i class="rem fas fa-trash-alt"></i></td></tr>').appendTo('.tab1-tab');
        // $('input').focus();
        $('.over-divs').fadeIn(500);
        $('.add-cont-color').animate({
            top: '120px',
        }, 500).delay(500);

    });
    //
    //end room
    //

    //sub

    $('.add-row-subCategory').on('click', function(e) {
        e.preventDefault();
        // $('<tr class="new-row"><td><i class="fas fa-pencil-alt"></i><input type="text" placeholder="type to search" /></td><td><span>&nbsp;</span></td><td><span>&nbsp;</span></td><td><span>&nbsp;</span></td><td><span>0</span></td><td><span>0</span></td><td><span>%0</span></td><td><p>&nbsp;</p></td><td><span>0.00</span><i class="rem fas fa-trash-alt"></i></td></tr>').appendTo('.tab1-tab');
        // $('input').focus();
        $('.over-divs').fadeIn(500);
        $('.add-cont-subCategory').animate({
            top: '120px',
        }, 500).delay(500);

    });
    //end sub
    // over-divs -------------------------------------------------
    $('.show-over').on('click', function(e) {
        e.preventDefault();
        $('.over-divs').fadeIn(500);
        $('.add-sup').animate({
            top: '90px'
        }, 500).delay(500);
    });
    // add-cont -------------------------------------------------
    $('.show-cont').on('click', function(e) {
        e.preventDefault();
        $('.over-divs').fadeIn(500);
        $('.add-cont').animate({
            top: '60px'
        }, 500).delay(500);
    });
    // add-adrs -------------------------------------------------
    $('.show-adrs').on('click', function(e) {
        e.preventDefault();
        $('.over-divs').fadeIn(500);
        $('.add-adrs').animate({
            top: '10px'
        }, 500).delay(500);
    });
    // add-term -------------------------------------------------
    $('.show-term').on('click', function(e) {
        e.preventDefault();
        $('.over-divs').fadeIn(500);
        $('.add-term').animate({
            top: '120px'
        }, 500).delay(500);
    });
    // add-loc -------------------------------------------------
    $('.show-loc').on('click', function(e) {
        e.preventDefault();
        $('.over-divs').fadeIn(500);
        $('.add-loc').animate({
            top: '150px'
        }, 500).delay(500);
    });
    $('.btn-cls').on('click', function(e) {
        e.preventDefault();
        $('.over-divs').hide();
    });
    $('.bac-ord').on('click', function(e) {
        e.preventDefault();
        $('.over-divs').fadeIn(500);
        $('.sel-ord').animate({
            top: '150px'
        }, 500).delay(500);
    });
    $('.tab1-tab tbody tr th:last-child p').on('click', function() {
        $('tr.collapse ').css('width', '100vw');
    });

});